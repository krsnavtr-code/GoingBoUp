<header>
    <div class="header_main">
        <a href="{{ url('/') }}" class="brand">
            <img src="{{ url('images/logo.png') }}" alt="logo">
        </a>
        <nav class="prime_nav rflex active">
            <li class="show-on-scroll-nav-item" style="transition: opacity 0.3s ease-in-out; z-index: 1000;">
                <a href="{{ url('flight') }}" style="display: flex; align-items: center;">
                    <img src="{{ url('images/web-assets/nobg-flight.png') }}" class="nav-link-image" alt="logo">
                    Flights
                </a>
            </li>
            <li class="show-on-scroll-nav-item" style="transition: opacity 0.3s ease-in-out; z-index: 1000;">
                <a href="{{ url('hotel') }}" style="display: flex; align-items: center;">
                    <img src="{{ url('images/web-assets/nobg-hotel.png') }}" class="nav-link-image" alt="logo">
                    Hotels
                </a>
            </li>
            <li class="show-on-scroll-nav-item" style="transition: opacity 0.3s ease-in-out; z-index: 1000;">
                <a href="{{ url('') }}"> 
                    <img src="{{ url('images/web-assets/nobg-bus.png') }}" class="nav-link-image"  alt="logo">
                   Bus
                </a>
            </li> 
            <li class="show-on-scroll-nav-item" style="transition: opacity 0.3s ease-in-out; z-index: 1000;">
                <a href="{{ url('cab') }}">
                    <img src="{{ url('images/web-assets/nobg-cabs.png') }}"   class="nav-link-image" alt="logo">
                    Cabs 
                </a>
            </li>
            <li>
                <a href="{{ url('packages') }}" target="_blank">
                    <img src="{{ url('images/web-assets/nobg-holiday-package.png') }}" class="nav-link-image" alt="logo">
                    Holiday Packages
                </a>
            </li>

            <li class="club_box">
                <a href="{{ url('membership') }}" target="_blank">
                    <span>G</span><span style="color: var(--fv_prime);">BO</span> Membership
                </a>
                <ul class="club">
                    <h5>Be a Member</h5>
                    <p>Get travel offers, perks and rewards with each booking with great discount</p>
                    <a href="{{ url('membership') }}" class="btn" target="_blank">Explore Membership</a>
                </ul>
            </li>
            <li>
                <a href="{{ url('blogs') }}">
                    Blogs
                </a>
            </li>            
        </nav>
        <nav class="sec_nav rflex aic">
            @if (session()->has('user'))
                <li class="signed_in_box">
                    <a class="btn">Profile</a>
                    <ul class="signed_in">
                        @php $userData = session()->get('user'); @endphp
                        <h5>Hello {{$userData['userMail']}}</h5>
                        <p>Manage your bookings</p>
                        <li><a href=""><i class="fa-solid fa-user"></i>My Profile</a></li>
                        <li><a href="{{url('user/bookings')}}"><i class="fa-solid fa-bookmark"></i>My Booking</a></li>
                        <li><a href=""><i class="fa-solid fa-badge-percent"></i>Offers</a></li>
                        <li><a href="{{url('user/logout')}}" class="logout">Logout</a></li>
                    </ul>
                </li>
            @else
                <li class="sign_in_box">
                    <a href="{{url('user/login')}}" class="btn prime">Sign In</a>
                    <ul class="sign_in">
                        <h5>Hello Traveller</h5>
                        <p>Get Exclusive deals and manage your bookings</p>
                        <li><a href="{{url('user/login')}}" class="btn">Sign In/Up</a></li>
                    </ul>
                </li>
            @endif
            <i class="fa-solid fa-bars-staggered" id="sidebar_opener"></i>
        </nav>
        <div class="side_nav">
            <a href="{{ url('') }}" class="brand">
                <img src="{{ url('images/logo.png') }}" alt="logo">
            </a>
            <ul class="prime_side_nav">
            @if(!Request::is('/'))
                <li>
                    <a href="{{ url('') }}">
                        <i class="fa-solid fa-plane"></i>
                        <span>Flight</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('hotel') }}">
                        <i class="fa-solid fa-hotel"></i>
                        <span>Hotel</span>
                    </a>
                </li>
                <li><a href="{{ url('cab') }}" target="_blank"><i class="fa-solid fa-cab"></i><span
                            class="brand"><span>G</span><span>BO </span>
                              Special Cabs</span></a></li>
                <li><a href="{{ url('packages') }}" target="_blank"><i class="fa-solid fa-badge-percent"></i>Holiday
                        Packages</a></li>
                <li>
                    <a href="{{ url('blogs') }}">
                        <i class="fa-solid fa-blog"></i>
                        <span>Blogs</span>
                    </a>
                </li>
            @endif
                <ul class="member_box">
                    <h5 style="">Be a Member</h5>
                    <p>Get travel offers, perks and rewards with each booking with great discount</p>
                    <a href="{{ url('membership') }}" class="btn" target="_blank">Explore Membership</a>
                </ul>
            </ul>
            <ul class="sec_side_nav signed_in">
                @if (session()->has('user'))

                @php $userData = session()->get('user'); @endphp
                    <h5>Hello {{$userData['userMail']}}</h5>
                    <p>Manage your bookings</p>
                    <li><a href=""><i class="fa-solid fa-user"></i>My Profile</a></li>
                    <li><a href=""><i class="fa-solid fa-bookmark"></i>My Booking</a></li>
                    <li><a href=""><i class="fa-solid fa-badge-percent"></i>Offers</a></li>
                    <a href="{{url('user/logout')}}" class="btn logout">Logout</a>
                @else
                    <h5>Hello Traveller</h5>
                    <p>Get Exclusive deals and manage your bookings</p>
                    <a href="{{url('user/login')}}" class="btn">Sign In/Up</a>
                @endif
            </ul>
        </div>
    </div>
