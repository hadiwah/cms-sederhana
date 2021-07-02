<div class="p-6">

    <!-- the data table -->
    <div class="flex flex-col">
        <div class="-my-2 sm:-mx-6 lg:-mx-8 overflow-x-auto">
            <div class="py-2 align-middle inline-block min-w-full sm:px-4 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-400">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 leading-4 tracking-wider uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 leading-4 tracking-wider uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 leading-4 tracking-wider uppercase">Role</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 leading-4 tracking-wider uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-gray-200 divide-y">
                            @if($data->count())
                                @foreach($data as $item)
                                <tr>
                                    <td class="px-6 py-2 text-sm whitespace-nowrap">{{ $item->name }}</td>
                                    <td class="px-6 py-2 text-sm whitespace-nowrap">{{ $item->email }}</td>
                                    <td class="px-6 py-2 text-sm whitespace-nowrap">{{ $item->role }}</td>
                                    <td class="px-6 py-2 text-sm whitespace-nowrap text-right">
                                        <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                            {{ __('Update') }}
                                        </x-jet-button>
                                        <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
                                            {{ __('Delete') }}
                                        </x-jet-button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-6 py-4 text-sm text-center whitespace-nowrap" colspan="5">No Results Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
     {{$data->links()}}
    </div>
   
    <!-- modal form -->
    <x-jet-dialog-modal wire:model="modalFormVisible">
         <x-slot name="title">
           {{ __('Create or Update') }} 
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name')}}" />
                <x-jet-input wire:model="name" id="name" class="block mt-1 w-full" type="text"/>
                @error('name')<span class="error">{{$message}}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Role')}}" />
                <select wire:model="role" id="role" class="block appearance-none w-full bg-gray-100 border 
                border-gray-200 text-gray-700 px-4 py-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                focus:border-gray-500">
                    <option value="">-- Select a Role --</option>
                @foreach(App\Models\User::userRoleList() as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
                </select>
                @error('role')<span class="error">{{$message}}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>
            @if ($modelId)
                <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete Pages Confirmation Modal -->
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
            <x-slot name="title">
                {{ __('Delete User') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this ...?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete User') }}
                </x-jet-danger-button>
            </x-slot>
    </x-jet-dialog-modal>
</div>

