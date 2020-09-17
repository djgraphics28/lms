@extends('admin.template.master')

@section('main_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ url('/admin-record') }}">
            <button type="button" class="btn btn-default btn-sm">Go Back</button>
        </a>

        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="">Senior Citizen Records</li>
            <li class="active">Edit Record</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>

            <form id="add_station" method="POST" action="{{ url('/update-record') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    @foreach($records as $row)
                    <input type="hidden" name="id" value="{{ $row->id }}">
                    <input type="hidden" name="unique_id_num" value="{{ $row->unique_id_num }}">
                    <input type="hidden" name="pic" value="{{ $row->profile_pic }}">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div id="profile-container" style="width:200px;height:200px;">
                                @if($row->profile_pic != null || $row->profile_pic != "")
                                <img id="profileImage" src="{{ $base_url.'/'.$row->profile_pic }}" style="width:200px;height:200px;" />
                                @else
                                <img id="profileImage" src="{{ asset('public/dist/img/images.png') }}" style="width:200px;height:200px;" />
                                @endif
                            </div>
                            <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" capture style="display:none;">
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">First Name <span style="color:red;">*</span></label>
                                    <input type="text" name="fname" id="fname" value="{{ $row->fname }}" required class="form-control" style="text-transform: capitalize;"" placeholder="Juan">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">M.I <span style="color:red;">*</span></label>
                                    <input type="text" name="mname" id="mname" value="{{ $row->mname }}" required class="form-control" style="text-transform: capitalize;" placeholder="A">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Last Name <span style="color:red;">*</span></label>
                                    <input type="text" style="text-transform: capitalize;" value="{{ $row->lname }}" name="lname" id="lname" required class="form-control" placeholder="Cruz">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Extension Name <span style="color:red;">*</span></label>
                                    <input type="text" style="text-transform: capitalize;" value="{{ $row->ename }}" name="ename" id="ename" class="form-control" placeholder="Cruz">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Birthdate <span style="color:red;">*</span></label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right"  value="{{ date('m/d/Y',strtotime($row->birthdate)) }}" name="birthdate" id="datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Civil Status <span style="color:red;">*</span></label>
                                    <select name="civil_status" id="civil_status" class="form-control select2"  style="width: 100%;">
                                        @foreach ($civil_status as $item)
                                            <option value="<?= $item->id ?>" selected="{{ !empty($row->civil_status) ? 'selected' : '' }}"><?= $item->name ?></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Gender <span style="color:red;">*</span></label>
                                    <div class="row col-md-offset-1">
                                        <input type="radio" name="gender" value="Male" class="minimal" checked="{{ $row->gender == 'Male' ? 'true' : 'false' }}">
                                        <i class="fa fa-male"></i> | Male
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="gender" value="Female" class="minimal" checked="{{ $row->gender == 'Female' ? 'true' : 'false' }}">
                                        <i class="fa fa-female"></i> | Female
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Address <span style="color:red;">*</span></label>
                                <input type="text" name="address" value="{{ $row->address }}" id="address" style="text-transform: capitalize;" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Barangay <span style="color:red;">*</span></label>
                                <select name="barangay" id="barangay" class="form-control select2" style="width: 100%;">
                                    @foreach ($barangays as $item)
                                        <option value="<?= $item->id ?>" selected="{{ !empty($row->barangay) ? 'selected' : '' }}"><?= $item->name ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Street</label>
                                <input type="text" name="street" id="street" value="{{ $row->street }}" class="form-control" style="text-transform: capitalize;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone_num" id="phone_num" value="{{ !empty($row->phone_num) ? $row->phone_num : '' }}" class="form-control" data-inputmask='"mask": "(0999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Telephone Number</label>
                                <input type="text" name="tel_num" id="tel_num" value="{{ !empty($row->tel_num) ? $row->tel_num : '' }}" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <h4><b><i>Contact Person</i></b></h4>
                    @foreach($contact_person as $cs)
                    <input type="hidden" name="cs_id" value="{{ $cs->id }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">First Name <span style="color:red;">*</span></label>
                                <input type="text" name="cp_fname" id="cp_fname" value="{{ $cs->cp_fname }}" required style="text-transform: capitalize;" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Middle Name <span style="color:red;">*</span></label>
                                <input type="text" name="cp_mname" id="cp_mname" value="{{ $cs->cp_mname }}" required style="text-transform: capitalize;" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Last Name <span style="color:red;">*</span></label>
                                <input type="text" name="cp_lname" id="cp_lname" value="{{ $cs->cp_lname }}" required style="text-transform: capitalize;" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Last Name <span style="color:red;">*</span></label>
                                <input type="text" name="cp_ename" id="cp_ename" value="{{ $cs->cp_ename }}" style="text-transform: capitalize;" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Relationship <span style="color:red;">*</span></label>
                                <input type="text" name="relationship" id="relationship" value="{{ $cs->relationship }}" required style="text-transform: capitalize;" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Full Address <span style="color:red;">*</span></label>
                                <input type="text" name="cp_address" id="cp_address" value="{{ $cs->cp_address }}" required style="text-transform: capitalize;" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="cp_phone_num" id="cp_phone_num" value="{{ !empty($cs->cp_phone_num) ? $cs->cp_phone_num : '' }}" class="form-control" data-inputmask='"mask": "(0999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Telephone Number</label>
                                <input type="text" name="cp_tel_num" id="cp_tel_num" value="{{ !empty($cs->cp_tel_num) ? $cs->cp_tel_num : '' }}" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    <span class="pull-left"><i>Note: Fields with (<span style="color:red;">*</span>) is required.</i></span>
                    <span  class="pull-right"><button type="submit" class="btn btn-primary">Save changes</button></span>
                </div>
                <!-- /.box-body -->
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

@section('js')
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
            format: 'mm/dd/yyyy',
        }); /* datepicker initialization */
    });
</script>
@endsection
