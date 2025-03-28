@extends('user.components.layout')
@push('css')
<style>
    .my-row,
    .flex {
        flex: 1;
        display: flex;
        gap: 1rem;
    }

    form {
        width: 90%;
        margin: 2rem auto;
        padding: 3rem 2rem;
        background: white;
        box-shadow: 0 0 10px 0 #00000033;
        position: relative;
        border-radius: 8px;
    }

    form h5 {
        margin: 0 0 2rem;
        text-transform: capitalize;
    }

    .vu-select {
        width: 100%;
        position: relative;
    }

    .vu-suggestion {
        position: absolute;
        top: calc(100% + 10px);
        box-shadow: 0 0 10px 0 #00000033;
        padding: 10px;
        background: white;
        width: 100%;
        border-radius: 6px;
        z-index: 10;
    }

    .vu-select:not(.active) .vu-suggestion {
        display: none;
    }

    .field {
        display: flex;
        flex-direction: column;
        border: 1px solid var(--gray_600);
        position: relative;
        border-radius: 3px;
        flex: 1;
    }

    .field label {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--fv_prime);
        padding: 0 10px;
        background: white;
        position: absolute;
        top: 0;
        left: 20px;
        transform: translatey(-50%);
    }

    .field input {
        width: 100%;
        padding: 10px;
        border: none;
        background: none;
    }

    .date input{
        cursor: pointer;
    }


    form button {
        padding: 10px 30px;
        border-radius: 5px;
        font-size: 1.5rem;
        border: none;
        background: var(--fv_prime);
        color: white;
        font-weight: 600;
        /* position: absolute;
            bottom: 0;
            right: 0;
            transform: translate(-50%, 50%); */
    }

    .vu-option {
        font-weight: 600;
        padding: 8px 10px;
        border-radius: 5px;
        font-size: 1.25rem;
    }

    .vu-option:hover {
        background: rgba(var(--fv_prime_rgb), 0.4);
    }

    #registerCabBtn{       
        padding: 12px 30px;           
        border: none;
        font-size: 1.4rem;
        font-weight: 600;
        border-radius: 4px;
        background-color: var(--fv_prime);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }
    .modal-content {
        background-color: #fff;
        margin: 80px auto;
        padding: 10px;
        border: 1px solid #888;
        width: 60%;
        border-radius: 10px;
        display: flex;
        flex-direction: row;
    }
    .modal-content .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: none;
    }
    .modal-content .modal-body {
        flex: 1;
        padding: 2rem;
    }
    .modal-content .modal-footer {
        border-top: none;
    }
    .car-image {
        max-width: 100%;
    }
    .modal-content .custom-modal {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-content .custom-modal-content {
        flex: 1;
    }
    .modal-content .custom-modal-image {
        flex: 0 0 45%;
        padding: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .modal-content .close {
        cursor: pointer;
        font-size: 2.5rem;
        color: var(--fv_sec);
    }
    .modal-content .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    .modal-content  .form-group input {
        width: 90%;
        padding: 0.5rem 0.5rem 0.5rem 2.5rem;
        box-sizing: border-box;
        border: none;
        border-bottom: 1px solid #ccc;
        transition: border-color 0.3s;
    }
    .modal-content .form-group input:focus {
        border-color: var(--fv_sec);
        outline: none;
    }
    .modal-content .form-group .icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: var(--fv_sec);
        font-size: 1.2rem;
    }
    .modal-content .form-group .toggle-password {
        position: absolute;
        top: 50%;
        right: 0.5rem;
        transform: translateY(-50%);
        color: var(--fv_sec);
        cursor: pointer;
    }
    .modal-content .btn {
        padding: 0.75rem 1.5rem;
        color: #fff;
        background-color: var(--fv_sec);
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.1rem;
    }
    .modal-content .terms-link {
        color: var(--fv_sec);
        cursor: pointer;
        text-decoration: underline;
        margin-top: 1rem;
    }
    .modal-content .terms-checkbox {
        display: flex;
        align-items: center;
        margin: 1rem;
    }
    .modal-content .terms-checkbox input {
        margin-right: 0.5rem;
    }
    .modal-content .terms-checkbox i {
        color: var(--fv_sec);
        margin-right: 0.5rem;
    }

    #otpForm, #successMessage {
        text-align: center;
        margin-top: 20px;
    }

    #otpForm .form-group, #successMessage p {
        margin-bottom: 15px;
        font-size: 16px;
    }

    #successMessage p {
        color: green;
    }

    #otpInput {
        width: 50%;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    @media only screen and (max-width:768px) {

        form {
            padding: 2rem 1rem;
        }

        input {
            flex: 1;
        }

        .my-row {
            flex-direction: column;
        }
    }




