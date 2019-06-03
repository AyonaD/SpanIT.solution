@extends('layouts.admin_app')

@section('content')

    <div class="justify-content-center">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h5 class="card-title">{{$student->first_name}} {{$student->last_name}}</h5>
            </div>
            <div class="card-body row">
              <div class="col-md-6">
                <form action="{{ route('students.update', $student->id) }}" method="post">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="form-group">
                        <label for="student-id">Student Id</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="" value="{{$student->id}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="frist-name">First Name</label>
                        <input type="text" class="form-control" id="f_name" name="f_name" placeholder="" value="{{$student->first_name}}">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" class="form-control" id="l_name" name="l_name" placeholder="" value="{{$student->last_name}}" >
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" class="form-control" id="age" name="age" placeholder="" value="{{$student->age}}" >
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>
                </form>
              </div>
              <div class="col-md-6 border" style="padding: 10px;">
                <?php 
                  if(count($student_marks) == 0){ ?>
                    <form action="{{ action('MarkController@store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <input type="text" id="subject"  name="student_id" value="{{$student->id}}" hidden>                           
                        </div>
                        @foreach($subjects as $key => $data)
                            <div class="form-group row">
                                <label for="subjectmark" class="col-sm-6 col-form-label">{{$data->subject_name}}</label>
                                <div class="col-sm-6">
                                    <input type="text" id="subject"  name="{{$data->subject_name}}">
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                  <?php
                    }
                  ?>
                  @foreach($student_marks as $key => $data)
                        <div class="row " style="margin: 5px;">
                            <div>
                              <form action="{{ route('marks.update', $data->mark_id)}}" method="post">
                                {{ csrf_field() }}
                                @method('PATCH')
                                <div class="form-group row">
                                  <label for="subjectmark" class="col-sm-3 col-form-label">{{$data->sub_name}}</label>
                                  <div class="col-sm-6">
                                      <input type="text" id="subject"  name="{{$data->id}}" value="{{$data->mark}}">
                                  </div>
                                  <div class="col-md-3">
                                    <button class="btn btn-primary" type="submit" style="border-radius: 0;">Update</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                        </div>
                    @endforeach
              </div>
            </div>
        </div>
    </div>
   
@endsection
