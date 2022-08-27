@extends('admin.layout')
@section('title')
 Issue Types
@endsection
@section('content')
    <div class="page-content-wrapper ">
        <div class="container-fluid">
            <div class="page-content-wrapper ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form class="" action="{{ url('addBugType') }}" method="POST">
                                @csrf
                                <div class="row">
                            
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label style="color: black"><strong>Enter Issue Type </strong>
                                            </label>
                                            <input type="text" class="form-control" name="name" placeholder="Bug Type"
                                                required>
                                        </div>
                                    </div>
                            
                                </div>
                                <div class="form-group">
                                    <div>
                                        <button type="submit" style="border: none"
                                            class="btn btn-warning bg-primary waves-effect waves-light">
                                            Submit
                                        </button>
                            
                                    </div>
                                </div>
                            </form>
                            
                            <div class="card m-b-20">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Issue Types</h4>
                                    <p class="text-muted m-b-30 font-14"></p>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Type</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($issueTypes as $key => $type)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $type->name }}</td>
                                 

                                                    <td> <a href="{{ url('deleteBugType/' . $type->id) }}"><i
                                                                class="fa fa-trash " style="color: red"></i></a> </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