</style>
@endpush
@section('main')

<main>

    <div style="position: absolute; right: 20px; top: 80px;">
        <button id="registerCabBtn">Register Your Cabs </button>            
    </div>

    <!-- The Modal -->
    <div id="registerCabModal" class="modal">
        <div class="modal-content">
            <div class="custom-modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Cab Buisness Registration </h5>
                    
                </div>
                <div class="modal-body">
                        <!-- Step 1: Registration Form -->
                        <form id="businessForm">
                        @csrf
                        <input type="hidden" name="business_type" value="cab">
                        <div class="form-group">
                            <input type="text" id="companyName" name="companyName" placeholder="Enter Company Name" maxlength="50" required>
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
                        <div class="form-group">
                            <input type="password" id="password" name="password" placeholder="Enter Password" minlength="8" maxlength="16" required>
                            <i class="fas fa-lock icon"></i>
                            <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        </div>
                        <div class="terms-checkbox">
                            <i class="fas fa-check-circle"></i>
                            <label for="terms"> I agree above <a class="terms-link" href="#"> Terms And Conditions </a> </label> 
                        </div>
                        <button type="submit" class="btn"> Register Now </button>
                    </form>
                    <!-- Step 2: OTP Verification Form -->
                    <div id="otpForm" style="display: none;">
                        <p>An OTP has been sent to your email. Please enter it below:</p>
                        <div class="form-group">
                            <input type="text" id="otpInput" placeholder="Enter OTP" maxlength="6" required>
                            <i class="fas fa-key icon"></i>
                        </div>
                        <button type="button" class="btn" id="verifyOtpBtn">Verify OTP</button>
                    </div>

                    <!-- Success Message -->
                    <div id="successMessage" style="display: none;">
                        <p>Your form has been successfully submitted. Please check your email for login details.</p>
                    </div>
                </div>
            </div>
            <div class="custom-modal-image">
                <img src="{{ asset('images/web assets/taxi_car_modal.jpg') }}" alt="Yellow Car" class="car-image" style="border-radius: 6px; ">
            </div>
            <span class="close" id="closeModal">&times;</span>
        </div>
    </div>

    <div class="navigation" style="font-weight:600;padding:20px 0 10px 20px;">
        <a href="{{ url('cab') }}"> Cabs</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span style="color: var(--fv_prime)">{{ $type }}</span>
    </div>
    
    <div class="fields rflex c"  style="  justify-content: center; height: 110px; margin-top: 40px; gap: 80px;" >

        <div style="position: relative; width: 90px;">  
            <a href="{{url("cab/One-Way")}}"> 
            <img src="{{ url('/images/cab assets/index-icons/arrow-alt-right.png') }} " class = "1img" style="height: 3rem; width: 3rem; position: absolute; top: -20px; left: 27px; @if (Request::is('cab/One-Way') || Request::is('cab'))
            border-radius: 4.5px; background-color: var(--fv_prime);
            @endif">
            <img src="{{ url('/images/web assets/icon-4.png') }} "  style="height: 4rem; width: 10rem; position: absolute;  top:12px ">
            <span style=" position: absolute; top: 72px; left: 4px; width: 100px;">One Way</span>
            </a>
        </div>
    
        <div style="position: relative; width: 90px;">  
            <a href="{{url("cab/Airport-Transfer")}}">
            <img src="{{ url('/images/cab assets/index-icons/plane-alt.png') }} "  style="height: 3rem; width: 3rem; position: absolute; top: -19px; left: 28px; @if (Request::is('cab/Airport-Transfer')) 
            border-radius: 4.5px; background-color: var(--fv_prime);
            @endif">
            <img src="{{ url('/images/web assets/icon-4.png') }} "  style="height: 4rem; width: 10rem; position: absolute;  top:12px ">
            <span style=" position: absolute; top: 72px; left: 4px; width: 100px;">Airport Cabs</span>
            </a>
        </div>

        <div style="position: relative; width: 90px;">
            <a href="{{url("cab/Round-Trip")}}">
            <img src="{{ url('/images/cab assets/index-icons/exchange-alt.png') }} " style="height: 2.6rem; width: 2.6rem; position: absolute; top: -19px; left: 25px;  @if (Request::is('cab/Round-Trip')) 
            border-radius: 4.5px; background-color: var(--fv_prime);
            @endif">
            <img src="{{ url('/images/web assets/icon-4.png') }} "  style="height: 4rem; width: 10rem; position: absolute;  top:12px ">
            <span style=" position: absolute; top: 72px; left: 4px; width: 100px;">Round Trip</span>
            </a>
        </div>
        
        <div style="position: relative; width: 90px;">  
            <a href="{{url("cab/Daily-Rental")}}">
            <img src="{{ url('/images/cab assets/index-icons/person-simple.png') }} "  style="height: 3rem; width: 3rem; position: absolute; top: -19px; left: 28px; @if (Request::is('cab/Daily-Rental')) 
            border-radius: 4.5px; background-color: var(--fv_prime);
            @endif">
            <img src="{{ url('/images/web assets/icon-4.png') }} "  style="height: 4rem; width: 10rem; position: absolute;  top:12px ">
            <span style=" position: absolute; top: 72px; left: 4px; width: 100px;">Daily Rental</span>
            </a>
        </div>
       
        
        
    </div>
    
    <form action="{{ url('/cab/'. $type.'/search') }}" method="get" class="cflex">
        <div class="hidden" style="display: none">
            @csrf
        </div>
        <h5>Book your ride instantly</h5>
        <div class="my-row">
            <div class="flex">
                @if($type !== 'Daily-Rental' )
                <div class="vu-select">
                    <div class="field vu-content">
                        <label for="">Going From</label>
                        <input type="text" name="going_from_city" placeholder="Search City" class="vu-input" required autofocus>
                        <input type="hidden" name="going_from" class="city_id">
                    </div>
                    <div class="vu-suggestion cflex"></div>
                </div>                
                <div class="vu-select">
                    <div class="field vu-content">

                        <label for="">Going To</label>
                        <input type="text" name="going_to_city" placeholder="Search City" class="vu-input" required>
                        <input type="hidden" name="going_to" class="city_id">
                    </div>
                    <div class="vu-suggestion cflex"></div>
                </div>
                @elseif($type == 'Daily-Rental')
                <div class="vu-select">
                    <div class="field vu-content">
                        <label for="">Pickup Location </label>
                        <input type="text" name="going_from_city" placeholder="Search City" class="vu-input" required autofocus>
                        <input type="hidden" name="going_from" class="city_id">
                    </div>
                    <div class="vu-suggestion cflex"></div>
                </div>
                <div class="vu-select">
                    <div class="field vu-content">
                        <label for=""> Duration </label>
                        <select name="duration"   class="vu-input" style="width: 100%; padding: 10px;   border: none; background: none;">
                        <div class="vu-suggestion cflex">                            
                            <option value="1hr-10kms">1 hr 10 kms</option>
                            <option value="2hrs-20kms">2 hrs 20 kms</option>
                            <option value="3hrs-30kms">3 hrs 30 kms</option>
                            <option value="4hrs-40kms">4 hrs 40 kms</option>
                            <option value="5hrs-50kms">5 hrs 50 kms</option>
                            <option value="6hrs-60kms">6 hrs 60 kms</option>
                            <option value="7hrs-70kms">7 hrs 70 kms</option>
                            <option value="8hrs-80kms">8 hrs 80 kms</option>
                            <option value="9hrs-90kms">9 hrs 90 kms</option>
                            <option value="10hrs-100kms">10 hrs 100 kms</option>
                        </div>
                        </select>
                    </div>
                </div>
                @endif
            </div>
           
            <div class="flex">
                <div class="field date">
                    <label for="c_date">Pickup Date</label>
                    <input type="date" name="c_date" id="c_date" placeholder="DD/MM/YY" required>
                </div>
                <div class="field ">
                    <label for="c_time">Pickup Time</label>
                    <input type="text" class="timepicker" name="c_time" autocomplete="off" required>
                </div>
            </div>
            @if($type !== 'Round-Trip')
            <button type="submit">Search Cab</button>
            @endif
        </div>


        @if($type == 'Round-Trip')
        <h5 style="margin-top: 20px;">Return Journey Details</h5>
        <div class="my-row">
            <div class="flex">
                <div class="field date">
                    <label for="c_date">Return Date</label>
                    <input type="date" name="r_date" id="c_date" placeholder="DD/MM/YY" required>
                </div>
                <div class="field">
                    <label for="r_time">Return Time</label>
                    <input type="text" class="timepicker" name="r_time" required>
                </div>
            </div>
            <button type="submit">Search Cab</button>
        </div>
        @endif
    </form>
