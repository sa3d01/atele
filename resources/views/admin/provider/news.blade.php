@extends('admin.layouts.app')
@section('title',$module_name)
@section('style')
    <link href="{{asset('panel/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('panel/assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('panel/assets/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('panel/assets/dropify/dist/css/dropify.min.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                @foreach($index_fields as $labels => $fields)
                                    <th> {{ $labels }} </th>
                                @endforeach
                                <th> الصورة الشخصية</th>
                                <th> الحالة</th>
{{--                                <th> التفاصيل</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    @foreach($index_fields as $labels => $fields)
                                        @if($row->$fields==null)
                                            <td> ﻻ يوجد</td>
                                        @else
                                            <td> {{ $row->$fields }} </td>
                                        @endif
                                    @endforeach
                                    <td data-toggle="modal" data-target="#myModal{{$row->id}}"><img
                                                class="img-preview" src="{{ $row->image }}"
                                                style="height: 85px;width: 85px; border-radius: 50%"></td>
                                    <div id="myModal{{$row->id}}" class="modal fade" role="img">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <img data-toggle="modal" data-target="#myModal{{$row->id}}"
                                                         class="img-preview"
                                                         src="{{ $row->image }}"
                                                         style="max-height: 500px">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <th>
                                        <form style='margin-top: 20px' method='POST' data-id={{$row->id}} action='{{route('provider.block', ['id' => $row->id])}}' class='form-horizontal deactivate'>
                                            <input type='hidden' name='_token' value='{{csrf_token()}}'>
                                                <button type='submit' class='btn btn-danger btn-rounded waves-effect waves-light'>
                                                    <span class='btn-label'><i class='fa fa-times'></i></span>
                                                    رفض
                                                </button>
                                        </form>
                                        <form style='margin-top: 20px' method='POST' data-id={{$row->id}} action='{{route('provider.approve', ['id' => $row->id])}}' class='form-horizontal activate'>
                                            <input type='hidden' name='_token' value='{{csrf_token()}}'>
                                                <button type='submit' class='btn btn-success btn-rounded waves-effect waves-light'>
                                                    <span class='btn-label'><i class='fa fa-check'></i></span>
                                                    قبول
                                                </button>
                                        </form>
                                    </th>
{{--                                    <td class="actions">--}}
{{--                                        <div class="row" style="margin-top: 20px">--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <a href="{{route($route.'.show',$row->id)}}">--}}
{{--                                                    <button type="button"--}}
{{--                                                            class="btn btn-info btn-custom waves-effect waves-light"><i--}}
{{--                                                                class="fa fa-eye"></i></button>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@stop
@section('script')
    <script src="{{asset('panel/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('panel/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('panel/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('panel/assets/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('panel/assets/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('panel/assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('panel/assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('panel/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('panel/assets/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('panel/assets/pages/datatables.init.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dt-buttons').show();
        });
        TableManageButtons.init();
    </script>
    <script>
        $(document).on('click', '.deactivate', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                    title: "هل انت متأكد من الرفض ؟",
                    text: "سيتم نقل المستخدم لقائمة الغير مفعلين!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: 'btn-danger',
                    confirmButtonText: 'نعم , قم بالرفض!',
                    cancelButtonText: 'ﻻ , الغى عملية الرفض!',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        swal("تم الرفض !", "تم رفض العنصر !", "success");
                        $("form:first[data-id='" + id + "']").submit();
                    } else {
                        swal("تم الالغاء", "ما زال العنصر متاح  :)", "error");
                    }
                });
        });
        $(document).on('click', '.activate', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                    title: "هل انت متأكد من القبول ؟",
                    text: "سيتم نقل المستخدم لقائمة المفعلين!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: 'btn-danger',
                    confirmButtonText: 'نعم , قم بالقبول!',
                    cancelButtonText: 'ﻻ , الغى عملية القبول!',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        swal("تم القبول !", "تم قبول العنصر !", "success");
                        $("form[data-id='" + id + "']").submit();
                    } else {
                        swal("تم الالغاء", "ما زال العنصر متاح  :)", "error");
                    }
                });
        });
    </script>

@endsection
