<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // Danh sách + search + paginate
    public function index(Request $request)
    {
        $query = Course::withCount('lessons')
                       ->with('enrollments');

        // search theo tên
        if($request->name){
            $query->where('name','like','%'.$request->name.'%');
        }

        // lọc theo trạng thái
        if($request->status){
            $query->where('status',$request->status);
        }

        $courses = $query->paginate(5);

        return view('courses.index',compact('courses'));
    }

    // form thêm
    public function create()
    {
        return view('courses.create');
    }

    // lưu
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required|numeric|min:1'
        ]);

        $data = $request->all();

        // slug tự sinh
        $data['slug'] = Str::slug($request->name);

        // upload ảnh
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'),$name);
            $data['image'] = $name;
        }

        Course::create($data);

        return redirect('/courses');
    }

    // form sửa
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit',compact('course'));
    }

    // update
    public function update(Request $request,$id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'name'=>'required',
            'price'=>'required|numeric|min:1'
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'),$name);
            $data['image'] = $name;
        }

        $course->update($data);

        return redirect('/courses');
    }

    // xóa (soft delete)
    public function destroy($id)
    {
        Course::find($id)->delete();
        return back();
    }

    // khôi phục
    public function restore($id)
    {
        Course::withTrashed()->find($id)->restore();
        return back();
    }
}