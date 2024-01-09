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
        <i class="nav-icon fas fa-user-check"></i>
        <p>Data PIC Room</p>
    </a>
    <a href="{{ route('classroom') }}" class="nav-link {{ Request::is('classroom') ? 'active' : '' }}">
        <i class="nav-icon fas fa-door-open"></i>
        <p>Data Classroom</p>
    </a>
    <a href="{{ route('report') }}" class="nav-link {{ Request::is('report') ? 'active' : '' }}">
        <i class="nav-icon fas fa-exclamation"></i>
        <p>Data Classroom Report</p>
    </a>
    <a href="{{ route('booking') }}" class="nav-link {{ Request::is('booking') ? 'active' : '' }}">
        <i class="nav-icon fas fa-bookmark"></i>
        <p>Data Booking Class</p>
    </a>
    <a href="{{ route('schedule') }}" class="nav-link {{ Request::is('schedule') ? 'active' : '' }}">
        <i class="nav-icon fas fa-layer-group"></i>
        <p>Data Schedules</p>
    </a>
</li>
