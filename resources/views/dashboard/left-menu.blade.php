<div class="left-sindebar-dashboard">
    <div class="dashboard-left-single-wrapper">

        <a href="{{ route('dashboard.index') }}"
            class="single-item @if (request()->route()->getName() == 'dashboard.index') active @endif">
            <i class="fa-light fa-house"></i>
            <p>Dashboard</p>
        </a>

        <a href="{{ route('dashboard.profile') }}" class="single-item @if (request()->route()->getName() == 'dashboard.profile') active @endif">
            <i class="fa-regular fa-user"></i>
            <p>My Profile</p>
        </a>

        <a href="{{ route('dashboard.my.courses') }}" class="single-item @if (request()->route()->getName() == 'dashboard.my.courses') active @endif">
            <i class="fa-light fa-graduation-cap"></i>
            <p>Enrolled Courses</p>
        </a>

        <a href="{{ route('dashboard.wishlist') }}" class="single-item @if (request()->route()->getName() == 'dashboard.wishlist') active @endif">
            <i class="fa-sharp fa-light fa-bookmark"></i>
            <p>Wishlist</p>
        </a>


        <a href="{{ route('dashboard.order-history') }}" class="single-item @if (request()->route()->getName() == 'dashboard.order-history') active @endif">
            <i class="fa-sharp fa-light fa-bag-shopping"></i>
            <p>Order History</p>
        </a>

        <a href="{{ route('logout') }}" class="single-item">
            <i class="fa-light fa-right-from-bracket"></i>
            <p>Logout</p>
        </a>
    </div>

</div>
