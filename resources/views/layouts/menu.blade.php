<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
    <a href="{{ route('admin') }}" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Data Admin</p>
    </a>
    <a href="{{ route('students') }}" class="nav-link {{ Request::is('students') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Data Student</p>
    </a>
    <a href="{{ route('semester') }}" class="nav-link {{ Request::is('semester') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book-open"></i>
        <p>Data Semester</p>
    </a>
    <a href="{{ route('building') }}" class="nav-link {{ Request::is('building') ? 'active' : '' }}">
        <i class="nav-icon fas fa-building"></i>
        <p>Data Building</p>
    </a>
    <a href="{{ route('picroom') }}" class="nav-link {{ Request::is('picroom') ? 'active' : '' }}">
        <i class="nav-icon fas fa-arrow-down-wide-short"></i>
        <p>Data PIC Room</p>
    </a>
</li>
