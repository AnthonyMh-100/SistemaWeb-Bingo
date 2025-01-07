<div class="min-h-screen bg-gray-100 flex flex-col items-center p-6">
    <!-- Header -->
    <div class="w-full bg-blue-500 text-white py-4 px-6 rounded-md shadow-lg mb-6 text-center">
        <h1 class="text-3xl font-bold">🎉Busca tu Juego de Bingo 🎉</h1>
        <p class="text-lg mt-2">¡Únete a la diversión!</p>

        <!-- Barra de búsqueda de juegos -->
        <div class="flex gap-3 mt-6 max-w-2xl w-full mx-auto relative">

            <input type="text" placeholder="Buscar Juego..." wire:change="gameUpdate" wire:model="bingo_open.search"
                class="w-full py-2 pl-10 pr-4 rounded-lg border text-black border-gray-300 focus:outline-none focus:ring focus:ring-blue-300" />
            <svg xmlns="http://www.w3.org/2000/svg"
                class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 4a7 7 0 110 14 7 7 0 010-14zm0 0l7 7m-7-7v6" />
            </svg>
            {{-- <x-button>Buscar</x-button> --}}
        </div>
    </div>

    <!-- Image Section -->
    <div class="w-full flex flex-col items-center gap-4 mb-6">
        @if ($bingo_open->game)
            <img src="storage/{{ $bingo_open->game->award->img_path }}" alt="Imagen del juego de bingo"
                class="rounded-lg shadow-lg w-full max-w-2xl" />

            <h1 class="text-center text-3xl font-bold text-blue-600">
                {{ $bingo_open->game->name }}
            </h1>
            <h1 class="text-center text-xl font-semibold text-gray-700">
                Fecha: <span class="text-gray-900 font-bold">{{ $bingo_open->game->date_start }}</span>
            </h1>
            <h1 class="text-center text-xl font-semibold text-gray-700">
                Costo: <span
                    class="text-green-600 font-bold">{{ number_format($bingo_open->game->cost, 2, '.', ',') }}</span>
            </h1>
        @endif
    </div>



    <!-- Participants List Section -->
    <div class="w-full max-w-8xl bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Participantes Registrados</h2>
   
        @if ($bingo_open->game)
            <button type="submit" wire:click="$set('bingo_open.open',true)"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg mb-8">
                Agregar Participante
            </button>
        @endif
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo
                        Electrónico</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto
                        Pagado</th>

                    {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto
                        Deber</th> --}}
                    
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pagado</th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ganador</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notificar</th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                @forelse ($bingo_participants as $data)
                    <tr wire:key="binhop-{{ $data->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $data->partcipants[0]['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $data->partcipants[0]['last_name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $data->partcipants[0]['email'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $data->partcipants[0]['phone'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{  $data->mount }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600"> 
                            <div
                                class="{{ $bingo_open->game->cost == $data->mount ? 'bg-green-500' : 'bg-red-500' }} text-center w-24 py-2 text-white rounded-md">
                                {{ $bingo_open->game->cost == $data->mount ? 'Pago' : 'Pendiente' }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div
                                class="{{ $data->winner  ? 'bg-green-500' : 'bg-black' }} text-center w-24 py-2 text-white rounded-md">
                                {{ $data->winner ? 'Gano' : 'No Gano' }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if(!$data->winner)
                                <x-button disabled class="bg-gray-700">
                                    No Notificar
                                </x-button>
                            @else
                                <x-button wire:click="sendMail" class="bg-black" id="btn_send">
                                    Notificar Ganador
                                </x-button>
                            @endif
                        </td>
                        <td>
                            <x-button wire:click="editParticipant({{ $data->id }})">editar</x-button>
                            <x-danger-button
                                wire:click="deleteParticipant({{ $data->id }})">delete</x-danger-button>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>


    {{-- AGREGAR PARTICIPANTE --}}
    <form wire:submit="addParticipant">
        <x-modal wire:model="bingo_open.open">
            <div class="p-4 bg-gray-100 rounded-t-lg">
                <h1 class="text-xl font-bold text-gray-700">Agregar Participante</h1>
            </div>
            <div class="p-6 space-y-4 bg-white">
                <!-- Contenido del formulario -->
                <div class="relative">
                    <label for="search" class="flex gap-3 text-sm font-medium text-gray-600">
                        Buscar Participante
                    </label>
                    <div class="flex items-center w-full mt-1 gap-2">
                        <x-input id="search" type="text" placeholder="Ingrese el nombre del participante"
                            wire:model="bingo_open.search_people"
                            class="w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-transparent" />
                        <x-button type="button" wire:click="searchPeople" class="px-4 py-2">Buscar</x-button>
                    </div>
                </div>

                <div>
                    <label for="apellido" class="block text-sm font-medium text-gray-600">Nombre y Apellido</label>
                    <x-input id="apellido" type="text" wire:model="bingo_open.participant"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>

                <div class="flex items-center space-x-2 mt-6">
                    <x-input type="checkbox" id="pagado" name="pagado" wire:model.live="bingo_open.payment"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" />
                    <label for="pagado" class="text-gray-700">Pago Realizado</label>
                </div>

                @if ($bingo_open->payment)
                    <div class="flex items-center space-x-2 mt-6">
                        <div class="flex flex-col">
                            <label class="text-gray-700">Monto Pagado</label>
                            <x-input type="text" id="precio" name="precio" wire:model.live="bingo_open.mount"
                                class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" />
                        </div>
                    </div>
                @endif


            </div>
            <div class="flex justify-end p-4 bg-gray-50 rounded-b-lg">
                <!-- Footer -->
                <button type="button" wire:click="$set('bingo_open.open',false)"
                    class="px-4 py-2 text-sm font-semibold text-gray-500 bg-gray-200 rounded-lg hover:bg-gray-300 mr-2">
                    Cancelar
                </button>
                <button class="px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-700">
                    Agregar
                </button>
            </div>
        </x-modal>
    </form>


    {{-- ACTUALIZAR PARTICIPANTE --}}

    <form wire:submit="updateParticipant">
        <x-modal wire:model="bingo_open.open_edit">
            <div class="p-4 bg-gray-100 rounded-t-lg">
                <h1 class="text-xl font-bold text-gray-700">Editar Participante</h1>
            </div>
            <div class="p-6 space-y-4 bg-white">
                <!-- Contenido del formulario -->
                <div>
                    <label for="apellido" class="block text-sm font-medium text-gray-600">Nombre y Apellido</label>
                    <x-input id="apellido" disabled type="text" wire:model="bingo_open.participant"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>

                <div class="flex items-center space-x-2 mt-6">
                    <x-input type="checkbox" id="pagado" name="pagado" wire:model="bingo_open.payment"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" />
                    <label for="pagado" class="text-gray-700">Pago Realizado</label>
                </div>

                @if ($bingo_open->payment)
                    <div class="flex items-center space-x-2 mt-6">
                        <div class="flex flex-col">
                            <label class="text-gray-700">Monto Pagado</label>
                            <x-input type="text" id="precio" name="precio" wire:model.live="bingo_open.mount"
                                class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" />
                        </div>
                    </div>
                @endif

                <div class="flex items-center space-x-2 mt-6">
                    <x-input type="checkbox" id="winner" name="winner" wire:model="bingo_open.winner"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" />
                    <label for="winner" class="text-gray-700">Ganador</label>
                </div>

            </div>
            <div class="flex justify-end p-4 bg-gray-50 rounded-b-lg">
                <!-- Footer -->
                <button type="button" wire:click="$set('bingo_open.open_edit',false)"
                    class="px-4 py-2 text-sm font-semibold text-gray-500 bg-gray-200 rounded-lg hover:bg-gray-300 mr-2">
                    Cancelar
                </button>
                <button class="px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-700">
                    Actualizar
                </button>
            </div>
        </x-modal>
    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('notify', (message) => {
            Swal.close(); 
            Swal.fire({
                icon: 'success',
                title: 'Operación completada',
                text: message
            });
           
        });
    });
</script>
