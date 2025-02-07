<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Transactions;

class CourseController extends Controller
{
    public function createCourse(Request $request)
    {

        $validate = $request->validate([
            'duration' => 'required|string',
            'level' => 'required|string',
            'discount_percent' => 'required|integer'
        ]);
    
        $price = 100;
        $pricePerDuration = $price * $request->duration;
    
        $checkCourse = Course::where('duration', $request->duration)->first();
    
        if ($checkCourse) {
            return response()->json([
                'message' => 'Course already exists',
                'status' => false
            ], 403);
        }
    
        $discountPercent = $request->discount_percent ?? 0;
        $percent = ($discountPercent / 100) * $pricePerDuration;
        $discountPrice = $pricePerDuration - $percent;
    
        $newCourse = Course::create([
            'duration' => $validate['duration'],
            'level' => $validate['level'],
            'price' => $pricePerDuration,
            'discount_price' => $discountPrice
        ]);

        return redirect()->route('dashboard')->with('success-course', 'Course created successfully');
    }
    


    public function viewCourses(){
        $courses = Course::all();

        return response()->json([
            'message' => 'courses retrieved successfully',
            'courses' => $courses
        ]);
    }

    public function viewCoursesByLevel($level){

        $courses = Course::where('level', $level)->get();

        return response()->json([
            'message' => 'courses retrieved successfully',
            'courses' => $courses
        ]);
    }

    public function viewCoursesByDuration($duration){

        $courses = Course::where('duration', $duration)->get();

        return response()->json([
            'message' => 'courses retrieved successfully',
            'courses' => $courses
        ]);
    }

    public function getCourseById($id)
    {
        // Fetch the course by ID
        $courseById = Course::find($id);
    
        // Check if the course was found
        if ($courseById) {
            return response()->json([
                'message' => 'Course retrieved successfully',
                'course' => $courseById
            ], 200);
        } else {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }
    }

    public function updateDiscount(Request $request,)
    {

        $request->validate([
            'discount_percent' => 'required|integer',
            'course_id' => 'required|integer',
        ]);


        $course = Course::find($request->course_id);

        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }

        $course_price = $course->price;

        $percent = ($request->discount_percent / 100) * $course_price;

        $discount_price = $course_price - $percent;

        $course->discount_price = $discount_price;

        $course->save();

        return response()->json([
            'message' => 'Course updated successfully',
            'course' => $course
        ], 200);
    }


    public function viewEnrolledStudents(){
        $students = Transactions::where('payment_status', 'success')
        ->where('course_status', 1)->get();

        return response()->json([
            'message' => 'data retrieved successfully',
            'students' => $students
        ]);
    }
    
    public function deleteCourse($id){
        $course = Course::findOrFail($id);

        $course->delete();

        return redirect()->route('dashboard')->with('success-delete-course', 'course deleted successfully');
    }

}
