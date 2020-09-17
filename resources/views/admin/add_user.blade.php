@extends('admin.template.master')

@section('main_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ url('/admin-users') }}">
            <button type="button" class="btn btn-default btn-sm">Go Back</button>
        </a>

        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><i class="fa fa-users"></i> Users</li>
            <li class="active">Add User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add User</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ url('/save-user') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="box-body">
                    <div class="row">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    @if (isset($user))
                    @foreach ($user as $row => $value)
                    @endforeach
                    @endif
                    <input type="hidden" name="up_id" id="up_id" value="{{ isset($user) ? $value->id : '' }}">
                    <input type="hidden" name="id" id="id" value="{{ isset($user) ? $value->user_id : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2 text-center">
                                <div class="effect7" id="profile-container" style="width:200px;height:200px;">
                                    @if(isset($user) && $value->user_profile_pic != null)
                                    <img id="profileImage" src="{{ $base_url.'/public/images/'.$value->user_profile_pic }}" style="width:200px;height:200px;" />
                                    @else
                                    <img id="profileImage" src="{{ asset('public/dist/img/images.png') }}" style="width:200px;height:200px;" />
                                    @endif
                                </div>
                                <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" capture style="display:none;">
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <span style="color:red;">*</span></label>
                                        <input type="text" name="name" id="name" required class="form-control" style="text-transform: capitalize;" placeholder="Juan De La Cruz" value="{{ isset($user) ? $value->name : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email <span style="color:red;">*</span></label>
                                        <input type="email" name="email" id="email" required class="form-control" placeholder="test@email.com" value="{{ isset($user) ? $value->email : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birthdate <span style="color:red;">*</span></label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" name="birthdate" id="datepicker" value="{{ isset($user) ? $value->user_birthdate : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Civil Status <span style="color:red;">*</span></label>
                                        <select name="civil_status" id="civil_status" class="form-control select2"  style="width: 100%;">
                                            <option selected disabled>Select Status</option>
                                            @foreach ($civil_status as $item)
                                                <option value="<?= $item->id ?>" {{ isset($user) && $value->user_civil_status == $item->id ? 'selected' : '' }}><?= $item->name ?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Gender <span style="color:red;">*</span></label>
                                        <div class="row col-md-offset-1">
                                            <input type="radio" name="gender" value="Male" class="minimal" checked="{{ isset($user) && $value->user_gender == 'Male' ? 'true' : 'false' }}">
                                            <i class="fa fa-male"></i> | Male
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="gender" value="Female" class="minimal" checked="{{ isset($user) && $value->user_gender == 'Female' ? 'true' : 'false' }}">
                                            <i class="fa fa-female"></i> | Female
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User Type <span style="color:red;">*</span></label>
                                        <select name="user_type" id="user_type" class="form-control select2"  style="width: 100%;">
                                            <option selected disabled>Select User Type</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Normal User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ isset($user) ? $value->user_address : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Street</label>
                                    <input type="text" name="street" id="street" class="form-control" value="{{ isset($user) ? $value->user_street : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Barangay</label>
                                    <select name="brgy" id="brgy" class="form-control select2" style="width: 100%;">
                                            <option selected disabled>Select Barangay</option>
                                            @foreach ($barangays as $item)
                                                <option value="<?= $item->id ?>" {{ isset($user) && $value->user_brgy == $item->id ? 'selected' : '' }}><?= $item->name ?></option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mobile Number</label>
                                    <input type="text" name="mobile_num" id="mobile_num" class="form-control" data-inputmask='"mask": "(0999) 999-9999"' data-mask value="{{ isset($user) ? $value->user_mobile_num : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone_num" id="phone_num" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ isset($user) ? $value->user_phone_num : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                    <span><button type="submit" class="btn btn-primary">Save</button></span>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

@section('js')
@if (session()->has('message'))
    @if (session()->get('message') == 'success')
        <script>
            toastr.success('Successfully Save.', 'Success!');
        </script>
    @endif
@endif
<script>
    $(document).ready(function(){

        $("#profileImage").click(function(e) {
            $("#imageUpload").click();
        });

        function fasterPreview( uploader ) {
            if ( uploader.files && uploader.files[0] ){
                $('#profileImage').attr('src',
                    window.URL.createObjectURL(uploader.files[0]) );
            }
        }

        $("#imageUpload").change(function(){
            fasterPreview( this );
        });

        /* datepicker initialization */
        $('#datepicker').datepicker({
            autoclose: true,
        }); /* datepicker initialization */

        /* datatable initialization */
        $('#contributions_tbl').DataTable(); /* datatable initialization */

        $("#btn-edit").on('click', function() {
            $.ajax({
                url: "{{ url('/get-pension-data') }}",
                type: "POST",
                data: {'c_id': $(this).attr('data-id'),'_token': $('meta[name="csrf-token"]').attr('content')},
                success: function(items) {
                    $("#senior_id").val(items.user[0].senior_id).trigger('change');
                    $("#contribution").val(items.user[0].pension_amount);
                    $("#id").val(items.user[0].id);
                    $("#modal-station").modal('show');
                }
            });
        });

        $("#btn-del").on('click', function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('/admin-del-pension') }}",
                        type: "POST",
                        data: {'data': $(this).attr('data-id'),'_token': $('meta[name="csrf-token"]').attr('content')},
                        success: function(items) {
                            if(items.status != 500)
                            {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    type: 'success',
                                    showConfirmButton: true,
                                }).then((result) => {
                                    if(result.value){
                                        window.location = "{{ $base_url }}" + "/admin-senior-pension";
                                    }
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Oops! Something went wrong',
                                    'error'
                                )
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
