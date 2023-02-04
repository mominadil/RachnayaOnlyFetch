<header id="main-header" class="d-flex align-items-center  container">
    <div class="rachnaye-logo-container ps-3">
        <img class="rachnaye-logo" src="{{ Storage::url('images/rachnaye-logo.png') }}" alt="rachnaye logo image" />
    </div>
    <!-- Navigation section start -->
    <nav>
        <div class="nav-link-con" id="nav-link-con">
            <ul id="header-nav" class="header-nav pe-5">
                <li>
                    <a class="header-nav-link header-nav-link-home pe-3" href="{{ url('/') }}">Home</a>
                </li>
                <li><a class="header-nav-link pe-3" href="#">About Us</a></li>
                <li>
                    <a class="header-nav-link pe-3" href="#">For Publisher</a>
                </li>
                <li><a class="header-nav-link pe-3" href="#">For Writers</a></li>
                <li><a class="header-nav-link pe-3" href="#">For Readers</a></li>
                <li><a class="header-nav-link pe-3" href="#">Contact Us</a></li>
                <li><a class="header-nav-link pe-3" href="#">Blogs</a></li>
                <li><a class="header-nav-link pe-3" href="#">Login</a></li>
            </ul>
        </div>
        <div class="nav-hamburger d-xl-none d-lg-inline-block d-sm-inline-block">
            <i class="fa-solid fa-bars text-black"></i>
        </div>
    </nav>
    <!-- Navigation section ends -->
</header>