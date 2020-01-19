@extends('admin.layouts.app')
@section('title',$module_name)
@section('style')
    <link rel="stylesheet" href="{{asset('panel/assets/dropify/dist/css/dropify.min.css')}}">
@endsection
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
                        {!! Form::open(['method'=>'post', 'files'=>true, 'enctype' => 'multipart/form-data', 'route'=>[$route.'.store'], 'class' => 'form-row-seperated add_ads_form']) !!}
                        {!! Form::hidden('type','provider') !!}
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="title">الاسم</label>
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <br>
                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="title">رقم الجوال</label>
                                        {!! Form::number('mobile', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <br>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="title">البريد الالكترونى</label>
                                        {!! Form::email('email', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <br>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>كلمة المرور</label>
                                        {!! Form::text('password', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <br>
                                    <div class="form-group{{ $errors->has('site_url') ? ' has-error' : '' }}">
                                        <label>رابط الموقع الشخصي</label>
                                        {!! Form::url('site_url', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <br>
                                    <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                        <label>وصف</label>
                                        {!! Form::textarea('note', null, ['class'=>'form-control']) !!}
                                    </div>
                                    <br>
                            </div>
                            <div class="col-md-6">
                                <div class="white-box">
                                    <label for="input-file-now-custom-1">الصورة المعبرة</label>
                                    <input name="image" type="file" id="input-file-now-custom-1" class="dropify" data-default-file="{{asset('images/user/admin.png')}}"/>
                                    @if ($errors->has('image'))
                                        <small class="text-danger">{{ $errors->first('image') }}</small>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        {{ Form::select('type', $type, null, array('class' => 'form-control','style'=>"margin-bottom: 10px",'id'=>'type')) }}
                                    </div>
                                </div>
                                {{--optional--}}
                                <div class="form-group">
                                    <div class="col-xs-12" id="library_type" hidden>
                                        {{ Form::select('library_type', $library_type, null, array('class' => 'form-control','style'=>"margin-bottom: 10px")) }}
                                    </div>
                                </div>
                                {{--end optional--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-push-1">
                                <button type="submit" class="update_button btn btn-success btn-rounded waves-effect waves-light">
                                    إضافة
                                </button>
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
    <script src="{{asset('panel/assets/dropify/dist/js/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
@stop
