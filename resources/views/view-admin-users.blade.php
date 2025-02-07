<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg table">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">USERS</h1>
                    <table id="projects-tbl" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Role</th>
                                <th scope="col">Admin</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td colspan="1">{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td colspan="1">{{ $user->name }}</td>
                                <td colspan="1">{{ $user->subscription_status ? 'Subscribed' : 'Not Subscribed' }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td colspan="1">{{ $user->role }}</td>
                                <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                                <td colspan="1">
                                    <x-primary-button><a href="http://127.0.0.1:8000/edit-user-profile/{{ $user->id }}">Update</a></x-primary-button>
                                    @if(auth()->user()->role == 'super-admin')
                                    <x-primary-button><a href="http://127.0.0.1:8000/admin/delete-user/{{ $user->id }}">Delete</a></x-primary-button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
