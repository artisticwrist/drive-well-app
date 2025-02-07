<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Feedback;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\UserServices;

class AdminController extends Controller
{
    //]

    public function adminDashboard(){
        $userCount = User::count();
        $courseCount = Course::count();
        $adminCount = User::where('is_admin', 1)->count();
        $activeStudentCount = User::where('subscription_status', 1)->count();
        $courses = Course::limit(5)->get();
        $feedbacks = Feedback::all();
        $usersLimit = User::limit(5)->get();
        $transactions = Transactions::limit(5)->get();

        return view('dashboard', ['transactions' => $transactions, 'userCount' => $userCount,'courseCount' => $courseCount, 'adminCount' => $adminCount, 'activeStudentCount' => $activeStudentCount,'courses' => $courses, 'feedbacks' => $feedbacks, 'usersLimit' => $usersLimit ]);
    }

    public function createAdmin(Request $request){
        $request->validate([
            'email'=> 'bail|required|email|unique:users,email',
            'name'=> 'string|required',
            'role' => 'string|in:super-admin,admin',
        ]);


        $password = rand(100000, 999999);

      User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'subscription_status' => 0,
            'is_admin' => 1,
            'phone_number' => null,
            'password' => Hash::make($password),
        ]);

        $email_data = [
            'email' => $request->email,
            'password'  => $password
        ];

       Mail::to($request->email)->send(new \App\Mail\CreateAdmin($email_data));
        
        return redirect()->route('dashboard')->with('success', 'Admin created successfully');
    }


    public function veiwAdmins(){
        $admins = Admin::all();

        return $admins;
    }

    public function viewUsers(){
        $users = User::all();

        return $users;
    }

    public function updateAdminDet(Request $request){
        
        $request->validate([
            'id' => 'required',
            'role' => 'sometimes|string', 
            'password' => 'sometimes|string', 
        ]);  

        $admin = Admin::find($request->id);

        if ($request->filled('role')) {
            $admin->role = $request->input('role');
        }
    
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Admin details updated successfully.',
            'admin' => $admin
        ]);


    }

    public function updateUserDet(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'id' => 'required',
            'name' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|integer' , 
            'password' => 'sometimes|string|min:8|confirmed', 
        ]);

        $user = User::find($request->id);

        // Check which inputs are provided and update only those fields
        if ($request->filled('name')) {
            $user->name = $request->input('name');
        }
    
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->filled('phone_number')) {
            $user->phone_number = $request->input('phone_number'); 
        }
    
        // Save the updated user details
        $user->save();
    
        // Return a success response or redirect
        return response()->json([
            'success' => true,
            'message' => 'User details updated successfully.',
            'user' => $user
        ]);
    }


    public function loginAdmin(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $request->email)->first();


        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'message' => 'Invalid login credentials',
            ], 401);
        }

        $token = $admin->createToken('access_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'admin' => $admin,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {

        $admin = Auth::user();

        $request->user()->currentAccessToken()->delete();

    
        return response()->json([
            'message' => 'Logout successful'
        ], 200);
    }

    public function changeUserStatus(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);
        $user->subscription_status = 0;

        $user->save();

        return response()->json([
            'message' => 'user status updated successfully',
            'success' => true,
            'user' => $user
        ]);

    }
    

    public function createUser(Request $request){
           
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users', 
            'phone_number' => 'required',
            'subscription_status' => 'required|in:1,0',
            'duration' => 'required|string',
            'amount' => 'required'
        ]);

        $createRecord = new UserServices($data);

        $user = $createRecord->createUser();

        return $createRecord->transaction($user);

    }

    public function viewUsersAdmin() {

        $users = User::all();
        return view('view-admin-users', ['users' => $users]);

    }

    public function viewCoursesAdmin(){
        $courses = Course::all();
        return view('view-admin-courses', ['courses' => $courses]);
    }

    public function feedbackFull($id){
        $feedback = Feedback::findOrFail($id);
        return view('view-message', ['feedback' => $feedback]);
    }

    public function deleteFeedback($id){
        $feedback = Feedback::findOrFail($id);

        $feedback->delete();

        return redirect()->route('dashboard')->with('success-delete-feedback', 'feedback deleted successfully');
    }
}
