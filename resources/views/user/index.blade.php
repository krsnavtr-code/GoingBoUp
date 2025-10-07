@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="css/index.css">
<style>
    .aboutus {
        padding: 80px 20px;
        background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
        color: #333;
        font-family: "Poppins", sans-serif;
        line-height: 1.8;
        max-width: 1200px;
        margin: 0 auto;
    }

    .section_head {
        text-align: center;
        margin-bottom: 40px;
    }

    .section_title {
        font-size: 2rem;
        font-weight: 700;
        color: #111;
        position: relative;
        display: inline-block;
    }

    .section_title::after {
        content: "";
        position: absolute;
        width: 60px;
        height: 4px;
        background: #007bff;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .about_content {
        /* max-width: 900px; */
        margin: 0 auto;
        text-align: justify;
        font-size: 1.5rem;
        color: #555;
    }

    .details {
        margin-bottom: 1.5rem;
    }

    /* Link styling */
    .a-line {
        color: #007bff;
        text-decoration: none;
        position: relative;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .a-line::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 100%;
        height: 2px;
        background: #007bff;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .a-line:hover {
        color: #0056b3;
    }

    .a-line:hover::after {
        transform: scaleX(1);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section_title {
            font-size: 1.5rem;
        }

        .about_content {
            font-size: 0.95rem;
        }
    }
</style>
@endpush

@section('main')
<main>


    <menu class="tabs">
        <ul class="top-tabs">
            <li>
                <a href="{{ url('flight') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/airplane.gif') }}" alt="logo">
                    <span>Flights</span>

                </a>
            </li>
            <li>
                <a href="{{ url('hotel') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/hotel.gif') }}" alt="logo">
                    <span> Hotels</span>
                </a>
            </li>
            <li>
                <a href="{{ url('cab') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/car.gif') }}" alt="logo">
                    <span> Cabs</span>

                </a>
            </li>
            <li>
                <a href="{{ url('packages') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/sun-lounger.gif') }}" alt="logo">
                    <span> Holiday </span>
                </a>
            </li>
        </ul>
        <ul class="second-tabs">
            <li>
                <a href="{{ url('membership') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/verified.gif') }}" alt="logo">
                    <span>GBO Membership</span>
                </a>
            </li>
            <li>
                <a href="{{ url('cab/Airport-Transfer') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/car-insurance.gif') }}" alt="logo">
                    <span>Airport Cabs</span>
                </a>
            </li>
            <li>
                <a href="{{ url('hotel') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/building.gif') }}" alt="logo">
                    <span>Homestays & Villas</span>
                </a>
            </li>
            <li>
                <a href="{{ url('cab/Round-Trip') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/taxi.gif') }}" alt="logo">
                    <span>Outstation Cabs</span>
                </a>
            </li>
            <li>
                <a href="{{ url('packages#destinations') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/price-tag.gif') }}" alt="logo">
                    <span>Recommended Packages</span>
                </a>
            </li>
            <li>
                <a href="{{ url('blogs') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/photo-gallery.gif') }}" alt="logo">
                    <span>Blogs</span>
                </a>
            </li>
            <li>
                <a href="{{ url('flight#popularFlights') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/signposts.gif') }}" alt="logo">
                    <span>Popular Flights </span>
                </a>
            </li>
            <li>
                <a href="{{ url('hotel') }}">
                    <img src="{{ url('images/web-assets/home-icons/gif/hotel (1).gif') }}" alt="logo">
                    <span>Popular Hotels</span>
                </a>
            </li>

        </ul>

    </menu>

    <div class="offcanvas" id="offcanvas">
        <form class="text-box">
            <div class="between">
                <h6>Login/Signup to</h6>
                <span class="x">x</span>
            </div>
            <div class="offer-box">
                <ul class="offer-window">
                    <li>Join the club of 10cr+ happy travellers.</li>
                    <li>Get 12% OFF on flights as a welcome gift.</li>
                    <li>Get 20% OFF on hotels as welcome gift.</li>
                    <li>Book hotels @ ₹0 and pay later.</li>
                </ul>
            </div>
            <input type="tel" placeholder="Enter mobile number" pattern="[0-9]{10}" maxlength="10" minlength="10"
                title="Please enter a 10-digit mobile number">

            <button class="">continue</button>
            <div>
                <small>by proceeding, you agree to GoingBo's
                    <a href="#" rel="noopener noreferrer">
                        Privacy Policy, User Agreement
                    </a>
                    and
                    <a href="#" rel="noopener noreferrer">
                        T&Cs.
                    </a>
                </small>
            </div>
        </form>
    </div>

    <article class="res-display">
        @include('user.components.forms.form')
    </article>

    <section class="aboutus">
        <div class="section_head">
            <h4 class="section_title">
                Search Flights, Hotels, Cab and Holiday Packages
            </h4>
        </div>

        <div class="about_content">
            <p class="details">
                In the Indian travel market, <strong>Goingbo</strong> is a reputable name and one of the biggest online travel platforms
                in the country. We provide "end-to-end" travel options, such as airline tickets, hotel reservations, taxi and
                bus bookings, rail tickets, and vacation packages. We also provide value-added supplementary services.
            </p>

            <p class="details">
                We have made it easier for you to find ideal travel deals that fit your preferences because we know that organizing
                a vacation can be stressful. Our website is easy to use and offers numerous options for every traveller—whether
                they’re travelling for business, solo adventure, or a family holiday.
            </p>

            <p class="details">
                From <strong>vacation packages</strong> to <strong>flights and hotels</strong>, we provide all you need for a successful trip.
                Our interactions are built on honesty and transparency — with fair pricing and no hidden charges.
            </p>

            <p class="details">
                Goingbo pledges to make your trip unforgettable. Explore our multi-destination packages:
                <br />
                <a href="/packages/goa-honeymoon" class="a-line">Goa Honeymoon Packages</a>,
                <a href="/packages/shimla-manali-honeymoon" class="a-line">Shimla Kullu Manali Honeymoon Packages</a>,
                <a href="/packages/kerala-honeymoon" class="a-line">Kerala Honeymoon Packages</a>,
                <a href="/packages/kashmir-tour" class="a-line">Kashmir Honeymoon Packages</a>,
                <a href="/packages/ooty-tour" class="a-line">Ooty Honeymoon Packages</a>, and more.
            </p>
        </div>
    </section>


</main>

@endsection

@push('js')
<script>
    var offCanvas = document.getElementById("offcanvas")
    var closeButton = offCanvas.querySelector(".x");

    const closeCanvas = () => {
        offCanvas.style.display = "none"
    }

    closeButton.addEventListener("click", closeCanvas)
</script>

@endpush