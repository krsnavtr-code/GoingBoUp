@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="css/index.css">
<style>
    /* Section base */
.destinations {
  padding: 60px 20px;
  background: #f9f9f9;
  color: #222;
}

.section_head {
  margin-bottom: 30px;
}

.section_title {
  font-size: 1.8rem;
  font-weight: 600;
  color: #222;
  text-align: center;
  width: 100%;
}

/* Grid layout */
.flights-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 24px;
}

/* Flight card */
.flight-card {
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
}

.flight-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Image box */
.img-box {
  width: 100%;
  height: 180px;
  overflow: hidden;
}

.img-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.flight-card:hover .img-box img {
  transform: scale(1.1);
}

/* Text content */
.text-box {
  padding: 16px 20px;
  text-align: center;
}

.text-box .heading {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 10px;
  color: #333;
}

.text-box .heading span {
  color: #007bff;
}

/* Destination list */
.destination-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.destination-list li {
  margin: 6px 0;
}

.flight-link {
  text-decoration: none;
  color: #555;
  font-weight: 500;
  transition: color 0.3s ease;
}

.flight-link:hover {
  color: #007bff;
}
</style>
@endpush
@section('main')
@php
$city = array(
"Mumbai" => array("name" => "Mumbai", "code" => "BOM"),
"Delhi" => array("name" => "Delhi", "code" => "DEL"),
"Kolkata" => array("name" => "Kolkata", "code" => "CCU"),
"Chennai" => array("name" => "Chennai", "code" => "MAA"),
"Hyderabad" => array("name" => "Hyderabad", "code" => "HYD"),
"Ahmedabad" => array("name" => "Ahmedabad", "code" => "AMD"),
"Bangalore" => array("name" => "Bangalore", "code" => "BLR"),
"Patna" => array("name" => "Patna", "code" => "PAT")
);
$flight = array(
"Mumbai" => array(
array("city" => "Goa", "code" => "GOI"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Ahmedabad", "code" => "AMD")
),
"Delhi" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Goa", "code" => "GOI"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Pune", "code" => "PNQ")
),
"Kolkata" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Bagdogra", "code" => "IXB")
),
"Chennai" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Madurai", "code" => "IXM"),
array("city" => "Coimbatore", "code" => "CJB")
),
"Hyderabad" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Goa", "code" => "GOI"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Delhi", "code" => "DEL")
),
"Ahmedabad" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Goa", "code" => "GOI")
),
"Bangalore" => array(
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Goa", "code" => "GOI"),
array("city" => "Hyderabad", "code" => "HYD")
),
"Patna" => array(
array("city" => "Delhi", "code" => "DEL"),
array("city" => "Mumbai", "code" => "BOM"),
array("city" => "Bangalore", "code" => "BLR"),
array("city" => "Kolkata", "code" => "CCU")
)
);
@endphp
<main>
    @include('user.components.forms.form')

<section id="popularFlights" class="destinations">
  <div class="section_head rflex jcsb aic">
    <h4 class="section_title">Popular Flight Routes</h4>
  </div>

  <div class="flights-grid">
    @foreach ($city as $origin)
      <div class="flight-card">
        <div class="img-box">
          <img
            loading="lazy"
            src="{{ url('images/flight/cities/' . $origin['name'] . '.jpg') }}"
            alt="{{ $origin['name'] }} flights"
          />
        </div>

        <div class="text-box">
          <h6 class="heading">
            Flights <span>{{ $origin['name'] }}</span> To
          </h6>

          <ul class="destination-list">
            @foreach ($flight[$origin['name']] as $destination)
              <li>
                <a
                  href="{{ url('flight/search?journey_type=1&from=' . $origin['code'] . '&to=' . $destination['code'] . '&dep_date=' . date('Y-m-d')) }}"
                  data-msg="Getting Available Flights..."
                  target="_blank"
                  class="flight-link"
                >
                  {{ $destination['city'] }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    @endforeach
  </div>
</section>

</main>
@endsection

@push('js')
<script>

</script>

@endpush