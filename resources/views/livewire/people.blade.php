<div class="flex flex-col p-4 gap-4">
    <x-button class="w-max text-center p-1" wire:click="$set('form_open.open',true)">Nuevo Participante</x-button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 text-gray-600 font-medium">#</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Nombre</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Apellido</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Correo Electrónico</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Teléfono</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($people as $pp)
                <tr class="hover:bg-gray-50" wire:index="{{ $pp->id }}">
                    <td class="px-4 py-2 text-gray-700">{{ $pp->id }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $pp->name }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $pp->last_name }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $pp->email }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $pp->phone }}</td>
                    <td class="px-4 py-2 text-gray-700">
                        <button class="bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded" wire:click="editPeople({{$pp->id}})">
                            Editar
                        </button>
                        <button class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded ml-2" wire:click="deletePeople({{$pp->id}})">
                            Eliminar
                        </button>
                    </td>
                @empty
                    
                @endforelse
               
                </tr>
            </tbody>
        </table>
    </div>



    {{-- MODAL POST --}}
    <form wire:submit="postPeople">
        <x-modal wire:model="form_open.open">
           <div class="p-4 bg-gray-100 rounded-t-lg">
              <h1 class="text-xl font-bold text-gray-700">Nuevo Participante</h1>
           </div>
           <div class="p-6 space-y-4 bg-white">
              <!-- Contenido del formulario -->
              <div>
                 <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre</label>
                 <x-input id="nombre" type="text" placeholder="Ingrese el nombre" wire:model="form_open.name"
                    class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
              </div>
              <div>
                <label for="apellido" class="block text-sm font-medium text-gray-600">Apellido</label>
                <x-input id="apellido" type="text" placeholder="Ingrese el apellido" wire:model="form_open.last_name"
                   class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
             </div>
              <div>
                 <label for="email" class="block text-sm font-medium text-gray-600">Correo</label>
                 <x-input id="email" type="email" placeholder="Ingrese el correo electrónico" wire:model="form_open.email"
                    class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
              </div>
              <div>
                 <label for="telefono" class="block text-sm font-medium text-gray-600">Teléfono</label>
                 <x-input id="telefono" type="tel" placeholder="Ingrese el teléfono" wire:model="form_open.phone"
                    class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
              </div>
           </div>
           <div class="flex justify-end p-4 bg-gray-50 rounded-b-lg">
              <!-- Footer -->
              <button type="button" 
                wire:click="$set('form_open.open',false)"
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



     {{-- MODAL UPDATE --}}
     <form wire:submit="updatePeople">
        <x-modal wire:model="form_open.open_edi">
           <div class="p-4 bg-gray-100 rounded-t-lg">
              <h1 class="text-xl font-bold text-gray-700">Editar Participante</h1>
           </div>
           <div class="p-6 space-y-4 bg-white">
              <!-- Contenido del formulario -->
              <div>
                 <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre</label>
                 <x-input id="nombre" type="text" placeholder="Ingrese el nombre" wire:model="form_open.name_edi"
                    class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
              </div>
              <div>
                <label for="apellido" class="block text-sm font-medium text-gray-600">Apellido</label>
                <x-input id="apellido" type="text" placeholder="Ingrese el apellido" wire:model="form_open.last_name_edi"
                   class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
             </div>
              <div>
                 <label for="email" class="block text-sm font-medium text-gray-600">Correo</label>
                 <x-input id="email" type="email" placeholder="Ingrese el correo electrónico" wire:model="form_open.email_edi"
                    class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
              </div>
              <div>
                 <label for="telefono" class="block text-sm font-medium text-gray-600">Teléfono</label>
                 <x-input id="telefono" type="tel" placeholder="Ingrese el teléfono" wire:model="form_open.phone_edi"
                    class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
              </div>
           </div>
           <div class="flex justify-end p-4 bg-gray-50 rounded-b-lg">
              <!-- Footer -->
              <button type="button" 
                wire:click="$set('form_open.open_edi',false)"
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
    Livewire.on('postPeople', (message) => {
        alert(message);
    });
});

</script>
