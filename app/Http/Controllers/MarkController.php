<?php

namespace SpanIT\Http\Controllers;

use Illuminate\Http\Request;
use SpanIT\Model\Mark;
use SpanIT\Model\Student;
use SpanIT\Model\Subject;
use DB;
use Illuminate\Database\Eloquent\Collection;
class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks_list = DB::table('students')
            ->leftJoin('marks', 'students.id', '=', 'marks.student_id')
            ->select('students.id AS id','students.age AS age','students.first_name AS f_name','students.last_name AS l_name',DB::raw('sum(marks.mark) AS total'),DB::raw('avg(marks.mark) AS average'))
            ->groupBy('students.id')
            ->paginate(5);

        $subjects = Subject::all();
        $marks = Mark::all();
        $stu = Student::all();
        return view('students_marks', ['students_mark_list'=>$marks_list,'students_list' => $stu,'subjects' => $subjects,'i'=>(request()->input('page', 1) - 1) * 5]);
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
        $subjects = Subject::all();
        $data = array();    //initialize a valiable as an array

        foreach ( $subjects as $subject ) {
            $subject_name = $subject->subject_name;
            $data[] =  array(
                'student_id'         => $request->student_id,
                'subject_id'       => $subject->id,
                'mark'      => $request->$subject_name
            );
        }
        Mark::insert($data); 
        return redirect('/marks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $mark = Mark::find($id);
        $subjects = Subject::all();
        $sub_id = $mark->subject_id;
        $mark->mark = $request->$sub_id;
        $mark->save();
        return redirect('/marks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request){
        $search = $request->search;
        $marks_list = DB::table('students')
            ->leftJoin('marks', 'students.id', '=', 'marks.student_id')
            ->select('students.id AS id','students.age AS age','students.first_name AS f_name','students.last_name AS l_name',DB::raw('sum(marks.mark) AS total'),DB::raw('avg(marks.mark) AS average'))
            ->where('students.id', 'LIKE', "%$search%")
            ->orWhere('students.first_name', 'LIKE', "%$search%")
            ->orWhere('students.last_name', 'LIKE', "%$search%")
            ->groupBy('students.id')
            ->paginate(3);

        $subjects = Subject::all();
        $marks = Mark::all();
        $stu = Student::all();
        return view('students_marks', ['students_mark_list' => $marks_list,'students_list' => $stu,'subjects' => $subjects,'i'=>(request()->input('page', 1) - 1) * 3]);
    }
}
