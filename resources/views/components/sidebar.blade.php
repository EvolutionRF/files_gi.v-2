<div class="main-sidebar sidebar-style-2 sidebar-mini main-sidebar:after">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>

        <ul class="sidebar-menu mt-5">
            <li class="{{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard')}}">
                    <x-heroicon-s-home style="max-width:20px" />
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>
        </ul>

        @guest

        @else
        <ul class="sidebar-menu">
            <li class="{{ $type_menu === 'myFiles' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('myFiles') }}">
                    <x-heroicon-s-folder-open style="max-width:20px" />
                    <span class="ml-2">My Files</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="{{ $type_menu === 'Shared' ? 'active' : '' }}">
                <a class="nav-link" href="">
                    <x-heroicon-s-user style="max-width:20px" />
                    <span class="ml-2">Shared</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="{{ $type_menu === 'Trash' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('trash.index') }}">
                    <x-heroicon-s-trash style="max-width:20px" />
                    <span class="ml-2">Trash</span>
                </a>
            </li>
        </ul>
        @role('admin')
        <ul class="sidebar-menu">
            <li class="{{ $type_menu === 'Data Users' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <x-heroicon-s-users style="max-width:20px" />
                    <span class="ml-2">Data Users</span>
                </a>
            </li>
        </ul>
        @endrole

        @endguest

    </aside>
</div>
