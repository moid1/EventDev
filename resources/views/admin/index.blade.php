@extends('admin.layout')

@section('title')
    Dashboard
@endsection
@section('content')
    {{-- <div class="page-content-wrapper mt-4">
    <div class="container-fluid">
        <div class="row ">
            
            <div class="col-md-6 col-lg-4 ">
                <a href="{{url('slottime')}}">
                    <div style="background:white " class="mini-stat clearfix ">
                        <span class="mini-stat-icon"  style="border-radius:10%;background:#c43832"><i class="mdi mdi-clock "></i></span>
                        <div class="mini-stat-info text-center" style="color:black">
                           <h5 > Slot timing </h5>
                           <h6>{{App\Models\Slottime::count()}}</h6>
                            
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 ">
            <a href="{{url('appointment')}}">  
                    <div style="background:white " class="mini-stat clearfix ">
                        <span class="mini-stat-icon" style="border-radius:10%;background:#89A839"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <div class="mini-stat-info text-center " style="color:black">
                            <h6>All Appointments</h6>
                          <h6>{{App\Models\Appointment::count()}}</h6>
                            
                        </div>
                    </div>
                </a>
            </div>             
            <div class="col-md-6 col-lg-4 ">
            <a href="">  
                    <div style="background:white " class="mini-stat clearfix ">
                        <span class="mini-stat-icon" style="border-radius:10%;background:#89A839"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <div class="mini-stat-info text-center " style="color:black">
                            <h6>All</h6>
                          <h6>0001</h6>
                            
                        </div>
                    </div>
                </a>
            </div>            

    </div>
    <div class="row">

        <div class="col-12"><br>
           <center><img src="images/logo1.jpg" height="160" alt=""></center> 
        </div>

    </div>
</div> --}}
    <div class="page-content-wrapper ">

        <div class="container-fluid">
            @if (Auth::User()->role == 'admin')
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-cart-outline"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">{{ $totalUsers ?? '0' }}</span>
                                Total User
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-currency-usd"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">{{ $totalEvents ?? '0' }}</span>
                                Total Events
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-cube-outline"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">{{ $lastMonthUsers ?? '0' }}</span>
                                Last Month Users
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-currency-btc"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">{{ $lastMonthEvents ?? '0' }}</span>
                                Last Month Event
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">







                </div>
                <!-- end row -->
                <div class="row">

                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <h4 class="mt-0 m-b-15 header-title"> Latest Users</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>IP Address</th>
                                                <th>Role</th>
                                                {{-- <th>Start date</th>
                                    <th>Salary</th> --}}
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($latestUsers as $userData)
                                                <tr>
                                                    <td>{{$userData->name}}</td>
                                                    <td>{{$userData->email}}</td>
                                                    <td><span class="badge badge-danger">{{$userData->ip_address}}</span></td>
                                                    <td>{{$userData->role}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @elseif(Auth::User()->role=='doctor')
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-cart-outline"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">0000</span>
                                Coming Soon
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-currency-usd"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">0000</span>
                                Coming Soon
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-cube-outline"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">0000</span>
                                coming soon
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-currency-btc"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">0000</span>
                                coming soon
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-cart-outline"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">0000</span>
                                Coming Soon
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="mini-stat clearfix bg-primary">
                            <span class="mini-stat-icon"><i class="mdi mdi-currency-usd"></i></span>
                            <div class="mini-stat-info text-right text-white">
                                <span class="counter">0000</span>
                                Coming Soon
                            </div>
                        </div>
                    </div>


                </div>
            @endif
            <!-- end row -->

        </div><!-- container-fluid -->


    </div>
@endsection
{{-- <td><span class="badge badge-primary">Active</span></td> --}}
