@extends('user.components.layout')
@push('css')
<link rel="stylesheet" href="css/index.css">

<style>
    /* ====== SECTION STYLES ====== */
    .popular-hotels-section {
        background: #f9fafc;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
    }

    .modern-btn {
        background: linear-gradient(90deg, #007bff, #00b4d8);
        color: white;
        border: none;
        padding: 10px 22px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .modern-btn:hover {
        transform: scale(1.05);
        background: linear-gradient(90deg, #0062cc, #0096c7);
    }

    /* ====== HOTEL GRID ====== */
    .hotel-grid {
        display: grid;
        gap: 25px;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .hotel-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .hotel-card:hover {
        transform: translateY(-5px);
    }

    .hotel-img img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .hotel-info {
        padding: 15px;
        text-align: center;
    }

    .hotel-info h6 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
    }

    .hotel-info span {
        color: #007bff;
    }

    .search-btn {
        display: inline-block;
        margin-top: 10px;
        background: #007bff;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .search-btn:hover {
        background: #0056b3;
    }

    /* ====== MODAL ====== */
    .modern-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .modal-wrapper {
        display: flex;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        animation: scaleUp 0.3s ease;
    }

    @keyframes scaleUp {
        from {
            transform: scale(0.9);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .modal-content {
        flex: 1;
        padding: 30px;
    }

    .modal-image {
        flex: 1;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-image img {
        width: 90%;
        border-radius: 8px;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-btn {
        font-size: 24px;
        cursor: pointer;
        color: #64748b;
    }

    .close-btn:hover {
        color: #ef4444;
    }

    /* ====== FORM ====== */
    .modern-form .input-group {
        position: relative;
        margin-bottom: 18px;
    }

    .input-group i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
    }

    .input-group input {
        width: 100%;
        padding: 10px 12px 10px 38px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 0.95rem;
        transition: border-color 0.3s;
    }

    .input-group input:focus {
        border-color: #007bff;
        outline: none;
    }

    .password-group .toggle-password {
        position: absolute;
        right: 12px;
        cursor: pointer;
        color: #64748b;
    }

    .checkbox {
        font-size: 0.9rem;
        color: #475569;
        margin-bottom: 15px;
    }

    .checkbox a {
        color: #007bff;
    }

    .full {
        width: 100%;
    }

    .success-text {
        color: #16a34a;
        text-align: center;
        font-weight: 600;
    }
</style>
@endpush
@section('main')

<main class="popular-hotels-section">
    @include('user.components.forms.form')

    <section class="destinations container mt-5 mb-5">
        <div class="section-header">
            <h4 class="section-title">Popular Hotel Destinations</h4>
            <button id="registerCabBtn" class="modern-btn">Register Your Hotel</button>
        </div>


        @php
        use Carbon\Carbon;
        $today = Carbon::now()->format('Y-m-d');
        $returnDate = Carbon::now()->addDays(2)->format('Y-m-d');
        $cities = [
        [
        'name' => 'Delhi',
        'whereinput' => 'Crowne+Plaza+New+Delhi+Rohini%2C+an+IHG+Hotel',
        'image' => 'delhi.jpg'
        ],
        [
        'name' => 'Patna',
        'whereinput' => 'The+Grand+Empire+%7C+Best+4+Star+Luxury+Hotel+in+Patna',
        'image' => 'patna.jpeg'
        ],
        ['name' => 'Mumbai', 'whereinput' => 'Mumbai', 'image' => 'mumbai.jpg'],
        ['name' => 'Kolkata', 'whereinput' => 'Kolkata', 'image' => 'kolkata.webp'],
        ['name' => 'Chennai', 'whereinput' => 'Chennai', 'image' => 'chennai.jpg'],
        ['name' => 'Goa', 'whereinput' => 'Goa', 'image' => 'goa.png'],
        ['name' => 'Shimla', 'whereinput' => 'Shimla', 'image' => 'shimla.jfif'],
        ['name' => 'Bengaluru', 'whereinput' => 'Bangalore', 'image' => 'bangalore.jpg'],
        ];
        @endphp

        <div class="hotel-grid">
            @foreach($cities as $city)
            <div class="hotel-card">
                <div class="hotel-img">
                    <img loading="lazy" src="{{ asset('images/hotel/cities/' . $city['image']) }}" alt="Hotel in {{ $city['name'] }}">
                </div>
                <div class="hotel-info">
                    <h6>Hotels in <span>{{ $city['name'] }}</span></h6>
                    <a href="{{ url('/hotel/search_results?...') }}" class="search-btn">
                        Search Hotels in {{ $city['name'] }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Modern Modal -->
    <div id="registerCabModal" class="modern-modal">
        <div class="modal-wrapper">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>🏨 Hotel Business Registration</h5>
                    <span id="closeModal" class="close-btn">&times;</span>
                </div>

                <form id="businessForm" class="modern-form">
                    @csrf
                    <input type="hidden" name="business_type" value="hotel">

                    <div class="input-group">
                        <i class="fas fa-building"></i>
                        <input type="text" name="companyName" placeholder="Company Name" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="contactNo" placeholder="Contact No (10 digits)" pattern="\d{10}" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-city"></i>
                        <input type="text" name="city" placeholder="City" required>
                    </div>
                    <div class="input-group password-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password" minlength="8" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>

                    <label class="checkbox">
                        <input type="checkbox" required> I agree to the
                        <a href="#">Terms and Conditions</a>
                    </label>

                    <button type="submit" class="modern-btn full">Register Now</button>
                </form>

                <div id="otpForm" class="hidden">
                    <p>An OTP has been sent to your email. Please enter it below:</p>
                    <div class="input-group">
                        <i class="fas fa-key"></i>
                        <input type="text" id="otpInput" placeholder="Enter OTP" maxlength="6" required>
                    </div>
                    <button class="modern-btn full" id="verifyOtpBtn">Verify OTP</button>
                </div>

                <div id="successMessage" class="hidden">
                    <p class="success-text">✅ Registration successful! Please check your email for login details.</p>
                </div>
            </div>

            <div class="modal-image">
                <img src="{{ asset('images/web-assets/hotel_modal.png') }}" alt="Hotel Registration">
            </div>
        </div>
    </div>
</main>


@endsection

@push('js')

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
    $(document).ready(function() {
        // Handle form submission
        $('#businessForm').on('submit', function(event) {
            event.preventDefault();
            // Send AJAX request to send OTP
            $.ajax({
                url: "{{ url('admin/business-login/send-otp') }}",
                method: "POST",
                data: $('#businessForm').serialize(),
                success: function(response) {
                    if (response.status == 'otp_sent') {
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
                    if (response.status == 'otp_verified') {
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
@endpush