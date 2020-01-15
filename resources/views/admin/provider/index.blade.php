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
                                <th> عدد الطلبات </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    @foreach($index_fields as $labels => $fields)
                                        @if($row->$fields==null)
                                            <td> ﻻ يوجد </td>
                                        @elseif(strpos($row->$fields, '.png') || strpos($row->$fields, '.jpg') || strpos($row->$fields, '.jpeg'))
                                            <td data-toggle="modal" data-target="#myModal{{$row->id}}"> <img class="img_preview img-circle" src="{{$row->image}}" style="height: 70px;width: 80px;"> </td>
                                            <div id="myModal{{$row->id}}" class="modal fade" role="img">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <img data-toggle="modal" data-target="#myModal{{$row->id}}" class="img-preview" src="{{$row->image}}" style="max-height: 500px">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">إغﻻق</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <td> {{ $row->$fields }} </td>
                                        @endif
                                    @endforeach
                                        <td> {{$row->orders->count()}} </td>
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
