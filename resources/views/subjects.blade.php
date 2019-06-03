@extends('layouts.admin_app')

@section('content')

    <div class="justify-content-center ">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h5 class="card-title">SpanIT Subjects</h5>
            </div>
            <div class="card-body">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-8">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#registerStudent">Add New Subject</a>
                          </div>
                          <div class="col-sm-4 margin-small-top-sm">
                            <form class="form-inline my-2 my-lg-0" action="">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                <a href="" type="button" class="btn btn-outline-success my-2 my-sm-0">All</a>
                            </form>
                          </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed table-bordered" id="">
                                <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Subject Id</th>
                                      <th scope="col">Subject Name</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $key => $data)
                                        <tr>
                                          <th scope="row">{{ ++$i }}</th>
                                          <td>{{sprintf("%04d", $data->id)}}</td>
                                          <td>{{$data->subject_name}}</td>
                                          <td>
                                            <div class="row" style="width: 100%; border: none;">
                                                <form action="{{ route('subject.destroy', $data->id)}}" method="post" onsubmit="return confirm('Do you really want to Delete the Subject?');">
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
                      {{ $subjects->links() }}
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
            <h5 class="modal-title" id="exampleModalLabel">Add New Students</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ action('SubjectController@store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="frist-name">Subject Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>
@endsection