</main>
@endsection

@push('js')

<script src="{{ url('js/vu-select.js') }}"> </script>
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
    const toSelect = new vu_select($(".vu-select")[1], {
        optionGenerator,
        fetchOptions
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            minTime: '05',
            maxTime: '11:45pm',
            defaultTime: 'now',
            startTime: '05:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>


<script>
    // Get modal element
    var modal = document.getElementById('registerCabModal');
    // Get open modal button
    var modalBtn = document.getElementById('registerCabBtn');
    // Get close button
    var closeBtn = document.getElementById('closeModal');
    // Get toggle password button
    var togglePassword = document.getElementById('togglePassword');
    // Get password input
    var passwordInput = document.getElementById('password');

    // Listen for open click
    modalBtn.addEventListener('click', openModal);
    // Listen for close click
    closeBtn.addEventListener('click', closeModal);
    // Listen for outside click
    window.addEventListener('click', outsideClick);
    // Listen for toggle password click
    togglePassword.addEventListener('click', togglePasswordVisibility);

    // Function to open modal
    function openModal() {
        modal.style.display = 'block';
    }

    // Function to close modal
    function closeModal() {
        modal.style.display = 'none';
    }

    // Function to close modal if outside click
    function outsideClick(e) {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Function to toggle password visibility
    function togglePasswordVisibility() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        }
    }
</script>
<script>
    $(document).ready(function(){
        // Handle form submission
        $('#businessForm').on('submit', function(event) {
            event.preventDefault();
            // Send AJAX request to send OTP
            $.ajax({
                url: "{{ url('admin/business-login/send-otp') }}",
                method: "POST",
                data: $('#businessForm').serialize(),
                success: function(response) {
                    if(response.status == 'otp_sent') {
                        // Show OTP input form
                        $('#businessForm').hide();
                        $('#otpForm').show();
                    }
                }
            });
        });

        // Handle OTP verification
        $('#verifyOtpBtn').on('click', function() {
            const otp = $('#otpInput').val();
            $.ajax({
                url: "{{ url('admin/business-login/verify-otp') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    otp: otp
                },
                success: function(response) {
                    if(response.status == 'otp_verified') {
                        // Submit the main form data to web_store after OTP is verified
                        $.ajax({
                            url: "{{ url('admin/business-login/register') }}",
                            method: "POST",
                            data: $('#businessForm').serialize(),
                            success: function() {
                                $('#otpForm').hide();
                                $('#successMessage').show();
                            }
                        });
                    }
                }
            });
        });
    });
</script>


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

    // Select all input elements with type="date" and initialize Flatpickr on each
    document.querySelectorAll('input[type="date"]').forEach(function(input) {
        flatpickr(input, config);
    });

 
</script>

@endpush