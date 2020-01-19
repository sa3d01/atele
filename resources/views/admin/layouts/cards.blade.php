<div class="row">
{{--orders--}}

{{--users--}}
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md md-account-child text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$users->count()}}</b></h3>
                <p class="text-muted">الأعضاء</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-inverse pull-left">
                <i class="md md-shop text-inverse"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$providers->count()}}</b></h3>
                <p class="text-muted">دور الأزياء</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
