<div class="col-xl-3 col-md-4 wow fadeInLeft">
    <div class="wsus__dashboard_sidebar">
        <div class="wsus__dashboard_sidebar_top">
            <div class="dashboard_banner">
                <img src="{{ asset('frontend/assets/images/single_topic_sidebar_banner.jpg') }}" alt="img"
                    class="img-fluid">
            </div>
            <div class="img">
                <img src="{{ asset(auth()->user()->image) }}" alt="profile" class="img-fluid w-100">
            </div>
            <h4>{{ auth()->user()->name }}</h4>
            <p>{{ auth()->user()->role }}</p>
        </div>
        <ul class="wsus__dashboard_sidebar_menu">
            <li>
                <a href="{{ route('instructor.dashboard') }}" class="{{ sidebarItemActive(['instructor.dashboard']) }}">
                    <div class="sidebar_icon">
                        <i class="ti ti-file-analytics"></i>
                    </div>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('instructor.profile.index') }}"
                    class="{{ sidebarItemActive(['instructor.profile.index']) }}">
                    <div class="sidebar_icon">
                        <i class="ti ti-user"></i>
                    </div>
                    Instructor Profile
                </a>
            </li>
            <li>
                <a href="{{ route('instructor.courses.index') }}"
                    class="{{ sidebarItemActive(['instructor.courses.index']) }}">
                    <div class="sidebar_icon">
                        <i class="ti ti-certificate"></i>
                    </div>
                    Courses
                </a>
            </li>
            <li>
                <a href="{{ route('instructor.orders.index') }}"
                    class="{{ sidebarItemActive(['instructor.orders.index']) }}">
                    <div class="sidebar_icon">
                        <i class="ti ti-clipboard-text"></i>
                    </div>
                    Orders
                </a>
            </li>
            <li>
                <a href="{{ route('instructor.withdrawals.index') }}"
                    class="{{ sidebarItemActive(['instructor.withdrawals.index']) }}">
                    <div class="sidebar_icon">
                        <i class="ti ti-cash-banknote space"></i>
                    </div>
                    Withdrawals
                </a>
            </li>

            {{-- <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="javascript:;"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <div class="img">
                            <img src="{{ asset('frontend/assets/images/dash_icon_16.png') }}"
                                alt="icon" class="img-fluid w-100">
                        </div>
                        Sign Out
                    </a>
                </form>
            </li> --}}
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn_logout">
                        <div class="img sidebar_icon">
                            <img src="{{ asset('frontend/assets/images/dash_icon_16.png') }}" alt="icon"
                                class="img-fluid w-100">
                        </div>
                        Sign Out
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
