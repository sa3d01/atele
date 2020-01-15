<div class="row">
{{--orders--}}
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-success pull-left">
                <i class="md md-remove-red-eye text-success"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$waiting_orders->count()}}</b></h3>
                <p class="text-muted">الطلبات الجديدة</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-pink pull-left">
                <i class="md md-add-shopping-cart text-pink"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$assigned_orders->count()}}</b></h3>
                <p class="text-muted">الطلبات الجارية</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-purple pull-left">
                <i class="md md-equalizer text-purple"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$done_orders->count()}}</b></h3>
                <p class="text-muted">الطلبات المنتهية</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-warning pull-left">
                <i class="md md-battery-alert text-warning"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$cancelled_orders->count()}}</b></h3>
                <p class="text-muted">الطلبات الملغاة</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

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
                <i class="md md-directions-bus text-inverse"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$providers->count()}}</b></h3>
                <p class="text-muted">مقدمين الخدمات</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-danger pull-left">
                <i class="md md-attach-money text-danger"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$money}}</b></h3>
                <p class="text-muted">الأرباح</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
