<?php

namespace SpanIT\Http\Controllers;

use Illuminate\Http\Request;
use SpanIT\Model\Student;
use SpanIT\Model\Subject;
use SpanIT\Model\Mark;
use DB;
class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(5);
        $subjects = Subject::all();
        return view('students_details', ['students' => $students,'subjects' => $subjects,'i'=>(request()->input('page', 1) - 1) * 5]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = Student::create(['first_name' => $request->f_name,
            'last_name' => $request->l_name,
            'age' => $request->age]);
        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student_marks = DB::table('subjects')
            ->leftJoin('marks', 'subjects.id', '=', 'marks.subject_id')
            ->select('subjects.id AS id','subjects.subject_name AS sub_name','marks.mark AS mark','marks.id AS mark_id')
            ->where('student_id', $id)
            ->get();

        $student = Student::findOrFail($id);
        $subjects = Subject::all();

        return view('view_student_details', compact('student'),['student_marks'=>$student_marks, 'subjects'=>$subjects]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);

        return view('edit-student', compact('student'));  

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->first_name = $request->f_name;
        $student->last_name = $request->l_name;
        $student->age = $request->age;
        $student->save();
        
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect('/students')->with('success', 'students is successfully deleted');
    }

    public function search(Request $request){
        $search = $request->search;
        $students = Student::where('id', 'LIKE', "%$search%")->orWhere('first_name', 'LIKE', "%$search%")->orWhere('last_name', 'LIKE', "%$search%")->paginate(3);
        return view('students_details', ['students' => $students,'i'=>(request()->input('page', 1) - 1) * 10]);
    }
}
