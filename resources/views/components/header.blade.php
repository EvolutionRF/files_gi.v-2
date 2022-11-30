<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" data-target=".notification"
                class="nav-link notification-toggle nav-link-lg" data-url="{{ route('notif') }}"><i
                    class="far fa-bell"></i></a>

            <x-dropdown.notification />

        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('user.editprofile') }}" class="dropdown-item has-icon" data-toggle="modal"
                    data-target=".show-modal" data-title="Edit Profile" data-url="{{ route('user.editprofile') }}">
                    <x-heroicon-o-pencil-square style="height: 15px">
                    </x-heroicon-o-pencil-square> Edit Profile
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon" data-toggle="modal"
                    data-target=".show-modal" data-title="Change Password"
                    data-url="{{ route('user.changepassword') }}">
                    <x-heroicon-o-shield-exclamation style="height: 15px"></x-heroicon-o-shield-exclamation> Change
                    Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </div>
        </li>


    </ul>
</nav>
