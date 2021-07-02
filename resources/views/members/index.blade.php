
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Members List') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if (session()->has('message'))
            <div class="bg-green-600 border-b-4 border-green-800 rounded text-white px-4 py-3 shadow-md my-3 mx-4" role="alert">
                <div class="flex">
                    <div>
                        <p class="">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="flex pt-4">
            <div class="w-full md:-1/2 px-3 mb-6 md:mb-0">
                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">New Member</button>
            </div>  
            <div class="w-full md:-1/2 px-3 mb-6 md:mb-0">
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="" placeholder="Searching Members..." wire:model="search">
            </div>
        </div>
        @if($isModal)
            @include('members.create')
        @endif
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="py-4 px-2 flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg pb-2">
                        <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Phone
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <span class="">Action</span>
                            </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($members as $row)
                            <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $row->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                    {{ $row->name }}
                                    </div>
                                </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $row->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {!! $row->status_label !!}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $row->phone_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $row->id }})" class="px-3 py-1 mb-0.5 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">Edit</button>
                                <button wire:click="deleteShowModal({{ $row->id }})" class="px-3 py-1 border-red-500 border text-red-500 rounded transition duration-300 hover:bg-red-700 hover:text-white focus:outline-none">Delete</button>
                            </td>
                            </tr>
                        @empty
                            <tr>
                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center" colspan="6">
                                Tidak ada data
                                </td>
                            </tr>
                            <!-- More items... -->
                        @endforelse
                        </tbody>
                        </table>
                    </div>
                    
                    </div>
                </div>
                <div class="m-4">
                        {{ $members->links() }}
                </div>
            </div>
        </div>
        </div>
        <!-- Delete Member Confirmation Modal -->
        <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
            <x-slot name="title">
                {{ __('Delete Member') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this member?') }}
                <table>
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-2 text-left text-sm font-medium text-gray-900 uppercase tracking-wider">Id</th>
                            <th scope="col" class="px-6 py-2 text-left text-sm font-medium text-gray-900 uppercase tracking-wider">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-6 py-2 whitespace-nowrap text-left text-sm font-medium">{{ $member_id }}</td>
                            <td class="px-6 py-2 whitespace-nowrap text-left text-sm font-medium">{{ $name }}</td>
                        </tr>
                    </tr>
                    </tbody>
                </table>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="delete({{ $member_id }})" wire:loading.attr="disabled">
                    {{ __('Delete Member') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
