<div class="flex flex-col p-4 gap-4">
    <x-button class="w-max bg-green-600 text-center p-1" wire:click="openModalGame">Nuevo Juego</x-button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 text-gray-600 font-medium">#</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Juego</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Descripción</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Fecha</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Premio</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Costo</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
               @forelse ($games as $game)
               <tr class="hover:bg-gray-50" wire:key="game-{{ $game->id }}">
                  <td class="px-4 py-2 text-gray-700">{{ $game->id }}</td>
                  <td class="px-4 py-2 text-gray-700">{{ $game->name }}</td>
                  <td class="px-4 py-2 text-gray-700">{{ $game->description }}</td>
                  <td class="px-4 py-2 text-gray-700">{{ $game->date_start }}</td>
                  <td class="px-4 py-2 text-gray-700">{{ $game->award->name }}</td>
                  <td class="px-4 py-2 text-gray-700">{{ 'S/'.number_format($game->cost,2,'.',',') }}</td>
                  <td class="px-4 py-2 text-gray-700">
                      <button class="bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded"
                          wire:click="editGame({{$game->id}})">
                          Editar
                      </button>
                      <button class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded ml-2" wire:click="deleteGame({{$game->id}})"> 
                          Eliminar
                      </button>
                  </td>
              </tr>
               @empty
                  
               @endforelse
              
            </tbody>
        </table>
    </div>


    {{-- MODAL POST --}}

    <form wire:submit="postGame">
        <x-modal wire:model="game_open.open">
            <div class="p-4 bg-green-500 rounded-t-lg">
                <h1 class="text-xl font-bold text-white">Nuevo Juego</h1>
            </div>
            <div class="p-6 space-y-4 bg-white">
                <!-- Contenido del formulario -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre del Juego</label>
                    <x-input id="nombre" type="text" placeholder="Ingrese el nombre" wire:model="game_open.name"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                <div>
                    <label for="descrp" class="block text-sm font-medium text-gray-600">Descripcion</label>
                    <x-input id="descrp" type="text" placeholder="Ingrese la Descripcion" wire:model="game_open.description"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-600">Fecha</label>
                    <x-input id="fecha" type="datetime-local" wire:model="game_open.date_start"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                <div>
                    <label for="premio" class="block text-sm font-medium text-gray-600">Premio</label>
                    <select name="" id="" wire:model="game_open.award_id"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="" disabled>Selecione un premio</option>
                        @forelse ($awards as $award)
                            <option wire:key="award-{{ $award->id }}" value="{{ $award->id }}">{{ $award->name }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div>
                    <label for="costo" class="block text-sm font-medium text-gray-600">Costo</label>
                    <x-input id="costo" type="text" wire:model="game_open.cost"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
            </div>
            <div class="flex justify-end p-4 bg-gray-50 rounded-b-lg">
                <!-- Footer -->
                <button type="button" wire:click="$set('game_open.open',false)"
                    class="px-4 py-2 text-sm font-semibold text-gray-500 bg-gray-200 rounded-lg hover:bg-gray-300 mr-2">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-700">
                    Guardar
                </button>
            </div>
        </x-modal>
    </form>



    {{-- MODAL PUT --}}
    <form wire:submit="updateGame">
        <x-modal wire:model="game_open.open_edit">
            <div class="p-4 bg-green-500 rounded-t-lg">
                <h1 class="text-xl font-bold text-white">Editar Juego</h1>
            </div>
            <div class="p-6 space-y-4 bg-white">
                <!-- Contenido del formulario -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre del Juego</label>
                    <x-input id="nombre" type="text" placeholder="Ingrese el nombre" wire:model="game_open.name"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                <div>
                    <label for="descrp" class="block text-sm font-medium text-gray-600">Descripcion</label>
                    <x-input id="descrp" type="text" placeholder="Ingrese la Descripcion" wire:model="game_open.description"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-600">Fecha</label>
                    <x-input id="fecha" type="datetime-local" wire:model="game_open.date_start"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                <div>
                    <label for="premio" class="block text-sm font-medium text-gray-600">Premio</label>
                    <select name="" id="" wire:model="game_open.award_id"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="" disabled>Selecione un premio</option>
                        @forelse ($awards as $award)
                            <option wire:key="award-{{ $award->id }}" value="{{ $award->id }}">{{ $award->name }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div>
                    <label for="costo" class="block text-sm font-medium text-gray-600">Costo</label>
                    <x-input id="costo" type="text" wire:model="game_open.cost"
                        class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
            </div>
            <div class="flex justify-end p-4 bg-gray-50 rounded-b-lg">
                <!-- Footer -->
                <button type="button" wire:click="$set('game_open.open_edit',false)"
                    class="px-4 py-2 text-sm font-semibold text-gray-500 bg-gray-200 rounded-lg hover:bg-gray-300 mr-2">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-700">
                    Actualizar
                </button>
            </div>
        </x-modal>
    </form>



</div>
