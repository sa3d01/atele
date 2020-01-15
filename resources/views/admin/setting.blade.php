@extends('admin.layouts.app')
@section('title',$module_name)
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b><i class="icon-pencil before_word"></i>&nbsp;
                                تعديل بيانات {{ $module_name }}
                            </b>
                            <hr>
                        </h4>
                        {!! Form::model($row, ['method'=>'patch','name'=>'update', 'files'=>true, 'route'=>[$route.'.update_setting', $row->id], 'class' => 'form-horizontal form-row-seperated']) !!}
                        {!! Form::hidden('id', $row->id) !!}
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($json_fields as $label=>$value)
                                    <div>
                                        <label for="title">{{ $label .' '.'بـاللغة العربية' }}</label>
                                        {!! Form::textarea($value.'_ar', $row->$value['ar'], ['class'=>'form-control']) !!}
                                        @if ($errors->has($value.'_ar'))
                                            <small class="text-danger">{{ $errors->first($value.'_ar')}}</small>
                                        @endif
                                    </div>
                                    <br><br>
                                    <div>
                                        <label for="title">{{ $label .' '.'بـاللغة الانجليزية' }}</label>
                                        {!! Form::textarea($value.'_en', $row->$value['en'], ['class'=>'form-control']) !!}
                                        @if ($errors->has($value.'_en'))
                                            <small class="text-danger">{{ $errors->first($value.'_en')}}</small>
                                        @endif
                                    </div>
                                    <br><br>
                                @endforeach
                                @foreach($update_fields as $labels => $fields)
                                    <div class="form-group{{ $errors->has($fields) ? ' has-error' : '' }}">
                                        <label for="title">{{ $labels }}</label>
                                        {!! Form::text($fields, null, ['class'=>'form-control']) !!}
                                        @if ($errors->has($fields))
                                            <small class="text-danger">{{ $errors->first($fields) }}</small>
                                        @endif
                                    </div>
                                @endforeach
                                    <div class="form-group">
                                        <label for="title">رابط فيسبوك</label>
                                        {!! Form::text('facebook', $facebook, ['class'=>'form-control']) !!}
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="title">رابط تويتر</label>
                                        {!! Form::text('twitter', $twitter, ['class'=>'form-control']) !!}
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="title">رابط انستجرام</label>
                                        {!! Form::text('insta', $insta, ['class'=>'form-control']) !!}
                                    </div>
                                    <br>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-push-1">
                                <button type="submit" class="update_button btn btn-success btn-rounded waves-effect waves-light">
                                    تعديل
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
