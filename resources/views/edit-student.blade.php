@extends('layouts.admin_app')

@section('content')

    <div class="justify-content-center ">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h5 class="card-title">Edit Students</h5>
            </div>
            <div class="card-body">
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
                      <input type="text" class="form-control" id="l_name" name="l_name" placeholder="" value="{{$student->last_name}}">
                  </div>
                  <div class="form-group">
                      <label for="age">Age</label>
                      <input type="text" class="form-control" id="age" name="age" placeholder="" value="{{$student->age}}">
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary">Update Student</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
   
@endsection
