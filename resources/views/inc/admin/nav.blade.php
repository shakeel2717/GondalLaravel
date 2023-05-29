<div class="sidebar-nav" style="margin-top: 50px;z-index:50">
    <div class="sidebar-nav-body">
        <div class="side-menu-close">
            <i class="la la-times"></i>
        </div>
        <div class="author-content" style="padding-top: 40px !important;">
            <div class="d-flex align-items-center">
                <div class="author-img avatar-sm">
                    <img src="{{ asset('assets/theme/img/user.png') }}" alt="user" style="height:auto">
                </div>
                <div class="author-bio">
                    <h4 class="author__title"><strong style="text-transform:capitalize">{{ auth()->user()->name }}</strong></h4>
                    <span class="author__meta">Welcome Back</span>
                </div>
            </div>
        </div>
        <div class="sidebar-menu-wrap">
            <ul class="sidebar-menu list-items">
                <li class="page-active"><a href="{{ route('admin.dashboard.index') }}" class=" waves-effect"><i class="la la-dashboard mr-2"></i> Dashboard</a></li>
                <li class=""><a href="{{ route('admin.booking.index') }}" class=" waves-effect"><i class="la la-shopping-cart mr-2 text-color-3"></i> My Bookings</a></li>
                <li class=""><a href="{{ route('admin.users.index') }}" class=" waves-effect"><i class="la la-shopping-cart mr-2 text-color-3"></i> All Users</a></li>
                <li class=""><a href="{{ route('admin.finance.index') }}" class=" waves-effect"><i class="la la-shopping-cart mr-2 text-color-3"></i> Finance</a></li>
            </ul>
        </div>
    </div>
</div>