@extends('user.components.layout')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
<link rel="stylesheet" href="{{ asset('css/hotel/style.css') }}" />
<style>
  .rate {
    width: max-content;
    font-size: medium;
  }

  .gap-4 {
    gap: 2rem;
  }

  .blue {
    color: blue !important;
  }

  .off {
    padding: 5px 2rem;
    font-size: small;
  }
</style>
@endpush
@section('main')
<main>
  <section>
    <div class="container">
      <!-- cap container -->
      <figure class="cap-container">
        <i class="fa-solid fa-angle-left"></i>
        <div class="search-cap">
          <h3 class="heading">new delhi <span>(ndls)</span></h3>
          <div class="sub-heading">
            <span>16 aug</span>
            -
            <span>17 aug</span>
            •
            <span>1 room</span>
            •
            <span>1 guest</span>
          </div>
        </div>
        <i class="fa-regular fa-heart"></i>
      </figure>
      <!-- hotel search -->
      {{-- <form action="" class="hotel-search">
        <div class="destiantion">
          <label for="destiantion">destiantion</label>
          <input type="text" id="destiantion" placeholder="Enter City" />
        </div>
        <div class="check-in">
          <label for="check-in">check-in</label>
          <input type="datetime-local" id="check-in" placeholder="Enter check-in Date & Time" value="" />
        </div>
        <div class="check-out">
          <label for="check-out">check-out</label>
          <input type="datetime-local" id="check-out" placeholder="Enter check-out Date & Time" value="" />
        </div>
        <div class="rooms">
          <label for="rooms">rooms & guests</label>
          <input type="text" id="rooms" placeholder="1 room, 1 guest" value="1 room, 1 guest" />
        </div>
        <div>
          <button class="serch-button">search</button>
        </div>
      </form> --}}
      @inject('hotelcities', App\Models\HotelCityData::class )
      
      @php
          $hotelCities = $hotelcities::all()->map(function ($city) {
              return [
                  'name' => $city->Hotel_Name,
                  'city' => $city->City
              ];
          })->toArray();
          // dd($hotelCities);

          // Fetching the parameters from the URL (GET request)
          $whereinput = request()->get('whereinput', '');
          $hotel_city = request()->get('hotel_city', '');
          $dep_date = request()->get('dep_date');
          $ret_date = request()->get('ret_date');
          $nights = request()->get('nights');
          $room = request()->get('room', 1);
          $adult = request()->get('adult', 1);
          $child = request()->get('child', 0);
          $child_ages = request()->get('child_ages', '');

          // Additional static parameters for the URL
          $countryType = request()->get('CountryType', 'IN');
          $countryCode = request()->get('CountryCode', '');
          $country_extra_2 = request()->get('country_extra_2', '');
          $country_extra_1 = request()->get('country_extra_1', '');
      @endphp
      {{-- hotel search --}}
      <form  action="{{ url('/hotel/search_results') }}" method="GET" id="hotelSearchForm"  onsubmit="return validateForm()">

        <!-- Hidden fields for additional URL parameters -->
        <input type="hidden" name="CountryType" value="{{ $countryType }}">
        <input type="hidden" name="CountryCode" value="{{ $countryCode }}">
        <input type="hidden" name="country_extra_2" value="{{ $country_extra_2 }}">
        <input type="hidden" name="country_extra_1" value="{{ $country_extra_1 }}">
        <div class="hotel-search">
            <!-- Destination -->
            <div class="destiantion">
                <div class="wrapper location">
                    <div class="col-12">
                        <div class="vu-select from-select">
                            <div class="vu-content">
                                <label for="cityInput"> Where </label>
                                <input type="text" id="cityInput"  placeholder="{{$whereinput}}" class="vu-input" autocomplete="off" required>
                                <span id="cityname"> </span>
                                <input type="hidden" id="whereinput" name="whereinput">
                                <input type="hidden"  name="latitude">
                                <input type="hidden"  name="longitude">
                                <input type="hidden" id="hotelCityInput" name="hotel_city" >
                                <input type="hidden" id="locationCityInput" name="location_city">
                            </div>
                            <div class="vu-suggestion" id="cit-suggestion"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dates -->
            <div class="check-in">
              <div class="vu-date">
                  <div class="vu-content">
                      <label for="dep_date_1"> Check-in </label>
                      <input type="date" name="dep_date" id="dep_date_1" value="{{ $dep_date }}" required>
                      <p id="dep_day"> </p>
                  </div>
              </div>
            </div>
            <!-- Nights -->
            <span id="nights_between">{{ $nights }} nights</span>
            <input type="hidden" name="nights" value="{{ $nights }}">
            
            <!-- Check-out Date -->
            <div class="check-out">
                <div class="vu-date">
                    <div class="vu-content">
                        <label for="ret_date_1"> Check-out </label>
                        <input type="date" name="ret_date" id="ret_date_1" value="{{ $ret_date }}" required>
                        <p id="ret_day"> </p>
                    </div>
                </div>
            </div>

            <!-- Guests & Rooms -->
            <div class="paxs rooms">
                <div class="wrapper pax pax_1" tabindex="0">
                    <div class="vu-content">
                        <label for=""> Guests & Rooms </label>
                        <div class="desc" id="pass_det_1">{{ $room }} Room, {{ $adult }} Adult{{ $child > 0 ? ", $child Child" : '' }}</div>
                        <p id="fclass_1"> </p>
                    </div>
                    <div class="vu-suggest">
                        <div class="counters rflex">
                            <div class="count-wrap">
                                <h6>Rooms</h6>
                                <p>( Max 6 )</p>
                                <div class="counter_1">
                                    <i class="fa-solid fa-minus"></i>
                                    <input type="number" name="room" id="room_no" value="{{ $room }}" min="1" max="6">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </div>

                            <div class="count-wrap">
                                <h6>Adults</h6>
                                <p>(12+ years)</p>
                                <div class="counter_1">
                                    <i class="fa-solid fa-minus"></i>
                                    <input type="number" name="adult" id="adult_pax_1" value="{{ $adult }}" min="1">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </div>

                            <div class="count-wrap">
                                <h6>Children</h6>
                                <p>(0-12 years)</p>
                                <div class="counter_1">
                                    <i class="fa-solid fa-minus"></i>
                                    <input type="number" name="child" id="child_pax_1" value="{{ $child }}" min="0">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </div>

                            <!-- Display child age input if children exist -->
                            <div id="child_age_inputs" style="display: {{ $child > 0 ? 'block' : 'none' }};">
                                @foreach(explode(',', $child_ages) as $index => $age)
                                    <div class="child-age-input">
                                        <label for="child{{ $index+1 }}_age">Child {{ $index+1 }} Age</label>
                                        <select id="child{{ $index+1 }}_age" name="child_ages[]" onchange="updateChildAgesArray()">
                                            @for($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ $age == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <input type="hidden" id="child_ages" name="child_ages" value="{{ $child_ages }}">
            <button type="submit" class="serch-button">Search</button>

        
    </form>

    </div>
  </section>
  <main class="main">
    <div class="container">
      <div class="row">
        <aside class="hotel-filter">
          <div class="panal">
            <div class="between filter-head">
              <h3>filters</h3>
              <span>
                <i class="fa-solid fa-filter"></i>
              </span>
            </div>
            <article>
              <h4>most popular</h4>
              <div class="between">
                <label for="cancellation">free Cancellation</label>
                <div class="flex">
                  <span>748</span>
                  <input type="checkbox" name="cancellation" id="cancellation" />
                </div>
              </div>
              <div class="between">
                <label for="breakfast">free breakfast</label>
                <div class="flex">
                  <span>413</span>
                  <input type="checkbox" name="breakfast" id="breakfast" />
                </div>
              </div>
              <div class="between">
                <label for="exceptional">free exceptional</label>
                <div class="flex">
                  <span>15</span>
                  <input type="checkbox" name="exceptional" id="exceptional" />
                </div>
              </div>
              <div class="between">
                <label for="parking">parking available</label>
                <div class="flex">
                  <span>748</span>
                  <input type="checkbox" name="parking" id="parking" />
                </div>
              </div>
            </article>
            <article>
              <h4>user rating</h4>
              <div class="between">
                <label for="exceptional">exceptional: 9+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="exceptional" />
                </div>
              </div>
              <div class="between">
                <label for="excellent">excellent: 8+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="excellent" />
                </div>
              </div>
              <div class="between">
                <label for="very-good">very good: 7+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="very-good" />
                </div>
              </div>
              <div class="between">
                <label for="good">good: 6+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="good" />
                </div>
              </div>
              <div class="between">
                <label for="pleasant">pleasant: 5+</label>
                <div class="flex">
                  <span>748</span>
                  <input type="radio" name="rating" id="pleasant" />
                </div>
              </div>
            </article>
            <article>
              <h4>facilities</h4>
              <div class="between">
                <label for="internet">internet access</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="internet" id="internet" />
                </div>
              </div>
              <div class="between">
                <label for="room-service">room service</label>
                <div class="flex">
                  <span>310</span>
                  <input type="checkbox" name="room-service" id="room-service" />
                </div>
              </div>
              <div class="between">
                <label for="security">CCTV/security</label>
                <div class="flex">
                  <span>303</span>
                  <input type="checkbox" name="security" id="security" />
                </div>
              </div>
              <div class="between">
                <label for="non-smoking">non-smoking rooms</label>
                <div class="flex">
                  <span>275</span>
                  <input type="checkbox" name="non-smoking" id="non-smoking" />
                </div>
              </div>
              <button class="view">view more</button>
            </article>
            <article>
              <h4>star rating</h4>
              <ul class="rating-tabs">
                <li>5 stare <span>(51)</span></li>
                <li>4 stare <span>(51)</span></li>
                <li>3 stare <span>(51)</span></li>
                <li>2 stare <span>(51)</span></li>
                <li>1 stare <span>(51)</span></li>
              </ul>
            </article>
            <article>
              <h4>accommodation type</h4>
              <ul class="rating-tabs">
                <li>hostel <span>(72)</span></li>
                <li>hotel <span>(855)</span></li>
                <li>bed and breakfast <span>(51)</span></li>
                <li>motel <span>(51)</span></li>
                <li>serviced apaetment <span>(51)</span></li>
              </ul>
            </article>
            <article>
              <h4>payment mode</h4>
              <div class="between">
                <label for="prepaid">prepaid</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="prepaid" id="prepaid" />
                </div>
              </div>
              <div class="between">
                <label for="o-payment">book with 0 payment</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="o-payment" id="o-payment" />
                </div>
              </div>
              <div class="between">
                <label for="pay-at-hotel">pay at hotel</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="pay-at-hotel" id="pay-at-hotel" />
                </div>
              </div>
            </article>
            <article>
              <h4>meals</h4>
              <div class="between">
                <label for="dinner">dinner included</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="included" id="dinner" />
                </div>
              </div>
              <div class="between">
                <label for="breakfast">breakfast included</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="included" id="breakfast" />
                </div>
              </div>
              <div class="between">
                <label for="lunch">lunch included</label>
                <div class="flex">
                  <span>333</span>
                  <input type="checkbox" name="included" id="lunch" />
                </div>
              </div>
            </article>
          </div>
        </aside>
        <!-- hotel Result -->
        <section class="hotel-result">
          <div class="between">
            <h1 class="blue"> Showing Properties In {{ ucfirst( session()->get('hotel_search_inputs')['hotel_city'] ?? session()->get('hotel_search_inputs')['location_city'] ?? 'Unknown') }} </h1>
            <select name="sort" id="sort">
              <optgroup id="sort-opt">
                <option value="popularity">Popularity</option>
              </optgroup>
            </select>
          </div>
          <!-- Display Special Hotels -->
          @foreach($spacialhotels as $hotel)
          <div class="panal">
            <article class="hotel-card">
              <div class="img-box">
                <span class="fav">
                  <i class="fa-regular fa-heart"></i>
                </span>
                <div class="hotel-slider owl-carousel owl-theme">
                  @php
                    // Check if hotel_images is already an array or needs to be decoded
                    $images = is_array($hotel->hotel_images) ? $hotel->hotel_images : json_decode($hotel->hotel_images, true);
                  @endphp
                  @foreach($images as $image)
                    <div class="item">
                      {{-- "{{ url('/images/special-hotels/' . $image->type) }}" --}}
                      <img src="{{ asset('/images/special-hotels/' . $image['type']) }}" alt="{{ $hotel->hotel_name }}" class="img-fluid logo">
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="text-box">
                <article class="left">
                  <div class="headline">
                    <h2 class="title">
                      {{ $hotel->hotel_name }}
                    </h2>
                    <div class="reviews">
                      @for ($i = 0; $i < $hotel->hotel_rating; $i++)
                        <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>
                  </div>
                  <p class="address">
                    {{ $hotel->hotel_location }}<span class="dot">•</span>{{ $hotel->hotel_address }}

                  </p>
                  <p>

                  </p>
                  <div class="badges">
                    <span class="rate">{{ $hotel->hotel_rating }}</span>
                    <span class="condition">good</span>
                    <span class="dot">•</span>
                    <div class="rate-count">{{ $hotel->hotel_reviews }} ratings</div>
                  </div>
                  <div class="offer">
                    <p>book with Rs.0 payment</p>
                    <p>Free Cancellation till {{ date('M d Y h:i A', strtotime($hotel->created_at)) }}</p>
                  </div>
                  <div class="services">
                    <div class="flex">
                      <img src="{{ asset('images/hotel/icons/bwol.png') }}" alt="" width="20" height="20">
                      <p>Restaurants</p>
                    </div>
                    <div class="flex">
                      <img src="{{ asset('images/hotel/icons/towel.png') }}" alt="" width="20" height="20">
                      <p>24*7 Room Service</p>
                    </div>
                  </div>
                </article>
                <article class="right">
                  <div class="off"> GBO Special Hotels </div>
                  <div class="off">5 rooms left</div>
                  <div class="price-box">
                    <del class="old-price">&#8377;3,339</del>
                    {{-- <h2 class="price">&#8377;{{ $hotel->hotel_room['roomofferprice'] }}</h2> --}}
                    <p>+302 tax & fees</p>
                    <p>per night, per room</p>
                  </div>
                  <button class="book"> <a href="{{ url('special-hotel/' . $hotel->id ) }}"> Book Now </a> </button>
                </article>
              </div>
          </div>
          </article>
          @endforeach

          {{-- @php dd($hotels) @endphp --}}
          <!-- Display Fetched Hotels -->
          @foreach($hotels as $hotel)

          <div class="panal">
            <article class="hotel-card">
              <div class="img-box">
                <span class="fav">
                  <i class="fa-regular fa-heart"></i>
                </span>
                @if(isset($hotel['Images']) && is_array($hotel['Images']) && count($hotel['Images']) > 0)
                <div class="hotel-slider owl-carousel owl-theme">
                  @foreach($hotel['Images'] as $image)
                  <div class="item">
                    <img src="{{ $image }}" alt="{{ $hotel['HotelName'] }}" class="img-fluid" loading="lazy">
                  </div>
                  @endforeach
                </div>
                @endif
              </div>
              <div class="text-box">
                <article class="left">
                  <div class="headline flex blue">
                    <h2 class="title">{{ $hotel['HotelName'] }}</h2>
                    <div class="badges">
                      <span class="rate">{{ $hotel['HotelRating'] }}
                        <i class="fa-solid fa-star"></i>
                        <span class="condition">({{ rand(10,15) * $hotel['HotelRating'] }})</span>
                      </span>
                    </div>
                  </div>
                  <p class="address">
                    {{ $hotel['Address'] }}
                  </p>
                  @if(isset($hotel['PhoneNumber']))
                  <p class="rate">
                    <i class="fa-solid fa-phone"></i>
                    {{ $hotel['PhoneNumber'] }}
                  </p>
                  @endif

                  <div class="offer flex gap-4">
                    @if(isset($hotel['CheckInTime']) )
                    <p> Check-In : {{ $hotel['CheckInTime'] }} </p>
                    @endif
                    @if(isset($hotel['CheckOutTime']) )
                    <p> Check-Out : {{ $hotel['CheckOutTime'] }} </p>
                    @endif
                  </div>
                  <div class="services">
                    @if(isset($hotel['HotelFacilities']) && is_array($hotel['HotelFacilities']) && count($hotel['HotelFacilities']) > 0)
                    @foreach($hotel['HotelFacilities'] as $index => $facility)
                    @if($index <=1 )
                      <div class="flex">
                      <i class="fa-solid fa-hotel"></i>
                      <p>{{ $facility }}</p>
                  </div>
                  @endif
                  @endforeach
                  <a href="{{ url('hotel/view/' . $hotel['HotelCode'] ) }}" class="see-more" style="cursor: pointer; color: blue;">see more</san>

                    <!-- @if(count($hotel['HotelFacilities']) > 5)
                        <span class="show-less" style="cursor: pointer; color: blue; display: none;">Show Less</span>
                    @endif -->
                    @endif
              </div>
            </article>
            <article class="right">
              <div class="off">Rooms available</div>
              {{-- <div class="price-box">
                    <del class="old-price">Old price data</del>
                    <h2 class="price">New price data</h2>
                    <p>Additional pricing info</p>
                  </div> --}}
              <a class="book" href="{{ url('hotel/view/' . $hotel['HotelCode'] ) }}"> Book now </a>
            </article>
          </div>
      </div>
      </article>
      @endforeach
    </div>
    </section>
    </div>
  </main>
  @endsection

  @push('js')
  <script src="{{ url('js/vu-select.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="{{ asset('js/hotel/main.js') }}"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_orange.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <link href="//code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
  <script src="//code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>

  <script>
        $(document).ready(function() {
        
        // Flatpickr configuration
        var reconfig = {
            minDate: "today",
            enableTime: false,
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "M j 'y",
            disableMobile: true,
            theme: "material_orange",
            // onDayCreate: setPrice,
            onChange: function(selectedDates, dateStr, instance) {
            // Handle date changes here if necessary
            }
        };

        // Initialize Flatpickr on the input elements
        var depdate_1 = flatpickr("#dep_date_1", {
            ...reconfig,
            onChange: function(selectedDates, dateStr, instance) {
                // Format the selected date as "Oct 16 '24"
                let checkInDate = selectedDates[0];
                let dayOfWeek = getDayOfWeek(checkInDate.getDay());
                
                $("#dep_day").text(dayOfWeek );

                // Update the minimum return date based on the selected departure date
                retdate_1.set("minDate", checkInDate);
                if (new Date($("#ret_date_1").val()) <= checkInDate) {
                    let newReturnDate = new Date(checkInDate);
                    newReturnDate.setDate(checkInDate.getDate() + 1);
                    retdate_1.setDate(newReturnDate, true); // Set and update return date
                }

                calculateDaysDifference();
            }
        });

        var retdate_1 = flatpickr("#ret_date_1", {
            ...reconfig,
            minDate: new Date(), // Return date should start from tomorrow
            onChange: function(selectedDates, dateStr, instance) {
                // Format the selected date as "Oct 16 '24"
                let checkOutDate = selectedDates[0];
                let dayOfWeek = getDayOfWeek(checkOutDate.getDay());

                // Update the displayed day and formatted date
                $("#ret_day").text(dayOfWeek);

                // Update the maximum check-in date based on the selected return date
                depdate_1.set("maxDate", checkOutDate);                
                calculateDaysDifference();
            }
        });

        function getDayOfWeek(dayIndex) {
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return days[dayIndex];
        }

        // Calculate the number of days between check-in and check-out dates
        function calculateDaysDifference() {
            let checkInDate = new Date($("#dep_date_1").val());
            let checkOutDate = new Date($("#ret_date_1").val());
            let differenceInTime = checkOutDate.getTime() - checkInDate.getTime();
            let differenceInDays = differenceInTime / (1000 * 3600 * 24);

            // Display the number of nights between check-in and check-out dates
            let nightsSpan = $("#nights_between");
            if (differenceInDays > 0) {
                nightsSpan.text(differenceInDays + " night(s)");
                // Set the value of the hidden input field to differenceInDays
                $("input[name='nights']").val(differenceInDays);
            } else {
                nightsSpan.text("");
                // Reset the value of the hidden input field if differenceInDays is not positive
                $("input[name='nights']").val("");
            }
        }


    });





    $(".counter_1").each(function() {
        let val = $(this).find("input").eq(0);
        let maxVal = 0;
        let minVal = 0;
        // Set max and min values based on the input name
        if (val.attr('name') === 'room') {
            maxVal = 6;
            minVal = 1;
        } else if (val.attr('name') === 'adult') {
            maxVal = 48;
            minVal = 1;
        } else if (val.attr('name') === 'child') {
            maxVal = 12;
            minVal = 0;
        }

        $(this).find(".fa-plus").on('click', function() {
            let x = Number(val.val()) + 1;
            val.val(x > maxVal ? maxVal : x);
            updateCount_1();
        });
        $(this).find(".fa-minus").on('click', function() {
            let x = Number(val.val()) - 1;
            val.val(x < minVal ? minVal : x);
            updateCount_1();
        });
    });


    document.querySelector(".pax_1").addEventListener('click', function() {
        function hide_pax(event) {
            if (!document.querySelector(".pax_1").contains(event.target)) {
                document.querySelector(".pax_1").classList.remove('active');
                updateCount_1();
                document.removeEventListener('click', hide_pax);
            }
        }
        if (!this.classList.contains('active')) {
            this.classList.add('active');
            document.addEventListener('click', hide_pax);
        }
    });

    function updateCount_1() {
        var roomInput = document.getElementById('room_no');
        var adultInput = document.getElementById('adult_pax_1');
        var childInput = document.getElementById('child_pax_1');

        var totalRooms = parseInt(roomInput.value);
        var totalAdults = parseInt(adultInput.value);
        var totalChildren = parseInt(childInput.value);

        // Calculate total passengers based on the selected number of rooms
        var totalPassengers = totalAdults + totalChildren;

        // Set limits based on the maximum occupancy per room
        var maxAdultsPerRoom = 8;
        var maxChildrenPerRoom = 2;
        var maxPassengersPerRoom = maxAdultsPerRoom + maxChildrenPerRoom;
        var maxPassengers = totalRooms * maxPassengersPerRoom;
        var maxAdults = 8 * totalRooms;
        var maxChildren = 2 * totalRooms;

        // Condition: Every room must have at least one adult
        if (totalAdults < totalRooms) {
            alert(`Each room must have at least one adult. Please increase the number of adults.`);
            adultInput.value = totalRooms;
            totalAdults = totalRooms;
        }

        if (totalAdults > maxAdults || totalChildren > maxChildren) {
            alert(
                `Total number of passengers cannot exceed ${maxAdults} adults and ${maxChildren} children based on the selected number of rooms.`);
            // Reset values
            roomInput.value = 1;
            adultInput.value = 1;
            childInput.value = 0;
            totalPassengers = 1;
        }
        if (totalPassengers > maxPassengers) {
            alert(`Total number of passengers cannot exceed the maximum capacity of ${maxPassengers}.`);
            // Reset values
            roomInput.value = 1;
            adultInput.value = 1;
            childInput.value = 0;
            totalPassengers = 1;
        }

        document.getElementById("fclass_1").innerText = document.querySelector(
            'input[name="travelclass"]:checked ~ label').innerText;
        let pass = '';
        pass += `<span class="paxx">${totalRooms} <i>${(totalRooms > 1 ? "Rooms" : "Room")}</i></span>`;
        pass += `<span class="paxx">${totalAdults} <i>${(totalAdults > 1 ? "Adults" : "Adult")}</i></span>`;
        if (totalChildren > 0)
            pass +=
            `, <span class="paxx">${totalChildren} <i>${(totalChildren > 1 ? "Children" : "Child")}</i></span>`;

        document.getElementById("pass_det_1").innerHTML = pass;

        // Show child age inputs if children are selected
        var childAgeInputs = document.getElementById("child_age_inputs");
        childAgeInputs.innerHTML = ''; // Clear existing inputs

        if (totalChildren > 0) {
            for (var i = 1; i <= totalChildren; i++) {
                var childAgeInput = document.createElement('div');
                var selectOptions = '';
                for (var j = 1; j <= 12; j++) {
                    selectOptions += `<option value="${j}">${j}</option>`;
                }
                childAgeInput.innerHTML = `
                        <div class="child-age-input">
                            <label for="child${i}_age">Child ${i} Age</label>
                            <select id="child${i}_age"  onchange="updateChildAgesArray()" >
                                <option value="Select">Select</option>
                                ${selectOptions}
                            </select>

                        </div>
                    `;
                childAgeInputs.appendChild(childAgeInput);
            }
            childAgeInputs.style.display = "block";
        } else {
            childAgeInputs.style.display = "none";
        }
    }



    function updateChildAgesArray() {
        var totalChildren = parseInt(document.getElementById('child_pax_1').value);
        var childAges = [];
        for (var i = 1; i <= totalChildren; i++) {
            var selectElement = document.getElementById(`child${i}_age`);
            if (selectElement && selectElement.value !== "Select") {
                childAges.push(selectElement.value);
            }
        }
        document.getElementById('child_ages').value = childAges.join(',');
    }

    function validateForm() {


        var totalChildren = parseInt(document.getElementById('child_pax_1').value);
        var childAges = document.getElementById('child_ages').value;

        if (totalChildren > 0) {
            var agesArray = childAges.split(',');
            if (agesArray.length < totalChildren || agesArray.includes("") || agesArray.includes("Select")) {
                alert("Please select ages for all children.");
                return false;
            }
        }
        return true;
    }



/*    let stars = document.getElementsByClassName("star");
    let output = document.getElementById("output");
    let ratingsInput = document.getElementById("ratings");

    // Funtion to update rating
    function gfg(n) {
        remove();
        for (let i = 0; i < n; i++) {
            if (n == 1) cls = "one";
            else if (n == 2) cls = "two";
            else if (n == 3) cls = "three";
            else if (n == 4) cls = "four";
            else if (n == 5) cls = "five";
            stars[i].className = "star " + cls;
        }
        output.innerText = "Rating : " + n + "/5";
        ratingsInput.value = n; // Update the hidden input field value
    }

    // To remove the pre-applied styling
    function remove() {
        let i = 0;
        while (i < 5) {
            stars[i].className = "star";
            i++;
        }
    }
*/
    var cinput = document.getElementById('cityInput');
    cinput.addEventListener('click', function () {
        const cityInput = document.getElementById('cityInput');
        const whereinput = document.getElementById('whereinput');
        const countryTypeInputs = document.querySelectorAll('input[name="CountryType"]');
        // let countryType = document.querySelector('input[name="CountryCode"]').value;
        let countryType = document.querySelector('input[name="CountryType"]').value;
        const suggestionBox = document.getElementById('cit-suggestion');
        const hotelCityInput = document.getElementById('hotelCityInput');
        const locationCityInput = document.getElementById('locationCityInput');

        const hotelCities = @json($hotelCities);

        countryTypeInputs.forEach(input => {
            input.addEventListener('change', function () {
                countryType = document.querySelector('input[name="CountryType"]').value;
                // console.log('CountryType changed to:', countryType);
            });
        });

        cityInput.addEventListener('input', function () {
            const query = cityInput.value;
            if (query.length > 2) {
                // console.log('Fetching suggestions for query:', query);
                fetchSuggestions(query, countryType);
            }
        });



        

    function fetchSuggestions(query, countryType) {
        const apiKey = '42ecab6d4ad64005a56cfd68f0258f7e';
        if (countryType === 'IN') {
            // Fetch hotel cities and locations from OpenCage API
            const filteredHotelCities = hotelCities.filter(hotel => hotel.name.toLowerCase().includes(query.toLowerCase()));
            // console.log('Filtered hotel cities:', filteredHotelCities);

            fetch(`https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(query)}&key=${apiKey}&countrycode=IN&limit=5`)
            .then(response => response.json())
            .then(data => {
                // console.log('Fetched location data:', data);
                const locations = data.results
                    .map(item => {
                        const components = item.components;
                        const city = components.city || components._normalized_city || components.state_district || 'Unknown city';
                        return {
                            name: city !== 'Unknown city' ? item.formatted : null,
                            type: item.components._type || 'location',
                            city: city,
                            lat: item.geometry.lat,   // Extract latitude
                            lng: item.geometry.lng    // Extract longitude
                        };
                    })
                    .filter(location => location.city !== 'Unknown city');
                const combinedResults = combineResults(filteredHotelCities, locations);
                // console.log('Combined results:', combinedResults);
                updateSuggestions(combinedResults);
            })
            .catch(error => console.error('Error fetching locations:', error));
        } else {
            // Fetch locations from OpenCage API for other countries
            fetch(`https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(query)}&key=${apiKey}&countrycode=${countryType}&limit=8`)
            .then(response => response.json())
            .then(data => {
                // console.log('Fetched location data:', data);
                const locations = data.results
                    .map(item => {
                        const components = item.components;
                        const city = components.city || components._normalized_city || components.state_district || 'Unknown city';
                        return {
                            name: city !== 'Unknown city' ? item.formatted : null,
                            type: item.components._type || 'location',
                            city: city,
                            lat: item.geometry.lat,   // Extract latitude
                            lng: item.geometry.lng    // Extract longitude
                        };
                    })
                    .filter(location => location.city !== 'Unknown city');
                updateSuggestions(locations.slice(0, 8));
            })
            .catch(error => console.error('Error fetching locations:', error));
        }
    }

        function combineResults(hotelCities, locations) {
            let combined = [];
            const hotelResults = hotelCities.map(hotel => ({
                name: hotel.name,
                type: 'Hotel',
                city: hotel.city
            }));

            const maxResults = 8;
            const maxPerType = 4;

            let hotelsToShow = hotelResults.slice(0, maxPerType);
            let locationsToShow = locations.slice(0, maxPerType);

            if (hotelsToShow.length < maxPerType) {
                locationsToShow = locations.slice(0, maxResults - hotelsToShow.length);
            } else if (locationsToShow.length < maxPerType) {
                hotelsToShow = hotelResults.slice(0, maxResults - locationsToShow.length);
            }

            combined = [...hotelsToShow, ...locationsToShow];
            return combined;
        }

        function updateSuggestions(suggestions) {
            // console.log('Updating suggestions:', suggestions);
            suggestionBox.innerHTML = '';
            if (suggestions.length === 0) {
                const noResults = document.createElement('div');
                noResults.textContent = 'No results found';
                suggestionBox.appendChild(noResults);
                return;
            }
            suggestions.forEach(suggestion => {
                const suggestionItem = document.createElement('div');
                suggestionItem.classList.add('suggestion-item');
                
                const icon = document.createElement('i');
                if (suggestion.type === 'Hotel') {
                    icon.classList.add('fas', 'fa-building');
                    icon.style.color = 'var(--fv_sec)';
                } else {
                    icon.classList.add('fas', 'fa-map-marker-alt');
                    icon.style.color = 'var(--fv_prime)';
                }

                const textWrapper = document.createElement('div');
                const name = document.createElement('div');
                name.textContent = suggestion.name;
                const typeClass = document.createElement('div');
                typeClass.textContent = suggestion.city;
                typeClass.style.fontSize = 'small';

                textWrapper.appendChild(name);
                textWrapper.appendChild(typeClass);
                suggestionItem.appendChild(icon);
                suggestionItem.appendChild(textWrapper);

                suggestionItem.addEventListener('click', function () {
                    // console.log('Suggestion clicked:', suggestion);
                    cityInput.value = suggestion.name;
                    whereinput.value = suggestion.name;
                    document.getElementById('cityname').textContent = suggestion.city; 

                    if (suggestion.type === 'Hotel') {
                        // console.log('Setting hotelCityInput for hotel:', suggestion.city);
                        hotelCityInput.value = suggestion.city;
                        locationCityInput.value = '';
                    } else {
                        // console.log('Setting locationCityInput for location city:', suggestion.city);
                        locationCityInput.value = suggestion.city;
                        hotelCityInput.value = '';
                         // Save latitude and longitude to hidden inputs
                        document.querySelector('input[name="latitude"]').value = suggestion.lat;
                        document.querySelector('input[name="longitude"]').value = suggestion.lng;
                    }
                    suggestionBox.innerHTML = '';
                    suggestionBox.classList.remove('active');
                });

                

                suggestionBox.appendChild(suggestionItem);
            });
            suggestionBox.classList.add('active');
        }
    });
    
    // Clear the city name when the input is empty or whitespace
    cityInput.addEventListener('input', function () {
        // console.log(cityInput.value);
        if (cityInput.value === "") {
            cityname.textContent = '' ;
        }
    });

    

    
</script>


  @endpush