</header>


@push('js')
<script>
// Show/hide flights nav item on scroll
document.addEventListener('DOMContentLoaded', function () {
  const navItems = document.querySelectorAll('.show-on-scroll-nav-item');
  const currentPath = window.location.pathname; // Get current URL path
  let isVisible = false;

  // Only apply scroll animation on /flight or /hotel pages
  if (currentPath === '/' || currentPath === '/flight' || currentPath === '/hotel') {
    // Start hidden
    navItems.forEach((item) => {
      item.style.display = 'none';
    });

    window.addEventListener('scroll', function () {
      const scrollPosition = window.scrollY;
      const windowHeight = window.innerHeight;
      const scrollThreshold = windowHeight * 0.5;

      navItems.forEach((item) => {
        if (scrollPosition > scrollThreshold && !isVisible) {
          item.style.display = 'block';
        } else if (scrollPosition <= scrollThreshold && isVisible) {
          item.style.display = 'none';
        }
      });

      isVisible = scrollPosition > scrollThreshold;
    });
  } else {
    // On other pages — always visible
    navItems.forEach((item) => {
      item.style.display = 'block';
    });
  }
});





    // Original sidebar code
    document.addEventListener("DOMContentLoaded", function () {
    var sidebarOpener = document.getElementById("sidebar_opener");
    var sideNav = document.querySelector(".side_nav");

    sidebarOpener.addEventListener("click", function (e) {
        sideNav.classList.add("active");

        function hideSideNav(event) {
            if (!sideNav.contains(event.target) && event.target !== sidebarOpener) {
                sideNav.classList.remove("active");
                document.removeEventListener("click", hideSideNav);
            }
        }
        setTimeout(() => document.addEventListener("click", hideSideNav), 1);
    });

    document.addEventListener("scroll", function () {
        var header = document.querySelector("header");
        if (window.scrollY > 20) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });
});
</script>
@endpush
