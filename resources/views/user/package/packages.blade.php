@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="{{ url('css/user_css/packages.css') }}">
@endpush

@section('main')
<main>

    <section class="search-box">
        <div class="container">
            <!-- cap container -->
            <figure class="cap-container">
                <i class="fa-solid fa-angle-left"></i>
                <div class="search-cap">
                    <h3 class="heading">new delhi <span>(ndls)</span></h3>
                    <div class="sub-heading">
                        <span>16 aug</span>
                        <!-- -
                        <span>17 aug</span> -->
                        •
                        <span>honeymoon</span>
                    </div>
                </div>
                <i class="fa-regular fa-heart"></i>
            </figure>
            <!-- package search -->
            <form action="" class="package-search">

                <div class="type">
                    <label for="pckg_categories">package type </label>
                    <select id="pckg_categories" name="pckg_categories">
                        <option value="Family"> Family </option>
                        <option value="Honeymoon"> Honeymoon </option>
                        <option value="Friends/Group"> Friends/Group </option>
                        <option value="Pilgrimage"> Pilgrimage </option>
                    </select>
                </div>
                <div>
                    <label for="f_city">city <small>(from)</small></label>
                    <div class="vu-select">
                        <div class="vu-content">
                            <input class="vu-input" type="text" name="going_from_city" id="f_city" class="vu-input" placeholder="city (from)">
                            <input type="hidden" name="going_from" class="city_id">
                        </div>
                        <div class="vu-suggestion"></div>
                    </div>
                </div>
                <div>
                    <label for="c_date">departure date</label>
                    <input readonly name="c_date" id="c_date" placeholder="DD/MM/YY" >
                </div>
                <div>
                    <button class="serch-button">search</button>
                </div>
            </form>
        </div>

    </section>
    <h1>Packages for Top Family Destinations</h1>
    <div class="p-card">
        @foreach($packages as $index => $package)


        <div class="package-card" style="display: {{ $index < 10 ? 'flex' : 'none' }};">
            @php
            if (!function_exists('calculatePrices')) {
            function calculatePrices($price)
            {
            $discountPercentage = rand(50, 60);
            $originalPrice = $price / (1 - $discountPercentage / 100);

            return [
            'originalPrice' => round($originalPrice),
            'discountedPrice' => $price,
            'discountPercentage' => $discountPercentage,
            ];
            }
            }

            $prices = calculatePrices($package['price']);
            @endphp
            <figure class="img-box">
                <a target="_blank" href="{{ url('packages/' . $package['slug']) }}">
                    <img src="{{ url('/images/package/' . $package['image']) }}" alt="" class="" lazyloaded>
                </a>
                <span class="discount-badge">{{ $prices['discountPercentage'] }}%
                    Off</span>
            </figure>
            <div class="text-box">
                <h2 class="title">
                    <a target="_blank" href="{{ url('packages/' . $package['slug']) }}">
                        <span class="">{{ $package['title'] }}</span>
                    </a>
                </h2>
                <div class="between">
                    <div class="left">
                        <h6>
                            <span>
                                {{ $package['night'] + 1 }} days
                                &amp;
                                {{ $package['night'] }} nights
                            </span>
                            <small class="">Customizable</small>
                        </h6>
                        <h5>
                            <small>Starting from:</small>
                            <del class="old-price">
                                <i class="fa-solid fa-indian-rupee"></i>
                                {{ $prices['originalPrice'] }}/-
                            </del>
                        </h5>
                        <h2 class="price">
                            <small>
                                <i class="fa-solid fa-indian-rupee"></i>
                            </small>
                            {{ $prices['discountedPrice'] }}/-
                        </h2>
                        <p class="note">Per Person on twin sharing.</p>
                        <div class="flex">
                            <strong>
                                <i class="fa-solid fa-package"></i>
                                Hotels:</strong>
                            <div class="package">
                                <span>4 star</span>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        {{-- <div class="">
                            <strong>
                                <i class="fa-solid fa-location-dot"></i>
                                cities:</strong>
                            <ul class="cities">
                                <li>Maldives (5D)</li>
                                <li>Maldives (5D)</li>
                                <li>Maldives (5D)</li>
                                <li>Maldives (5D)</li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="right">
                        <button class="compare-btn">
                            <i class="fa-solid fa-plus"></i>
                            <span>add to Compare</span>
                        </button>
                        <div>
                            <h6>Activities</h6>
                            <ul class="activities">
                                <li>Scuba Diving</li>
                                <li>Adventure</li>
                                <li>Underwater World</li>
                                <li>Nature</li>
                                <li>City Tour</li>
                                <li>Hill station</li>
                                <li>Water Activities</li>
                                <li>Family</li>
                                <li>Budget</li>
                            </ul>
                        </div>
                        <p class="short_des">{{ $package['short_des'] }}</p>
                    </div>
                </div>
                <div class="buttons">
                    <a class="view-btn" href="{{ url('packages/' . $package['slug']) }}">view details</a>
                    <button id="registerbtn-{{ $index }}" class="customize-btn" data-id="{{ $package['title']  }}">Customize &amp; Get Quotes</button>

                </div>

            </div>

        </div>
        @endforeach
    </div>
    @if(count($packages) > 0)
    <button id="load-more">Load More</button>
    @endif     
    


    <section id="destinations">
        <div class="section_head rflex jcsb aic">
            <h4 class="section_title">Recommended Package</h4>
        </div>
        <div class="row">
            @foreach($recommends as $pkg)
            <div class="desti-wrap col-12 col-s-6 col-l-3">
                <a class="wrapper destination" href="{{ url('packages/' . $pkg['slug']) }}">
                    <img loading="lazy" src="{{ url('images/package/' . $pkg['image']) }}" alt="">
                    <div class="details">
                        <div class="detail">
                            <h6 class="desti">{{ $pkg['title'] }}</h6>
                            <p class="packages">
                                <span>{{ $pkg['night'] + 1 }}</span>Days Package
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <!-- The Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-content">                                                                  
            <div class="custom-modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Package Enquiry Registration </h5>                    
                </div>
                <div class="modal-body">
                    <form action="{{ url('packages/package-enquiry')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Enter Name" maxlength="50" required>
                            <i class="fas fa-building icon"></i>
                        </div>
                        <div class="form-group">
                            <input type="text" id="contactNo" name="contactNo" placeholder="Enter Contact No" pattern="\d{10}" title="Please enter exactly 10 digits" required>
                            <i class="fas fa-phone icon"></i>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Enter E-mail" maxlength="50" required>
                            <i class="fas fa-envelope icon"></i>
                        </div>
                        <div class="form-group">
                            <input type="text" id="city" name="city" placeholder="Enter City" maxlength="16" required>
                            <i class="fas fa-city icon"></i>
                        </div>
                        <div class="form-group doj">
                            <input  id="date_of_journey" name="date_of_journey" placeholder="Date of Journey" required>
                            <i class="fas fa-calendar-alt icon"></i>
                        </div>                        
                        <div class="form-group">
                            <input type="number" id="number_of_days" name="number_of_days" placeholder="Number of Days" min="1" required>
                            <i class="fas fa-clock icon"></i>
                        </div>                        
                        <div class="form-group">
                            <input type="text" id="destination" name="destination" placeholder="Destination" value="{{ $package['title'] }}" readonly>
                            <i class="fas fa-city icon"></i>
                        </div>                        
                        <div class="form-group">
                            <input type="number" id="no_of_adults" name="no_of_adults" placeholder="Number of Adults" min="1" required>
                            <i class="fas fa-user-friends icon"></i>
                        </div>                        
                        <div class="form-group">
                            <input type="number" id="no_of_children" placeholder="Number of Children" name="no_of_children" min="0">
                            <i class="fas fa-child icon"></i>
                        </div>                        
                        <div class="form-group">
                            <input type="text" id="children_ages" name="children_ages" placeholder="Children Ages e.g., 5,7">
                            <i class="fas fa-info-circle icon"></i>
                        </div>                        
                        <button type="submit" class="btn"> Register Now </button>
                    </form>
                </div>
            </div>
            <div class="custom-modal-image">
                <img src="{{ asset('images/web assets/icon-2.png') }}" alt="Holiday Package" class="car-image" style="border-radius: 6px; ">
            </div>
            <span class="close" id="closeModal">&times;</span>
        </div>
    </div>
</main>
@endsection

@push('js')
<script>

    document.addEventListener('DOMContentLoaded', function() {
        // Get all buttons
        const buttons = document.querySelectorAll('.customize-btn');
        const modal = document.getElementById('registerModal');
        const destinationInput = document.getElementById('destination');

        // Add event listener to each button
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                const packageTitle = this.getAttribute('data-id'); // Get the dynamic title
                destinationInput.value = packageTitle; // Set the destination value in the modal
                modal.style.display = 'block'; // Show the modal
            });
        });

        // Close modal functionality
        const closeModal = document.getElementById('closeModal');
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Hide modal if clicked outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

