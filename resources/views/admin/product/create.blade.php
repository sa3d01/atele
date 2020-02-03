@extends('admin.layouts.app')
@section('title',$module_name)
@section('style')
    <link href="{{asset('panel/assets/plugins/summernote/summernote.css')}}" rel="stylesheet" />
@stop
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b><i class="icon-pencil before_word"></i>&nbsp;
                                إضافة {{ $single_module_name }}
                            </b>
                            <hr>
                        </h4>
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        {!! Form::open(['method'=>'post', 'files'=>true, 'enctype' => 'multipart/form-data', 'route'=>[$route.'.store'], 'class' => 'form-row-seperated add_ads_form']) !!}
                        {!! Form::hidden('add_by', Auth::user()->id) !!}
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($index_fields as $labels => $fields)
                                    @php $s1=$fields; $s2="id"; @endphp
                                    @if($fields=='image' || $fields=='logo')
                                        <div class="white-box">
                                            <label for="input-file-now-custom-1">{{ $labels }}</label>
                                            <input name="{{$fields}}" type="file" id="input-file-now-custom-1" class="dropify" data-default-file="{{asset('images/logo/default.png')}}"/>
                                            @if ($errors->has($fields))
                                                <small class="text-danger">{{ $errors->first($fields) }}</small>
                                            @endif
                                        </div>
                                        <br>
                                    @elseif(substr($s1, -strlen($s2))==$s2)
                                        <div class="form-group{{ $errors->has($fields) ? ' has-error' : '' }}">
                                            <label for="title">{{ $labels }}</label>
                                            {{ Form::select($fields, $type, null, array('class' => 'form-control')) }}
                                        </div>
                                        <br>
                                    @else
                                        <div class="form-group{{ $errors->has($fields) ? ' has-error' : '' }}">
                                            <label for="title">{{ $labels }}</label>
                                            {!! Form::text($fields, null, ['class'=>'form-control']) !!}
                                        </div>
                                        <br>
                                    @endif
                                @endforeach
                                    <div class="form-group">
                                        <div class="fileupload btn btn-purple waves-effect waves-light">
                                            <span><i class="ion-upload m-r-12"></i>الصور المرفقة</span>
                                            <input class="upload" type="file" accept="image/*" name="images[]" multiple />
                                            @if ($errors->has('images'))
                                                <small class="text-danger">{{ $errors->first('images') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="control-label col-md-push-1">
                                            <button type="submit" class="update_button btn btn-success btn-rounded waves-effect waves-light">
                                                إضافة
                                            </button>
                                        </div>
                                    </div>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var loadFile = function(event) {
            // var length=event.target.files.length;
            // alert(length)
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@stop
