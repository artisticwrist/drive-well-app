<?php

namespace App\Services;

use App\Models\Transactions;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserServices {

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function createUser(){

        $password = rand(0000000, 9999999);
    
        // Create the user
        $user = User::create([
            'email' => $this->data['email'],
            'name' => $this->data['name'],
            'phone_number' => $this->data['phone_number'],
            'subscription_status' => $this->data['subscription_status'],
            'role' => "student",
            'is_admin' => 0,
            'password' => Hash::make($password),
            'duration' => $this->data['duration']
        ]);

        return $user ? $user : false;
    }

    public function transaction($user){

        Transactions::create([
            'course_id' => null,
            'email' => $user->email,
            'price' => $this->data['amount'],
            'payment_status' => 'success',
            'tx_ref' => null,
            'duration' => $this->data['duration'],
            'course_status' => null
        ]);

        //  Mail::to($validated['email'])->send(new \App\Mail\RegisterSuccessAdmin($email_data));
    
        // Return a success response
        return redirect()->route('dashboard')->with('success-user', 'user created successfully');
    }
}