</script>
<script src="{{ url('js/vu-select.js') }}"></script>
<script>
    const fetchOptions = (value, callback) => {
        ajax({
            url: `{{ url('api/city/') }}/${value}`,
            success: (res) => callback(JSON.parse(res)['cities']),
        });
    };

    const optionGenerator = (port) =>
        `<div class="vu-option" data-value="${port.city_name}" data-city_id="${port.id}">${port.city_name}</div>`;

    const fromSelect = new vu_select($(".vu-select")[0], {
        optionGenerator,
        fetchOptions
    });


    document.addEventListener('DOMContentLoaded', function() {
        let loadMoreBtn = document.getElementById('load-more');
        let packages = document.querySelectorAll('.package-card');
        let offset = 10;

        loadMoreBtn.addEventListener('click', function() {
            let displayed = 0;
            for (let i = offset; i < packages.length && displayed < 20; i++) {
                if (packages[i].style.display === 'none') {
                    packages[i].style.display = 'flex';
                    displayed++;
                }
            }
            offset += displayed;
            if (offset >= packages.length) {
                loadMoreBtn.style.display = 'none';
            }
        });
    });
</script>


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_orange.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>

    // Flatpickr configuration
    var config = {
        minDate: "today",
        enableTime: false,
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "j M 'y",
        disableMobile: true,
        theme: "material_orange",
        // onDayCreate: setPrice,
    };

    // Initialize Flatpickr on the input element
    var depdate = document.querySelector("#c_date");
    flatpickr(depdate, config);
    // Initialize Flatpickr on the input element
    var journeydate = document.querySelector("#date_of_journey");
    flatpickr(journeydate, config);

    jQuery(function($) {
        // toggle buttons
        $(".search-cap").click(() => {
            $(".package-search").slideToggle();
        });
        $(".fa-heart").click(function() {
            $(this).toggleClass("fa-regular fa-solid");
        });
    })

    // $(document).on('click', function(event) {
    //     var $suggestionBox = $('.vu-suggestion');
    //     if (!$suggestionBox.is(event.target) && $suggestionBox.has(event.target).length === 0) {
    //         $suggestionBox.hide();
    //     }
    // });

    // $('.vu-option').on('click', function() {
    //     $('.vu-suggestion').hide();
    //     // Optionally, handle the option click here
    //     console.log('Option clicked:', $(this).text());
    // });
</script>


@endpush