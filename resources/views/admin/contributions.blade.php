@extends('admin.template.master')

@section('main_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="#" data-toggle="modal" data-target="#modal-station">
            <button type="button" class="btn btn-success btn-sm">Add Contribution</button>
        </a>

        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Senior Citizen Contribution</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Senior Citizens Contribution List</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
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
                <table class="table table-bordered table-hover datatable" id="contributions_tbl" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contribution</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($data))
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->unique_id_num }}</td>
                            <td>{{ $item->full_name }}</td>
                            <td class="text-right">&#8369; {{ number_format($item->amount, 2) }}</td>
                            <td>{{ date('m/d/Y h:i a', strtotime($item->created_at)) }}</td>
                            <td>{{ date('m/d/Y h:i a', strtotime($item->updated_at)) }}</td>
                            <td>
                                <a href="javascript:void(0);" id="btn-edit" data-id="{{ $item->id }}" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> </a>&nbsp;<a href="javascript:void(0);" id="btn-del" data-id="{{ $item->id }}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- Add Record modal -->
        <div class="modal fade" id="modal-station" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                                Add new Contribution
                        </h4>
                    </div>
                    <form id="add_station" method="POST" action="{{ url('/save-contribution') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Senior Citizen</label>
                                        <select name="senior_id" id="senior_id" class="form-control select2" style="width: 100%;" required>
                                            <option disabled selected>[ Select Senior Citizen ]</option>
                                            @foreach ($records as $item)
                                            <option value="{{ $item->id }}">{{ $item->fname.' '.$item->mname.' '.$item->lname }} {{ isset($item->ename) ? ' '.$item->ename : '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Senior Citizen Contribution</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">&#8369;</span>
                                        <input type="text" name="amount" id="contribution" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span class="pull-left"><i>Note: Fields with (<span style="color:red;">*</span>) is required.</i></span>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.Add Record modal -->

        <!-- View Record modal -->
        <div class="modal fade" id="view-record" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                            View Contribution
                        </h4>
                    </div>
                    <div class="modal-body" style="background-color: #f1f1f1db!important;">
                        <div class="row">

                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.View Record modal -->

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
        /* datatable initialization */
        $('#contributions_tbl').DataTable(); /* datatable initialization */

        // $("#contribution").on({
        //     keyup: function() {
        //         formatCurrency($(this));
        //     }
        // });

        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        function formatCurrency(input, blur)
        {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") { return; }

            // original length
            var original_len = input_val.length;

            // initial caret position
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0)
            {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                right_side += "00";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = input_val;

                // final formatting
                if (blur === "blur") {
                input_val += ".00";
                }
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        $("#btn-edit").on('click', function() {
            $.ajax({
                url: "{{ url('/get-contribution-data') }}",
                type: "POST",
                data: {'c_id': $(this).attr('data-id'),'_token': $('meta[name="csrf-token"]').attr('content')},
                success: function(items) {
                    $("#senior_id").val(items.user[0].senior_id).trigger('change');
                    $("#contribution").val(items.user[0].amount);
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
                        url: "{{ url('/admin-del-contribution') }}",
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
                                        window.location = "{{ $base_url }}" + "/admin-senior-contributions";
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
