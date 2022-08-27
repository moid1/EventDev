@extends('admin.layout')
@section('title')
    All Users
@endsection
@section('content')
    <div class="page-content-wrapper ">
        <div class="container-fluid">
            <div class="page-content-wrapper ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-20">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">All Users </h4>
                                    <p class="text-muted m-b-30 font-14"></p>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr.no</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th> Role</th>
                                                <th>Phone</th>
                                                <th>Created Date</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $key => $user)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td><span class="badge badge-danger">{{ $user->role }}</span></td>
                                                    <td>{{ $user->phone_number }}</td>
                                                    <td>{{ $user->created_at->toDateString() }}</td>
                                                    <td>
                                                        @if ($user->is_block == 'true')
                                                            <a href="{{url('unblock-user',$user->id)}}" class="btn btn-primary "><i
                                                                    class="fa fa-unlock" title="unblock user"></i></a>
                                                        @else
                                                            <a href="{{url('block-user',$user->id)}}" class="btn btn-primary "><i
                                                                    class="fa fa-ban" title="block user"></i></a>
                                                        @endif



                                                    </td>
                                                    {{-- <td><img src="{{asset($user->image)}}" width="50" height="50" />
                                                <style>
                                                    img {
                                                        border: ;
                                                    }
                                                </style>
                                            </td> --}}
                                                    {{-- <td>
                                                @if ($user->assment_status == '0') 
                                                <a href="{{route('approve_test',$user->id)}}" class="btn btn-danger btn-xs">Approve</a>

                                                @else
                                                <a href="{{route('unapprove_test',$user->id)}}" class="btn btn-success btn-xs">UnApprove</a>
                                                @endif
                                            </td> --}}


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
