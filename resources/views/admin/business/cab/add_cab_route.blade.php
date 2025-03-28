@extends('admin.business.layouts.app')

@push('css')
<style>
    /* .vu-suggestion:not(.active){
        display: none;
    } */
</style>
@endpush
@section('content')
    <main>
        @include('admin.components.response')
        <div>
            <h1 class="page_title">Cab Route Details</h1>
            <p class="page_sub_title">Let's add new cab route  in group</p>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="hidden">
                @csrf
                <input type="hidden"  name="vehicle_number" value="{{$data['id']}}">
            </div>
            <section>
                <div class="field_group">
                    <div class="field">
                        <label for="owner_name">Owner name</label>
                        <input type="text"  id="owner_name" value="{{$data['owner_name']}}" disabled>
                    </div>
                    <div class="field">
                        <label for="driver_name"> Driver Name </label>
                        <input type="text"  id="driver_name" value="{{$data['driver_name']}}" disabled>
                    </div>
                    <div class="field">
                        <label for="vehicle_number"> Vehicle number</label>
                        <input type="text"  id="vehicle_number" value="{{$data['vehicle_number']}}" disabled>
                    </div>
                   
                </div>
               
            </section>
            <section>
                <div class="field_group">
                    <div class="field">
                        <label for="from_location">Going from</label>
                        <div class="vu-select" style="position: relative">
                            <div class="vu-content">
                                <input type="hidden" name="from_location" class="city_id" id="from_location_hidden">
                                <input type="text" id="from_location"  class="vu-input"  placeholder="Type city name...">
                            </div>
                            <div class="vu-suggestion" id="from_location_suggestions" style="position: absolute;width:100%;background:white;"></div>
                        </div>
                    </div>
                    <div class="field">
                        <label for="to_location"> Going to location</label>
                        <div class="vu-select" style="position: relative">
                            <div class="vu-content">
                                <input type="hidden" id="to_location_hidden" name="to_location" class="city_id" >
                                <input type="text" id="to_location"  class="vu-input" placeholder="Type city name...">
                            </div>
                            <div class="vu-suggestion" id="to_location_suggestions" style="position: absolute;width:100%;background:white;"></div>
                        </div>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="night_halt">Night Halt:</label>
                        <select id="night_halt" name="night_halt" >
                            <option value="1">Yes</option>
                            <option value="0">No </option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="price"> Price(in rupees)</label>
                        <input type="number" name="price" id="price" min="10" required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label for="free_cancel"> Free Cancellation until hrs </label>
                        <input type="number" name="free_cancel" id="free_cancel" min="1" required>
                    </div>
                    <div class="field">
                        <label for="coupon"> Coupon discount('like GBO500') </label>
                        <input type="text" name="coupon" id="coupon" >
                    </div>
                </div>
            </section>
            
            <button type="submit">Submit</button>
        </form>
    </main>
@endsection
@push('js')
    <script>
        const cities = @json($cities); // Directly inject PHP city data into JavaScript
    
        // Utility function to fetch city data based on input
        const fetchRelevantCities = (query) => {
            return cities.filter(city => city.city_name.toLowerCase().includes(query.toLowerCase()))
            .slice(0, 8); // Limit to 8 results;
        };
    
        // Function to display suggestions and set hidden inputs
        const setupCityInput = (inputId, hiddenInputId, suggestionBoxId) => {
            const input = document.getElementById(inputId);
            const hiddenInput = document.getElementById(hiddenInputId);
            const suggestionBox = document.getElementById(suggestionBoxId);
    
            input.addEventListener('input', function () {
                const value = this.value.trim();
                if (value.length < 2) {
                    suggestionBox.innerHTML = ''; // Clear suggestions if input is too short
                    return;
                }
    
                const relevantCities = fetchRelevantCities(value);
                suggestionBox.innerHTML = ''; // Clear previous suggestions
    
                // Generate and display new suggestions
                relevantCities.forEach(city => {
                    const suggestion = document.createElement('div');
                    suggestion.classList.add('vu-option');
                    suggestion.textContent = city.city_name;
                    suggestion.setAttribute('data-city-id', city.id);
    
                    // Handle selection
                    suggestion.addEventListener('click', function () {
                        input.value = city.city_name;
                        hiddenInput.value = city.id;  // Set hidden input value
                        suggestionBox.innerHTML = ''; // Clear suggestions
                    });
    
                    suggestionBox.appendChild(suggestion);
                });
            });
    
            // Hide suggestions when user clicks outside
            document.addEventListener('click', function (e) {
                if (!input.contains(e.target) && !suggestionBox.contains(e.target)) {
                    suggestionBox.innerHTML = '';
                }
            });
        };
    
        // Initialize the city inputs
        setupCityInput('from_location', 'from_location_hidden', 'from_location_suggestions');
        setupCityInput('to_location', 'to_location_hidden', 'to_location_suggestions');
    </script>
    

@endpush