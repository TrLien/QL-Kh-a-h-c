<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentController extends Controller
{
    // danh sách
    public function index()
    {
        $courses = Course::withCount('enrollments')->get();
        return view('enrollments.index',compact('courses'));
    }

    // đăng ký
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email'
        ]);

        // tạo student
        $student = Student::firstOrCreate(
            ['email'=>$request->email],
            ['name'=>$request->name]
        );

        // ❌ không cho trùng
        $exists = Enrollment::where('course_id',$request->course_id)
            ->where('student_id',$student->id)
            ->exists();

        if($exists){
            return back()->with('error','Đã đăng ký rồi!');
        }

        Enrollment::create([
            'course_id'=>$request->course_id,
            'student_id'=>$student->id
        ]);

        return back();
    }
}