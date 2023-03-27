<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Department;
use App\Models\Student;
//use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students =Student::all();
      //  return $students;
        return view('admin.students.index' ,['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.students.create', ['departments' =>$departments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $add_student = new Student;
        $add_student->id = $request->id;
        $add_student->name = $request->name;
        $add_student->phone = $request->phone;
        $add_student->email = $request->email;
        $add_student->department_id = $request->department;

        $add_student->save();

        return redirect()->route('students.create')->with('msg' , 'Student Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('admin.students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student_data=Student::find($id);
        $departments=Department::all();
        return view('admin.students.edit', ['student' => $student_data , 'departments' =>$departments ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Student $student)
    {
        $request->validate([
            'id' => ['required','integer',
               Rule::unique('students')->ignore($student->id),
            ],
            'name' => 'required',
            'phone' => ['required','digits:11',
            Rule::unique('students')->ignore($student->id),],
            'email' => [
                'required','email',
                Rule::unique('students')->ignore($student->id),
            ],
        ]);
        $update_student = Student::find($student->id);

        $update_student->id = $request->id;
        $update_student->name = $request->name;
        $update_student->phone = $request->phone;
        $update_student->email = $request->email;
        $update_student->department_id = $request->department;

        $update_student->save();

        return redirect()->route('students.edit',$update_student->id)->with('msg' , 'Student Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::onlyTrashed()->where('id',$id)->first();
        $student->forceDelete();
        return redirect()->route('students.Deleted')->with('msg' , 'Deleted Successfully');
    }
    public function archive($id){
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('students.index')->with('msg' , 'Archived Successfully');
    }
    public function restore($id){
        $student = Student::onlyTrashed()->where('id' , $id)->first();
        $student->restore();
        return redirect()->route('students.index')->with('msg' , 'Restored Successfully');
    }
    public function Deleted(){
        $students = Student::onlyTrashed()->get();
        return view('admin.students.Deleted' , ['students' => $students]);
    }
}
