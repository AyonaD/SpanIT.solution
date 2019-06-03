@extends('layouts.admin_app')

@section('content')
        <div class="justify-content-center ">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h5 class="card-title">SpanIT Students Marks</h5>
            </div>
            <div class="card-body">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-8">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#registerStudent">Add Student Marks</a>
                          </div>
                          <div class="col-sm-4 margin-small-top-sm">
                            <form class="form-inline my-2 my-lg-0" action="/search-marks">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                <a href="{{ route('marks.index')}}" type="button" class="btn btn-outline-success my-2 my-sm-0">All</a>
                            </form>
                          </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed table-bordered" id="">
                                <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Student Id</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Age</th>
                                      <th scope="col">Total Marks</th>
                                      <th scope="col">Average Marks</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students_mark_list as $key => $data)
                                        <tr>
                                          <th scope="row">{{ ++$i }}</th>
                                          <td>{{sprintf("%04d", $data->id)}}</td>
                                          <td>{{$data->f_name}} {{$data->l_name}}</td>
                                          <td>{{$data->age}}</td>
                                          <td>
                                            <?php 
                                                if($data->total == null){
                                                    echo "0";
                                                }else{
                                                    echo $data->total;
                                                 }
                                            ?>
                                          </td>
                                          <td>
                                            <?php 
                                                if($data->average == null){
                                                    echo "0";
                                                }else{
                                                    echo $data->average;
                                                 }
                                            ?>
                                          </td>
                                          <td><a href="{{ route('students.show',$data->id)}}" type="button" class="btn btn-info">View</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                      </div>
                      {{ $students_mark_list->links() }}
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="registerStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Register New Students</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ action('MarkController@store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="students">Select Students</label>
                    <select class="form-control" id="student_id" name="student_id">
                        @foreach($students_list as $key => $data)
                            <option value="{{$data->id}}">{{$data->first_name}}</option>
                        @endforeach
                    </select>
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
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>
@endsection
