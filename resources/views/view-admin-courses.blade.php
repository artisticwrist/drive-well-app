<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg table">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Courses</h1>
                    <table id="projects-tbl" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Level</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Price</th>
                                <th scope="col2">Discount Price</th>
                                <th scope="col2">OPERATIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td colspan="1">{{ $course->id }}</td>
                                <td colspan="">{{ $course->level }}</td>
                                <td colspan="1">{{ $course->duration }}</td>
                                <td colspan="1">{{ $course->price }}</td>
                                <td colspan="1">{{ $course->discount_price }}</td>
                                <td >
                                    @if(auth()->user()->role == 'super-admin')
                                        <x-primary-button><a href="http://127.0.0.1:8000/admin/delete-course/{{ $course->id }}">Delete</a></x-primary-button>
                                    @endif

                                    
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>                                           
                    </table>
                    <x-primary-button><a href="http://127.0.0.1:8000/view-admin-courses">View All</a></x-primary-button>  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
