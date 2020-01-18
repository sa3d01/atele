<div class="topbar">
    <div class="topbar-left">
        <div class="text-center">
            <a href="{{url('/admin')}}" class="logo">
            <i class="icon-c-logo">
                <img src="{{asset('panel/assets/images/logo.png')}}" height="42" style=" -webkit-filter:brightness(90%); /* Safari 6.0 - 9.0 */
  filter: brightness(90%);"/>
            </i>
            <span>
                <img src="{{asset('panel/assets/images/logo.png')}}" height="42" style=" -webkit-filter:brightness(90%); /* Safari 6.0 - 9.0 */
  filter: brightness(90%);"/>
            </span>
            </a>
        </div>
    </div>
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="md md-menu"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                    </li>
                    <li class="dropdown top-menu-item-xs">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                            <img src="{{Auth::user()->image}}" alt="user-img" class="img-circle">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('admin.edit',[\Auth::id()])}}"><i class="ti-user m-r-10 text-custom"></i> البيانات الشخصية</a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('admin/logout')}}"><i class="ti-power-off m-r-10 text-danger"></i>خروج</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
