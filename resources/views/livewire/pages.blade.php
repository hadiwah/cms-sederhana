<div class="p-6">
    <div class="flex items-center justify-end px-4 py-4 text-right sm:px-6"> 
        <x-jet-button wire:click="createShowModal">
        {{ __('Create') }} 
        </x-jet-button>
    </div>

    <!-- the data table -->
    <div class="flex flex-col">
        <div class="-my-2 sm:-mx-6 lg:-mx-8 overflow-x-auto">
            <div class="py-2 align-middle inline-block min-w-full sm:px-4 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-400">
                        <thead class="bg-gray-300 bg-opacity-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 leading-4 tracking-wider uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 leading-4 tracking-wider uppercase">Link</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 leading-4 tracking-wider uppercase">Content</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 leading-4 tracking-wider uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white bg-opacity-50 divide-gray-200 divide-y">
                        @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                {{$item->title}}
                                {!! $item->is_default_home ? '<span class="font-bold text-green-400 text-sm">Default Home Page</span>' : ''!!}
                                {!! $item->is_default_not_found ? '<span class="font-bold text-red-400 text-sm">Default 404 Page</span>' : ''!!}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                   <a href="{{ URL::to('/'.$item->slug) }}" class="text-indigo-500 hover:text-indigo-900" target="_blank" >
                                   {{$item->slug}}
                                   </a>
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap">{!! \Illuminate\Support\Str::limit($item->content, 50, '<span class="font-bold text-green-400 text-sm"> ...</span>')!!}</td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-right">
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
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-center" colspan="4">No Results Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>
    <br/>
    {{$data->links()}}
    <!-- modal form -->
    <x-jet-dialog-modal wire:model="modalFormVisible">
         <x-slot name="title">
           {{ __('Save Page') }} {{ $modelId }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model="title" placeholder="title" autofocus />
                @error('title')<span class="error">{{$message}}</span> @enderror
            </div>  
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <div class="mt-1 flex rounded-md">
                    <span class="inline-flex items-center px-3 rounded-md border border-r-0 border-gray-500 bg-gray-50 text-gray-500">
                        http://localhost:8000/
                    </span>
                    <input wire:model="slug" type="text" class="form-input mt-1 block w-full transition duration-150" placeholder="url-slug"/>
                </div>
                @error('slug')<span class="error">{{$message}}</span> @enderror
            </div>

            <div class="mt-4">
                <label>
                    <input class="form-checkbox" type="checkbox" value="{{ $isSetToDefaultHomePage }}" wire:model="isSetToDefaultHomePage"/>
                    <span class="ml-2 text-sm text-gray-600">Set as default Home Page</span>
                </label>
            </div>
            <div class="mt-4">
                <label>
                    <input class="form-checkbox" type="checkbox" value="{{ $isSetToDefaultNotFoundPage }}" wire:model="isSetToDefaultNotFoundPage"/>
                    <span class="ml-2 text-sm text-gray-600">Set as default 404 error Page</span>
                </label>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="content" value="{{ __('Content') }}" />
                <div class="rounded-md shadow-sm">
                    <div class="mt-1 bg-white">
                        <div class="body-content" wire:ignore>
                            <trix-editor
                                class="trix-content"
                                x-ref="trix"
                                wire:model="content"
                                wire:keys="trix-content-unique-keys"
                            >
                            </trix-editor>
                        </div>
                    </div>
                </div>
                @error('content')<span class="error">{{$message}}</span> @enderror
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
                {{ __('Delete Page') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete page? Once your the page is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete Page') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
</div>
