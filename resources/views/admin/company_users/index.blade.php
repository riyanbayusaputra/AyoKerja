<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Company Users') }}
            </h2>
            <a href="{{ route('company_users.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Create User
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @foreach ($users as $user)
                <div class="item-card flex flex-row justify-between items-center border-b border-gray-200 py-4">
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">
                                {{ $user->name }}
                            </h3>
                            <p class="text-slate-500 text-sm">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">
                                Role
                            </p>
                            <p class="text-slate-500 text-sm">
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}@if (!$loop->last), @endif
                                @endforeach
                            </p>
                        </div>
                    </div>   
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{ route('company_users.edit', $user->id) }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                            Edit User
                        </a>
                        <form action="{{ route('company_users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-2 px-4 bg-red-600 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
