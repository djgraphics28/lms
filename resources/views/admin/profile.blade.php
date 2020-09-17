@extends('admin.template.master')

@section('main_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Profile
        {{-- <small>it all starts here</small> --}}
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                @if (isset($data))
                @foreach ($data as $item => $value)
                @endforeach
                @endif
                <!-- Profile Image -->
                <div class="box box-primary">
                <div class="box-body box-profile">
                    @if(isset($value) && $value->user_profile_pic != null)
                    <img src="{{ $base_url.'/public/images/'.$value->user_profile_pic }}" class="profile-user-img img-responsive" id="prof_pic" src="" alt="User profile picture" style="width:200px;height:200px;"/>
                    @else
                    <img src="{{ asset('public/dist/img/images.png') }}" class="profile-user-img img-responsive" id="prof_pic" src="" alt="User profile picture" style="width:200px;height:200px;"/>
                    @endif

                    <h5 class="profile-username text-center" id="profile-username">{{ Auth::user()->name }}</h5>

                    <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Age</b> <a class="pull-right" id="prof-age">{{ isset($value) ? date_diff(date_create($value->user_birthdate), date_create('now'))->y.' years old' : '' }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Birthday</b> <a class="pull-right" id="prof-bday">{{ isset($value) ? $value->user_birthdate : '' }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Gender</b> <a class="pull-right" id="prof-gender">{{ isset($value) ? $value->user_gender : '' }}</a>
                    </li>
                    </ul>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab" aria-expanded="false">Info</a></li>
                    <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="info">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Civil Status</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly="" value="{{ isset($value) ? $value->civil_status : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly="" value="{{ isset($value) ? $value->user_address : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Street</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly="" value="{{ isset($value) ? $value->user_street : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Barangay</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly="" value="{{ isset($value) ? $value->brgy : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Phone Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly="" value="{{ isset($value) ? $value->user_mobile_num : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Telephone Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly="" value="{{ isset($value) ? $value->user_phone_num : '' }}">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <form action="{{ url('change-password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Old Password</label>
                                <input type="password" name="old_password" id="old_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Confirm New Password</label>
                                <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control">
                            </div>
                            <span class="text-right">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </span>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>

    </section>
    <!-- /.content -->
@endsection

@section('js')
@if (session()->has('message'))
    <script>
        toastr.success("{{session()->get('message')}}", 'Success!');
    </script>
@endif
@endsection
