@if(session('success-course'))
<div class="alert alert-success">
    {{ session('success-course') }}
</div>
@endif<x-app-layout>
    <x-slot name="header">

        <span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div style="color: lime;">
                @if(session('success-user'))
                    <div class="alert alert-success">
                        {{ session('success-user') }}
                    </div>
                @endif 

                @if(session('success-profile'))
                    <div class="alert alert-success">
                        {{ session('success-profile') }}
                    </div>
                @endif   
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('success-delete-user'))
                    <div class="alert alert-success">
                        {{ session('success-delete-user') }}
                    </div>
                @endif

                @if(session('success-delete-course'))
                    <div class="alert alert-success">
                        {{ session('success-delete-course ') }}
                    </div>
                @endif

                @if(session('success-delete-feedback'))
                    <div class="alert alert-success">
                        {{ session('success-delete-feedback') }}
                    </div>
                @endif
            </div>


        </span>

    </x-slot>

 

    <div class="py-10">
        <div class="general-info max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="box shadow-sm sm:rounded-lg">
                <h1 class=" text-xl text-gray-800 leading-tight font-semibold">Total Users</h1>
                <h3 class="text-gray-500">{{ $userCount }}</h3>
            </div>
            <div class="box shadow-sm sm:rounded-lg">
                <h1 class=" text-xl text-gray-800 leading-tight font-semibold">Total Admin</h1>
                <h3 class="text-gray-500">{{ $adminCount }}</h3>
            </div>
            <div class="box shadow-sm sm:rounded-lg">
                <h1 class=" text-xl text-gray-800 leading-tight font-semibold">Active Students</h1>
                <h3 class="text-gray-500">{{ $activeStudentCount }}</h3>
            </div>
            <div class="box shadow-sm sm:rounded-lg">
                <h1 class=" text-xl text-gray-800 leading-tight font-semibold">Course Discount</h1>
                <h3 class="text-gray-500">{{ $courseCount }}</h3>
            </div>
        </div>
    </div>
    @if(auth()->user()->role == 'super-admin')
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg table">
                    <div class="text-gray-900 form-container">
                        <form class="p-6" action="{{ route('submit') }}" method="POST">

                            @csrf
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Create Admin</h1>
                            <input type="text" name="email" placeholder="Email">
                            <input type="text" name="name" placeholder="Full Name">
                            <select name="role" id="">
                                <option value="">Role</option>
                                <option value="super-admin">Super Admin</option>
                                <option value="admin">Admin</option>
                            </select>
                            <button type="submit" name="submit">Submit</button>
                        </form>
                        <form class="p-6" action="{{ route('create.course') }}" method="POST">
                            @csrf
                            <h1 class="font-semibold text-xl text-gray-800 leading-tightfont-semibold text-xl text-gray-800 leading-tight">Create Course (Discount)</h1>
                            <select name="level" id="">
                                <option value="">Level</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                            <input type="text" name="duration" placeholder="Course Duration">
                            <input type="number" name="discount_percent" placeholder="Discount Percent">
                            <button type="submit" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif 



    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg table">
                <div class="text-gray-900 form-container">
                    <form class="p-6" action="{{ route('create.user') }}" method="POST">
                        @csrf
                        <h1 class="font-semibold text-xl text-gray-800 leading-tight">Create  User</h1>
                        <input type="text" name="email" placeholder="Email">
                        <input type="text" name="name" placeholder="Full Name">
                        <input type="text" name="phone_number" placeholder="Phone Number">
                        <div style="display: flex; align-items:center; width:70%;">
                            <select name="subscription_status" id="">
                                <option value="">Subscription Status</option>
                                <option value="1">True</option>
                                <option value="0">False</option>
                            </select>
                            <select name="duration" id="" style="margin-left:5px;">
                                <option value="">Duration</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <input type="text" name="amount" placeholder="Amount">
                        <button type="submit" name="submit">Submit</button>
                    </form>
                    {{-- <form class="p-6" action="{{ route('create.course') }}" method="POST">
                        @if(session('success-course'))
                            <div class="alert alert-success">
                                {{ session('success-course') }}
                            </div>
                        @endif
                        @csrf
                        <h1 class="font-semibold text-xl text-gray-800 leading-tightfont-semibold text-xl text-gray-800 leading-tight">Create Course (Discount)</h1>
                        <select name="level" id="">
                            <option value="">Level</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                        <input type="text" name="duration" placeholder="Course Duration">
                        <input type="number" name="discount_percent" placeholder="Discount Percent">
                        <button type="submit" name="submit">Submit</button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="">
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
                            @foreach($usersLimit as $userLimit)
                            <tr>
                                <td colspan="1">{{ $userLimit->id }}</td>
                                <td>{{ $userLimit->email }}</td>
                                <td colspan="1">{{ $userLimit->name }}</td>
                                <td colspan="1">{{ $userLimit->subscription_status ? 'Subscribed' : 'Not Subscribed' }}</td>
                                <td>{{ $userLimit->phone_number }}</td>
                                <td colspan="1">{{ $userLimit->role }}</td>
                                <td>{{ $userLimit->is_admin ? 'Yes' : 'No' }}</td>
                                <td colspan="1">
                                    <x-primary-button><a href="http://127.0.0.1:8000/edit-user-profile/{{ $userLimit->id }}">Update</a></x-primary-button>
                                    @if(auth()->user()->role == 'super-admin')
                                    <x-primary-button><a href="http://127.0.0.1:8000/admin/delete-user/{{ $userLimit->id }}">Delete</a></x-primary-button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <x-primary-button><a href="http://127.0.0.1:8000/view-admin-users">View All</a></x-primary-button>   
                </div>
            </div>
        </div>
    </div>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg table">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Transaction</h1>
                    <table id="projects-tbl" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tx ref</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col2">Amount</th>
                                <th scope="col2">Course</th>
                                <th scope="col2">OPERATIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td colspan="1">{{ $transaction->id }}</td>
                                <td>{{ $transaction->tx_ref ? $transaction->tx_ref : 'Offline' }}</td>
                                <td colspan="1">{{ $transaction->email }}</td>
                                <td>{{ $transaction->payment_status }}</td>
                                <td colspan="1">{{ $transaction->price }}</td>
                                <td colspan="1">{{ $transaction->duration }}hr</td>
                                <td colspan="1">
                                    @if(auth()->user()->role == 'super-admin')
                                    <x-primary-button><a href="http://127.0.0.1:8000/admin/delete-feedback/{{ $transaction->id }}">Delete</a></x-primary-button>
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

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg table">
                <div class="p-6 text-gray-900">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Feedback</h1>
                    <table id="projects-tbl" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Feedback</th>
                                <th scope="col2">OPERATIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedbacks as $feedback)
                            <tr>
                                <td colspan="1">{{ $feedback->id }}</td>
                                <td>{{ $feedback->email }}</td>
                                <td colspan="1">{{ $feedback->name }}</td>
                                <td>{{ $feedback->phone_number }}</td>
                                <td colspan="1">{{ $feedback->message }}</td>
                                <td colspan="1">
                                    <x-primary-button><a href="http://127.0.0.1:8000/view-message/{{ $feedback->id }}">Check</a></x-primary-button>
                                    @if(auth()->user()->role == 'super-admin')
                                    <x-primary-button><a href="http://127.0.0.1:8000/admin/delete-feedback/{{ $feedback->id }}">Delete</a></x-primary-button>
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

    <div class="py-10">
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



