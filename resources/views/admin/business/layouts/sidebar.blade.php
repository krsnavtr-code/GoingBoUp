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
<div class="sidebar">
    <a href="{{ url('') }}" class="brand">
        <img src="{{ url('/images/logo.png') }}" alt="">
    </a>
    <ul class="main_nav">
        <li class="group_head">
            <a href="{{ url('/admin/business-login/dashboard') }}" class="group_title">Dashboard</a>
        </li>

        @if ($businessLogin->business_type === 'cab')
            <li class="group_head"><a href="{{ url('admin/business-login/cab/view') }}">View Cabs</a></li>
            <li class="group_head"><a href="{{ url('admin/business-login/cab/add') }}">Add Cab</a></li>
            <li class="group_head"><a href="{{ url('admin/business-login/cab/route') }}">View Cab Routes</a></li>
        @elseif ($businessLogin->business_type === 'hotel')
            <li class="group_head"><a href="{{ url('admin/business-login/hotel/add') }}">Add Hotel</a></li>
            <li class="group_head"><a href="{{ route('hotel.edit') }}">Edit Hotel</a></li>
        @endif

        <!-- Common Links -->
        <li class="group_head"><a href="{{ url('admin/business-login/account-info') }}">Account Info</a></li>   
    </ul> 
    <ul>    
        <li class="logout"> <a href="{{ url('admin/business-login/logout') }}" > Logout </a> </li>                         
    </ul>
</div>
@endif
