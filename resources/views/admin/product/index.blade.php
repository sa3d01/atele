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
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                @foreach($index_fields as $labels => $fields)
                                    <th> {{ $labels }} </th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    @foreach($json_fields as $label=>$value)
                                        <td>{{$row->$value['ar']}}</td>
                                    @endforeach
                                    @if($row->period ==0)
                                        <td>ﻻ نهائية </td>
                                    @else
                                        <td>{{$row->period}} شهور </td>
                                    @endif
                                    <td>{{$row->price}} ريال سعودى </td>
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
