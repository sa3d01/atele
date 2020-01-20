<div class="left side-menu" >
    <div class="sidebar-inner slimscrollleft" style="background-color: #053755">
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{url('admin')}}" class="waves-effect"><i class="ti-home"></i> <span> لوحة التحكم </span></a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i
                            class="fa fa-user"></i><span>إدارة الباقات</span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('package.index')}}">عرض الكل</a></li>
                    </ul>
                </li>
                <li class="text-muted menu-title"></li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i
                            class="fa fa-user"></i><span>إدارة العملاء</span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('user.approved')}}">العمﻻء المفعلين</a></li>
                        <li><a href="{{route('user.blocked')}}">العمﻻء المحظورين</a></li>
                        <li><a href="{{route('user.create')}}">إضافة</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i
                            class="fa fa-shopping-bag"></i><span>إدارة دور الأزياء</span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('provider.create')}}">إضافة</a></li>
                        <li><a href="{{route('provider.new')}}">طلبات الانضمام </a></li>
                        <li><a href="{{route('provider.approved')}}">دور الأزياء المفعلين</a></li>
                        <li><a href="{{route('provider.blocked')}}">دور الأزياء المحظورين</a></li>
                    </ul>
                </li>
{{--                <li class="has_sub">--}}
{{--                    <a href="javascript:void(0);" class="waves-effect"><i--}}
{{--                            class="fa fa-chart-line"></i><span>إدارة فترات العمل</span></a>--}}
{{--                    <ul class="list-unstyled">--}}
{{--                        <li><a href="{{route('shift.index')}}">عرض الكل</a></li>--}}
{{--                        <li><a href="{{route('shift.create')}}">إضافة</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="text-muted menu-title"></li>--}}
{{--                <li class="has_sub">--}}
{{--                    <a href="javascript:void(0);" class="waves-effect"><i--}}
{{--                            class="fa fa-server"></i><span>إدارة الأقسام</span></a>--}}
{{--                    <ul class="list-unstyled">--}}
{{--                        <li><a href="{{route('category.index')}}">الأقسام الرئيسية</a></li>--}}
{{--                        <li><a href="{{route('partial_categories')}}">الأقسام الفرعية</a></li>--}}
{{--                        <li><a href="{{route('category.create')}}">إضافة</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="has_sub">--}}
{{--                    <a href="javascript:void(0);" class="waves-effect"><i--}}
{{--                            class="fa fa-people-carry"></i><span>إدارة الخدمات</span></a>--}}
{{--                    <ul class="list-unstyled">--}}
{{--                        <li><a href="{{route('service.index')}}">عرض الكل</a></li>--}}
{{--                        <li><a href="{{route('service.create')}}">إضافة</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="text-muted menu-title"></li>--}}
{{--                <li class="has_sub">--}}
{{--                    <a href="javascript:void(0);" class="waves-effect"><i--}}
{{--                            class="fa fa-cart-plus"></i><span>إدارة الطلبات</span></a>--}}
{{--                    <ul class="list-unstyled">--}}
{{--                        <li><a href="{{route('order.status',['waiting'])}}">الطلبات الجديدة</a></li>--}}
{{--                        <li><a href="{{route('order.status',['in_progress'])}}">الطلبات الجارية</a></li>--}}
{{--                        <li><a href="{{route('order.status',['done'])}}">الطلبات المكتملة</a></li>--}}
{{--                        <li><a href="{{route('order.status',['cancelled'])}}">الطلبات المرفوضة</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li class="text-muted menu-title"></li>
{{--                <li class="has_sub">--}}
{{--                    <a href="{{route('setting.get_setting')}}" class="waves-effect"><i class="md md-settings"></i><span> الإعدادات العامة</span></a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</div>

