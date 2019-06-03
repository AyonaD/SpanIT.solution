@extends('layouts.admin_app')

@section('content')

    <div class="justify-content-center ">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h5 class="card-title">SpanIT Students</h5>
            </div>
            <div class="card-body">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-8">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#registerStudent">Register New Student</a>
                          </div>
                          <div class="col-sm-4 margin-small-top-sm">
                            <form class="form-inline my-2 my-lg-0" action="/search">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                <a href="{{ route('students.index')}}" type="button" class="btn btn-outline-success my-2 my-sm-0">All</a>
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
                                      <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $key => $data)
                                        <tr>
                                          <th scope="row">{{ ++$i }}</th>
                                          <td>{{sprintf("%04d", $data->id)}}</td>
                                          <td>{{$data->first_name}} {{$data->last_name}}</td>
                                          <td>{{$data->age}}</td>
                                          <td>
                                            <div class="row" style="width: 100%; border: none;">
                                                <a href="{{ route('students.show',$data->id)}}" type="button" class="btn btn-info">View</a>
                                                <a href="{{ route('students.edit',$data->id)}}" type="button" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('students.destroy', $data->id)}}" method="post" onsubmit="return confirm('Do you really want to Delete the student?');">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="btn btn-danger" type="submit" style="border-radius: 0;">Delete</button>
                                                </form>
                                            </div>
                                          </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                      </div>
                      {{ $students->links() }}
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
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div><br />
            @endif
            <form action="{{ action('StudentsController@store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="frist-name">First Name</label>
                    <input type="text" class="form-control" id="f_name" name="f_name" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" class="form-control" id="l_name" name="l_name" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" placeholder="" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>
@endsection
