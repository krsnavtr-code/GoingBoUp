@php
use App\Models\BusinessLogin;
$businessLoginId = session('businessId');

    // Fetch business login details from the database
    $businessLogin = BusinessLogin::find($businessLoginId);

    // Check if the business login details were retrieved successfully
    if (!$businessLogin) {
        // If not found, maybe redirect to login or show an error message
        return redirect('admin/business-login')->withErrors(['msg' => 'User not found.']);
    }
    $businessLogin = BusinessLogin::find($businessLoginId);
@endphp
@if (isset($businessLogin))
<header class="header">
    <h2>Hello, {{ $businessLogin->company_name }}</h2>
</header>
@endif
