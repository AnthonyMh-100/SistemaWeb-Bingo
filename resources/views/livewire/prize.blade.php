<div class="flex flex-col p-4 gap-4">
    <x-button class="w-max bg-blue-600 text-center p-1" wire:click="$set('prize_open.open',true)">Nuevo Premio</x-button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 text-gray-600 font-medium">#</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Imagen</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Nombre</th>
                    <th class="px-4 py-2 text-gray-600 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
               @forelse ($awards as $award)
                    <tr class="hover:bg-gray-50" wire:key="{{$award->id}}">
                        <td class="px-4 py-2 text-gray-700">{{$award->id}}</td>
                        <td class="px-4 py-2 text-gray-600 font-medium">
                        <img src="storage/{{$award->img_path}}" alt="" srcset="" width="100"/>   
                        </td>
                        <td class="px-4 py-2 text-gray-700">{{$award->name}}</td>
                        <td class="px-4 py-2 text-gray-700">
                            <button class="bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded"  
                                wire:click="editAward({{ $award->id }})">
                                Editar
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded ml-2"
                                    wire:click="deleteAward({{ $award->id }})">
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

    <form wire:submit="postAward">
        <x-modal wire:model="prize_open.open">
           <div class="p-4 bg-green-500 rounded-t-lg">
              <h1 class="text-xl font-bold text-white">Nuevo Premio</h1>
           </div>
           <div class="p-6 space-y-4 bg-white">
              <!-- Contenido del formulario -->
              <div>
                 <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre del Premio</label>
                 <x-input id="nombre" type="text" placeholder="Ingrese el nombre" wire:model="prize_open.name"
                    class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
              </div>
              <div>
               <label for="img" class="block text-sm font-medium text-gray-600">Imagen</label>
               <x-input id="img" type="file"  wire:model="prize_open.img"
                  class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
            </div>
           </div>
           <div class="flex justify-end p-4 bg-gray-50 rounded-b-lg">
              <!-- Footer -->
              <button type="button" 
                 wire:click="$set('prize_open.open',false)"
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

    <form wire:submit="updateAward">
        <x-modal wire:model="prize_open.open_edit">
           <div class="p-4 bg-green-500 rounded-t-lg">
              <h1 class="text-xl font-bold text-white">Editar Premio</h1>
           </div>
           <div class="p-6 space-y-4 bg-white">
              <!-- Contenido del formulario -->
              <div>
                 <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre del Premio</label>
                 <x-input id="nombre" type="text" placeholder="Ingrese el nombre" wire:model="prize_open.name"
                    class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
              </div>
              <div>

                <label for="estado" class="block text-sm font-medium text-gray-600">Estado</label>
                <select wire:model="prize_open.status" class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
                    <option value="1">Activo</option>
                    <option value="0">No Activo</option>
                </select>
                
             </div>
           </div>
           <div class="flex justify-end p-4 bg-gray-50 rounded-b-lg">
              <!-- Footer -->
              <button type="button" 
                 wire:click="$set('prize_open.open_edit',false)"
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
     



</div>
