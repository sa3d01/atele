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
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title"><b><i class="icon-pencil before_word"></i>&nbsp;{{ $module_name }}</b><hr></h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                            @foreach($index_fields as $labels => $fields)
                                <th> {{ $labels }} </th>
                            @endforeach
                                <th> الصورة الشخصية</th>
                                <th> التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    @foreach($index_fields as $labels => $fields)
                                        @if($row->$fields==null)
                                            <td> ﻻ يوجد </td>
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
                                            <form style='margin-top: 20px' method='POST' data-id={{$row->id}} action='{{route('admin_status_user', ['id' => $row->id])}}' @if($row->admin_status=='approved') class='form-horizontal deactivate' @else class='form-horizontal activate' @endif>
                                                <input type='hidden' name='_token' value='{{csrf_token()}}'>
                                                @if($row->admin_status == 'approved')
                                                    <button type='submit' class='btn btn-danger btn-rounded waves-effect waves-light'>
                                                        <span class='btn-label'><i class='fa fa-times'></i></span>
                                                        حظر
                                                    </button>
                                                @elseif($row->admin_status == 'blocked')
                                                    <button type='submit' class='btn btn-success btn-rounded waves-effect waves-light'>
                                                        <span class='btn-label'><i class='fa fa-check'></i></span>
                                                        تفعيل
                                                    </button>
                                                @endif
                                            </form>
                                        </th>
{{--                                        <td class="actions">--}}
{{--                                            <div class="row" style="margin-top: 15px">--}}
{{--                                                <div class="col-md-2">--}}
{{--                                                    {!! Form::open(['method' => 'DELETE','data-id'=>$row->id, 'route' => [$route.'.destroy',$row->id], 'style'=>'width:125px','class'=>'delete']) !!}--}}
{{--                                                    {!! Form::hidden('id', $row->id) !!}--}}
{{--                                                    <button type="button"  class="btn btn-danger btn-custom waves-effect waves-light"><i class="fa fa-trash"></i></button>--}}
{{--                                                    {!! Form::close() !!}--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-2">--}}
{{--                                                    <a href="{{route($route.'.edit',$row->id)}}">--}}
{{--                                                        <button type="button" class="btn btn-info btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></button>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
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
    <script src="{{asset('panel/assets/dropify/dist/js/dropify.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dt-buttons').show();
        });
        TableManageButtons.init();
    </script>
@endsection
