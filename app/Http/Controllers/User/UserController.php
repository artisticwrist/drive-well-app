<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Hash;


use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
    
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users', 
            'phone_number' => 'required',
            'password' => 'required|confirmed|min:8',
            'address'     => 'sometimes|string',
        ]);
    
        // Create the user
        $user = User::create([
            'email' => $validated['email'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'] ?? null,
            'subscription_status' => false,
            'role' => "user",
            'is_admin' => 0,
            'password' => Hash::make($validated['password']),
        ]);


        Mail::to($validated['email'])->send(new \App\Mail\RegisterSuccess());
    
        // Return a success response
        return response()->json([
            'message' => 'User registration successful',
            'user' => $user
        ], 201);
    }
    

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid login credentials',
            ], 401);
        }

        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {

        $user = Auth::user();

        $request->user()->currentAccessToken()->delete();

    
        return response()->json([
            'message' => 'Logout successful'
        ], 200);
    }

    public function sendFeedback(Request $request)
    {

        $fields = $request->validate([
            'email' => 'required',
            'name' => 'required',
            'phone_number' => 'required',
            'feedback' => 'required',
        ]);



        Feedback::create([
            'email' => $request->email,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'message' => $request->feedback,
        ]);


        //Create a new feedback record
        try {


            Feedback::create([
                'email' => $request->email,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'message' => $request->feedback,
            ]);

            Mail::to($fields['email'])->send(new \App\Mail\FeedbackMail());

            // Return JSON response indicating success
            return redirect()->route('home')->with('success-contact', 'feedback sent successfully');

        } catch (\Exception $e) {
            // Return JSON response indicating failure
            return response()->json([
                'error' => 'Failed to send feedback',
                'message' => $e->getMessage(),
            ], 500);
        }
    } 

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name'  => 'sometimes|string',
            'last_name'  => 'sometimes|string',
            'email'           => 'sometimes|string', 
            'phone_number'     => 'sometimes|string',
            'address'     => 'sometimes|string',
        ]);

 
        $user = User::findOrFail($id);

        $user->update($request->only([
            'first_name',
            'last_name',
            'phone_number',
            'email',
            'address'
        ]));
    


        return response()->json([
            'message' => 'update user successful',
            'user' => $user
        ], 200);
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('dashboard')->with('success-delete-user', 'user deleted successfully');
    }

    public function userData(Request $request) {
        $validatedData = $request->validate([
            'user_id' => 'bail|exists:users,id', // Fixed typo
        ]);
    
        // Find user or fail (Laravel automatically returns 404 if not found)
        $user = User::findOrFail($validatedData['user_id']);
    
        return response()->json([
            'message' => 'User retrieved successfully',
            'user' => $user
        ], 200);
    }
    

}
