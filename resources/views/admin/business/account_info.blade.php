@extends('admin.business.layouts.app')

@push('css')

@endpush
@section('content')
    <main>
        <div class="account-info">
            <h1>Account Information</h1>
            <p><strong>Company Name:</strong> {{ $businessLogin->company_name }}</p>
            <p><strong>Contact No:</strong> {{ $businessLogin->contact_no }}</p>
            <p><strong>Email:</strong> {{ $businessLogin->email }}</p>
            <p><strong>City:</strong> {{ $businessLogin->city }}</p>
            <p><strong>Username:</strong> {{ $businessLogin->username }}</p>
            <p><strong>Business Type:</strong> {{ $businessLogin->business_type }}</p>
        </div>
    </main>
@endsection
