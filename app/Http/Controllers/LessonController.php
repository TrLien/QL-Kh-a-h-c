<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;

class LessonController extends Controller
{
    // danh sách theo khóa học
    public function index($course_id)
    {
        $course = Course::findOrFail($course_id);

        $lessons = Lesson::where('course_id',$course_id)
            ->orderBy('order')
            ->get();

        return view('lessons.index',compact('course','lessons'));
    }

    // thêm
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required'
        ]);

        Lesson::create($request->all());

        return back();
    }

    // xóa
    public function destroy($id)
    {
        Lesson::find($id)->delete();
        return back();
    }
}