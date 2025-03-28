
@extends('admin.business.layouts.app')

@push('css')
<style>
/* Custom styling for the hotel form */
.hotel-form-container {
    width: 60%;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.hotel-form-container h2 {
    text-align: center;
    color: #333;
}

.hotel-form-container form fieldset {
    margin-bottom: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.hotel-form-container form fieldset legend {
    font-weight: bold;
    color: #333;
}

.hotel-form-container form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

.hotel-form-container form input,
.hotel-form-container form textarea,
.hotel-form-container form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.hotel-form-container form button {
    display: block;
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.hotel-form-container form button:hover {
    background-color: #0056b3;
}

.alert {
    padding: 15px;
    background-color: #4caf50;
    color: white;
    margin-bottom: 20px;
    text-align: center;
    border-radius: 5px;
}

.remove-room-button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

.remove-room-button:hover {
    background-color: #c82333;
}

.rad_div{
    display: inline-block; /* Display the divs inline */
    margin: 10px; /* Add some space between the buttons */
}

.rad_label{
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #ffffff;
    background-color: #007bff; /* Button background color */
    border: 1px solid #007bff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.rad_label:hover {
    background-color: #0056b3; /* Hover effect */
}
</style>
@endpush

@section('content')

<main>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('admin.components.response')
    <div>
        <h1 class="page_title">Add Hotel</h1>
        <p class="page_sub_title">Let's add a new hotel in the business group</p>
    </div>

    <form id="hotel-form" action="{{ url('admin/business-login/hotel/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Hotel Details -->
        <section>
            <span class="page_title">Hotel Details</span>
            <div class="field_group">
                <div class="field">
                    <label for="hotel_name">Hotel Name:</label>
                    <input type="text" id="hotel_name" name="hotel_name" required>
                </div>
                <div class="field">
                    <label for="hotel_address">Hotel Address:</label>
                    <input type="text" id="hotel_address" name="hotel_address" required>
                </div>
            </div>
            <div class="field_group">
                <div class="field">
                    <label for="hotel_description">Hotel Description:</label>
                    <textarea id="hotel_description" name="hotel_description" rows="4" required></textarea>
                </div>                        
            </div>
            <div class="field_group">
                <div class="field">
                    <label for="hotel_opened">Hotel Opened:</label>
                    <input type="text" id="hotel_opened" name="hotel_opened" required>
                </div>
                <div class="field">
                    <label for="hotel_number_of_rooms">Number of Rooms:</label>
                    <input type="text" id="hotel_number_of_rooms" name="hotel_number_of_rooms" required>
                </div>
                <div class="field">
                    <label for="hotel_renovated">Hotel Renovated:</label>
                    <input type="text" id="hotel_renovated" name="hotel_renovated">
                </div>
            </div>
            <div class="field_group">
                <div class="field">
                    <label for="hotel_rating">Hotel Rating (1-5):</label>
                    <input type="number" id="hotel_rating" name="hotel_rating" min="1" max="5" required>
                </div>
                <div class="field">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" required>
                </div>
            </div>
            <div class="field_group">
                <div class="field">
                    <label for="fax_number">Fax Number:</label>
                    <input type="text" id="fax_number" name="fax_number">
                </div>
                <div class="field">
                    <label for="country_name">Country Name:</label>
                    <input type="text" id="country_name" name="country_name" required>
                </div>
            </div>
            <div class="field_group">
                <div class="field">
                    <label for="check_in_time">Check-In Time:</label>
                    <input type="text" id="check_in_time" name="check_in_time" class="flatpickr_time" placeholder="Select time" required>
                </div>
                <div class="field">
                    <label for="check_out_time">Check-Out Time:</label>
                    <input type="text" id="check_out_time" name="check_out_time" class="flatpickr_time" placeholder="Select time" required>
                </div>
            </div>
        </section>

        <!-- Hotel Overview -->
        <section>
            <span class="page_title">Hotel Overview</span>
            <div class="field_group">
                <div class="field">
                    <label for="hotel_overview">Hotel Overview:</label>
                    <textarea id="hotel_overview" name="hotel_overview" rows="4" required></textarea>
                </div>
            </div>
            <div class="field_group">
                <div class="field">
                    <label for="hotel_policies">Hotel Policies:</label>
                    <textarea id="hotel_policies" name="hotel_policies" rows="4" required></textarea>
                </div>
            </div>
            <div class="field_group">
                <div class="field">
                    <label for="hotel_services">Hotel Services:</label>
                    <textarea id="hotel_services" name="hotel_services" rows="4" required></textarea>
                </div>
            </div>
            <div class="field_group">                
                <div class="field">
                    <label for="hotel_reviews">Hotel reviews </label>
                    <input type="number" id="hotel_reviews" name="hotel_reviews" min="1" >
                </div>
                
                <div class="field">
                    <label for="travel_insurance">Travel Insurance:</label>
                    <select id="travel_insurance" name="travel_insurance" >
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="field_group">
                <div class="field">
                    <label for="meal_type">Meal Type:</label>
                    <select id="meal_type" name="meal_type" required >
                        <option value="Veg">Veg</option>
                        <option value="Non-Veg">Non-Veg</option>
                        <option value="Veg & Non-Veg">Veg & Non-Veg</option>
                    </select>
                </div>
                <div class="field">
                    <label for="is_refundable">Is Refundable:</label>
                    <select id="is_refundable" name="is_refundable" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Hotel Policies -->
        <section>
            <span class="page_title">Hotel Policies</span>
            <div class="field_group">
                <div class="field">
                    <label for="children_policies">Children Policies:</label>
                    <input type="text" id="children_policies" name="children_policies">
                </div>                
            </div>
            <div class="field_group">
                <div class="field">
                    <label for="dining_time">Dining Time:</label>
                    <input type="text" id="dining_time" name="dining_time" class="flatpickr_time" placeholder="Select time">
                </div>
                <div class="field">
                    <label for="dining_price">Dining Price:</label>
                    <input type="text" id="dining_price" name="dining_price">
                </div>
                <div class="field">
                    <label for="type_of_dinner">Type of Dinner:</label>
                    <input type="text" id="type_of_dinner" name="type_of_dinner">
                </div>
            </div>
            <!-- Cancellation Policies -->
            <div class="field_group">
                <div class="field">
                    <label for="cancellation_policies">Cancellation Policies:</label>
                    <textarea id="cancellation_policies" name="cancellation_policies[]" rows="4"></textarea>
                </div>
            </div>
        </section>

        <!-- Location Details -->
        <section>
            <span class="page_title">Location Details</span>
            <span>Are you filling for:</span>
            <!-- Radio Buttons for Area or Location -->
            <div class="field_group">
                
                <div class="rad_div">
                    <label for="area" class="rad_label">Area</label>
                    <input type="radio" id="area" name="type" value="area" required>                    
                </div>
                <div class="rad_div">
                    <label for="location" class="rad_label">Location</label>
                    <input type="radio" id="location" name="type" value="location" required>                    
                </div>
            </div>
                
            <!-- Input Fields -->
            <div class="field_group">
                <div class="field">
                    <label for="hotel_city">Hotel City:</label>
                    <input type="text" id="hotel_city" name="hotel_city" required>
                </div>
            </div>

            <div class="field_group">
                <div class="field">
                    <label for="hotel_location">Enter Area/Location:</label>
                    <input type="text" id="hotel_location" name="hotel_location" required>
                </div>
            </div>

            <div class="field_group">
                <div class="field">
                    <label for="lat">Latitude:</label>
                    <input type="text" id="lat" name="lat">
                </div>
                <div class="field">
                    <label for="lon">Longitude:</label>
                    <input type="text" id="lon" name="lon">
                </div>
            </div>
        </section>

        <!-- Hotel Amenities -->
        <section>
            <span class="page_title">Hotel Amenities</span>
            <div class="field_group">
                <div class="field">
                    <label for="transportation">Transportation (comma separated values):</label>
                    <input type="text" id="transportation" name="amenities[transportation]" placeholder="Ex-: Paid Pickup/Drop , Shuttle Service Paid , Airport Transfers Paid , Bus Station Transfers">
                </div>
                <div class="field">
                    <label for="general">General (comma separated values):</label>
                    <input type="text" id="general" name="amenities[General]" placeholder="Ex-: Laundry , Service Smoke , Detector Room , Service Power Backup ,Intercom">
                </div>
                <div class="field">
                    <label for="food_drink">Food & Drink (comma separated values):</label>
                    <input type="text" id="food_drink" name="amenities[Food_Drink]" placeholder="Ex-: Dining Area , Restaurant Cafe , 24-hour , Coffee Shop">
                </div>
            </div>
        </section>

        <!-- Hotel Policies -->
        <section>
            <span class="page_title">Hotel Policies</span>
            <!-- Existing policy fields -->
            <div class="field_group">
                <!-- Existing fields -->
                <div class="field">
                    <label for="free_cancellation_until">Free Cancellation Until (hrs):</label>
                    <input type="number" id="free_cancellation_until" name="free_cancellation_until" min="1" required>
                </div>
                <div class="field">
                    <label for="refundable_days">Refundable Until (days):</label>
                    <input type="number" id="refundable_days" name="refundable_days" min="1" required>
                </div>
                <div class="field">
                    <label for="refundable_percent">Refundable Percentage (%):</label>
                    <input type="number" id="refundable_percent" name="refundable_percent" min="1" required>
                </div>
                <div class="field">
                    <label for="pay_at_hotel">Pay at Hotel:</label>
                    <select id="pay_at_hotel" name="pay_at_hotel" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="field">
                    <label for="payment">Payment Type:</label>
                    <input type="text" id="payment" name="payment">
                </div>
            </div>
            
        </section>


        <!-- Room Details -->
        <section>
            <span class="page_title">Room Details</span>
            <div id="room-details-container">
                <div class="room-details">
                    <h3>Room 1</h3>
                    <div class="field_group">
                        <!-- Room Fields -->
                        <div class="field">
                            <label>Room Name:</label>
                            <input type="text" name="room[0][room]" required>
                        </div>
                        <div class="field">
                            <label>Room Available:</label>
                            <select name="room[0][roomavailable]" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Total Rooms:</label>
                            <input type="number" name="room[0][totalroom]" min="1" required>
                        </div>
                        <div class="field">
                            <label>Room Bed:</label>
                            <input type="text" name="room[0][Room_Bed]" required>
                        </div>
                        <div class="field">
                            <label>Room Currency:</label>
                            <input type="text" name="room[0][roomcurrency]" required>
                        </div>
                        <div class="field">
                            <label>Room Actual Price:</label>
                            <input type="text" name="room[0][roomactualprice]" required>
                        </div>
                        <div class="field">
                            <label>Room Offer Price:</label>
                            <input type="text" name="room[0][roomofferprice]" required>
                        </div>
                        <div class="field">
                            <label>Room Tax:</label>
                            <input type="text" name="room[0][roomtax]" required>
                        </div>
                        <div class="field">
                            <label>Total Price:</label>
                            <input type="text" name="room[0][totalprice]" required>
                        </div>
                        <div class="field">
                            <label>Room Type:</label>
                            <input type="text" name="room[0][room_type]" required>
                        </div>
                    </div>
                    <div class="field_group">
                        <div class="field">
                            <label>Policies (comma separated values):</label>
                            <input type="text" name="room[0][policies]" placeholder="Ex-: Passport, Aadhar and Driving License are accepted as ID proof(s) ,  Pets are not allowed  Outside food is not allowed"  required>
                        </div>
                        <div class="field">
                            <label>Facilities (comma separated values):</label>
                            <input type="text" name="room[0][failities]" placeholder="Ex-: Housekeeping , Attached Bathroom , Telephone , Free Wi-Fi"  required>
                        </div>
                    </div>
                    <div class="field_group">
                        <div class="field">
                            <label>Extra Charge:</label>
                            <input type="text" name="room[0][Extar_charage]" required>
                        </div>
                        <div class="field">
                            <label>Children Charge:</label>
                            <input type="text" name="room[0][Childerh_chrage]" required>
                        </div>
                        <div class="field">
                            <label>Room Other Charge:</label>
                            <input type="text" name="room[0][room_other_charge]" required>
                        </div>
                        <div class="field">
                            <label>Room Discount:</label>
                            <input type="text" name="room[0][room_discount]" required>
                        </div>
                        <div class="field">
                            <label>Room Published Price:</label>
                            <input type="text" name="room[0][room_published_price]" required>
                        </div>
                        <div class="field">
                            <label>Room Offer Price Rounded Off:</label>
                            <input type="text" name="room[0][room_offer_price_rounded_off]" required>
                        </div>
                        <div class="field">
                            <label>Room Agent Commission:</label>
                            <input type="text" name="room[0][room_agentcomission]" required>
                        </div>
                        <div class="field">
                            <label>TDS:</label>
                            <input type="text" name="room[0][TDS]" required>
                        </div>
                        <div class="field">
                            <label>Room Dimension:</label>
                            <input type="text" name="room[0][room_dimention]" required>
                        </div>
                        <div class="field">
                            <label>Floors:</label>
                            <input type="text" name="room[0][Floors]" required>
                        </div>
                        <!-- Add other fields as necessary -->
                    </div>
                </div>
            </div>
            <button type="button" id="add-room-button">Add Another Room</button>
        </section>

        <!-- Hotel and Room Images -->
        <section>
            <span class="page_title">Hotel and Room Images</span>
            <div class="field_group">
                <div class="field">
                    <label for="hotel_images">Hotel Images:</label>
                    <input type="file" id="hotel_images" name="hotel_images[]" multiple accept="image/*" required>
                </div>
                <div class="field">
                    <label for="room_images">Room Images:</label>
                    <input type="file" id="room_images" name="room_images[]" multiple accept="image/*" required>
                </div>
            </div>
        </section>

        <button type="submit">Submit</button>
    </form>
</main>

@endsection

@push('js')

<script>
    // Event listener for when the cursor leaves the Hotel City input box
    document.getElementById('hotel_location').addEventListener('blur', function() {
        const areaOrLocation = document.querySelector('input[name="type"]:checked').value;
        const query = document.getElementById('hotel_location').value;
        const city = document.getElementById('hotel_city').value;
        const countryType = 'IN';

        if (query && city) {
            fetchSuggestions(query + ' ' + city,countryType, areaOrLocation);
        }
    });

    // Function to fetch latitude and longitude from HotelSpecial model via AJAX
    function fetchSuggestions(query, countryType, areaOrLocation) {

        const apiKey = '42ecab6d4ad64005a56cfd68f0258f7e';
        fetch(`https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(query)}&key=${apiKey}&countrycode=${countryType}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.results.length > 0) {
                    const location = data.results[0];  // Assume the first result is the most relevant
                    document.getElementById('lat').value = location.geometry.lat;
                    document.getElementById('lon').value = location.geometry.lng;
                    // console.log(`Latitude: ${location.geometry.lat}, Longitude: ${location.geometry.lng}`);
                } 
                else {
                    // If no results are found, clear the latitude and longitude fields
                    document.getElementById('lat').value = '';
                    document.getElementById('lon').value = '';
                    alert('Could not fetch latitude and longitude. Please input manually.');
                }
            })
            .catch(error => console.error('Error fetching locations from HotelSpecial model:', error));
    }

    // Disable form submission if latitude and longitude are empty
    document.getElementById('hotel-form').addEventListener('submit', function(event) {
        const lat = document.getElementById('lat').value;
        const lon = document.getElementById('lon').value;

        if (!lat || !lon) {
            event.preventDefault();
            alert('Please ensure that latitude and longitude are filled before submitting.');
        }
    });
</script>


<script>
    // JavaScript to dynamically add and remove room sections
    document.addEventListener('DOMContentLoaded', function() {
        const roomContainer = document.getElementById('room-details-container');
        let roomIndex = 1; // Start from 1 since 0 is used by the initial room

        // Add new room functionality
        document.getElementById('add-room-button').addEventListener('click', function() {
            addRoom();
        });

        function addRoom() {
            const newRoom = document.createElement('div');
            newRoom.classList.add('room-details');

            newRoom.innerHTML = `
                <h3>Room ${roomIndex + 1}</h3>
                <button type="button" class="remove-room-button">Remove Room</button>
                <div class="field_group">
                    <!-- Room Fields -->
                    <div class="field">
                        <label>Room Name:</label>
                        <input type="text" name="room[${roomIndex}][room]" required>
                    </div>
                    <div class="field">
                        <label>Room Available:</label>
                        <select name="room[${roomIndex}][roomavailable]" required>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <!-- Include all other room fields -->
                    <div class="field">
                        <label>Total Rooms:</label>
                        <input type="number" name="room[${roomIndex}][totalroom]" required>
                    </div>
                    <!-- Add all other fields, updating the name attributes with roomIndex -->
                    <div class="field">
                        <label>Room Bed:</label>
                        <input type="text" name="room[${roomIndex}][Room_Bed]" required>
                    </div>
                    <div class="field">
                        <label>Room Currency:</label>
                        <input type="text" name="room[${roomIndex}][roomcurrency]" required>
                    </div>
                    <div class="field">
                        <label>Room Actual Price:</label>
                        <input type="text" name="room[${roomIndex}][roomactualprice]" required>
                    </div>
                    <div class="field">
                        <label>Room Offer Price:</label>
                        <input type="text" name="room[${roomIndex}][roomofferprice]" required>
                    </div>
                    <div class="field">
                        <label>Room Tax:</label>
                        <input type="text" name="room[${roomIndex}][roomtax]" required>
                    </div>
                    <div class="field">
                        <label>Total Price:</label>
                        <input type="text" name="room[${roomIndex}][totalprice]" required>
                    </div>
                    <div class="field">
                        <label>Room Type:</label>
                        <input type="text" name="room[${roomIndex}][room_type]" required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label>Policies (comma separated values):</label>
                        <input type="text" name="room[${roomIndex}][policies]" placeholder="Ex-: Passport, Aadhar and Driving License are accepted as ID proof(s) ,  Pets are not allowed  Outside food is not allowed" required>
                    </div>
                    <div class="field">
                        <label>Facilities (comma separated values):</label>
                        <input type="text" name="room[${roomIndex}][failities]" placeholder="Ex-: Housekeeping , Attached Bathroom , Telephone , Free Wi-Fi" required>
                    </div>
                </div>
                <div class="field_group">
                    <div class="field">
                        <label>Extra Charge:</label>
                        <input type="text" name="room[${roomIndex}][Extar_charage]" required>
                    </div>
                    <div class="field">
                        <label>Children Charge:</label>
                        <input type="text" name="room[${roomIndex}][Childerh_chrage]" required>
                    </div>
                    <div class="field">
                        <label>Room Other Charge:</label>
                        <input type="text" name="room[${roomIndex}][room_other_charge]" required>
                    </div>
                    <div class="field">
                        <label>Room Discount:</label>
                        <input type="text" name="room[${roomIndex}][room_discount]" required>
                    </div>
                    <div class="field">
                        <label>Room Published Price:</label>
                        <input type="text" name="room[${roomIndex}][room_published_price]" required>
                    </div>
                    <div class="field">
                        <label>Room Offer Price Rounded Off:</label>
                        <input type="text" name="room[${roomIndex}][room_offer_price_rounded_off]" required>
                    </div>
                    <div class="field">
                        <label>Room Agent Commission:</label>
                        <input type="text" name="room[${roomIndex}][room_agentcomission]" required>
                    </div>
                    <div class="field">
                        <label>TDS:</label>
                        <input type="text" name="room[${roomIndex}][TDS]" required>
                    </div>
                    <div class="field">
                        <label>Room Dimension:</label>
                        <input type="text" name="room[${roomIndex}][room_dimention]" required>
                    </div>
                    <div class="field">
                        <label>Floors:</label>
                        <input type="text" name="room[${roomIndex}][Floors]" required>
                    </div>
                    <!-- Add other fields as necessary -->
                </div>
            `;
            roomContainer.appendChild(newRoom);

            // Attach event listener to the new remove button
            newRoom.querySelector('.remove-room-button').addEventListener('click', function() {
                removeRoom(this);
            });

            roomIndex++; // Increment the roomIndex for the next room
        }

        function removeRoom(button) {
            const roomDetails = button.closest('.room-details');
            roomDetails.remove();
            updateRoomHeadings();
        }

        function updateRoomHeadings() {
            const rooms = roomContainer.querySelectorAll('.room-details');
            rooms.forEach((room, index) => {
                room.querySelector('h3').textContent = `Room ${index + 1}`;
                // Update name attributes to reflect the correct indices
                const inputs = room.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/room\[\d+\]/, `room[${index}]`);
                    input.setAttribute('name', newName);
                });
            });
            roomIndex = rooms.length; // Update roomIndex
        }
    });

   

    
</script>
<script>
    document.querySelectorAll('#hotel_images, #room_images').forEach(function(input) {
     input.addEventListener('change', function() {
         const file = this.files[0];
         const maxSize = 1048576; // 1MB in bytes
         const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

         // Check file type
         if (!allowedTypes.includes(file.type)) {
             alert('Please select a valid image file (JPEG, PNG, GIF)');
             this.value = ''; // Clear the file input
             return false;
         }

         // Check file size
         if (file.size > maxSize) {
             alert('Maximum file size exceeded (1MB)');
             this.value = ''; // Clear the file input
             return false;
         }
         });
     });

</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(".flatpickr_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K", // "h:i K" for 12-hour format with AM/PM
            time_24hr: false // Set to false to use 12-hour format
        });
    });
</script>
@endpush
