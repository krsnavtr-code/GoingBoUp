@extends('user.components.layout')


@push('css')
<style>
    .bus-search-container {
        padding: 80px 20px;
        color: black;
        position: relative;
    }

    .search-box {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        margin-top: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        height: 50px;
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 10px 15px;
        font-size: 16px;
        width: 100%;
    }

    .btn-search {
        background: #ff6b35;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 5px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-search:hover {
        background: #e65a2b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .swap-btn {
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin: 0 auto;
        transform: translateY(-50%);
        z-index: 10;
        position: relative;
    }

    .swap-btn:hover {
        background: #e9ecef;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    .featured-routes {
        padding: 60px 0;
    }

    .route-card {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .route-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('main')
    <div class="bus-search-container">
        <div class="container">
            <h1 class="text-center mb-4">Book Bus Tickets Online</h1>
            <p class="text-center mb-5">Find the best deals on bus tickets for your next trip</p>
            
            <div class="search-box">
                <form action="{{ route('bus.search') }}" method="GET" id="busSearchForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">From</label>
                                <select name="from" class="form-control" required>
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['code'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-2 d-flex align-items-center justify-content-center">
                            <button type="button" class="swap-btn" id="swapCities">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">To</label>
                                <select name="to" class="form-control" required>
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['code'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Date of Journey</label>
                                <input type="date" name="date" class="form-control" min="{{ $today }}" value="{{ $today }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Return Date (Optional)</label>
                                <input type="date" name="return_date" class="form-control" min="{{ $tomorrow }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn-search">
                            <i class="fas fa-search me-2"></i> Search Buses
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container featured-routes">
        <h2 class="text-center mb-5">Popular Bus Routes</h2>
        <div class="row">
            @php
                $popularRoutes = [
                    ['from' => 'Delhi', 'to' => 'Jaipur', 'from_code' => 'DEL', 'to_code' => 'JAI'],
                    ['from' => 'Mumbai', 'to' => 'Pune', 'from_code' => 'BOM', 'to_code' => 'PNQ'],
                    ['from' => 'Bangalore', 'to' => 'Chennai', 'from_code' => 'BLR', 'to_code' => 'MAA'],
                    ['from' => 'Hyderabad', 'to' => 'Vijayawada', 'from_code' => 'HYD', 'to_code' => 'VGA']
                ];
            @endphp
            
            @foreach($popularRoutes as $route)
                <div class="col-md-3 col-sm-6">
                    <div class="route-card">
                        <h5>{{ $route['from'] }} to {{ $route['to'] }}</h5>
                        <p class="text-muted mb-3">Starting from ₹{{ rand(500, 2000) }}</p>
                        <a href="{{ url('bus?from=' . $route['from_code'] . '&to=' . $route['to_code'] . '&date=' . $today) }}" 
                           class="btn btn-outline-primary btn-sm">
                            View Buses
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Swap cities
        document.getElementById('swapCities').addEventListener('click', function() {
            const fromSelect = document.querySelector('select[name="from"]');
            const toSelect = document.querySelector('select[name="to"]');
            const tempValue = fromSelect.value;
            
            fromSelect.value = toSelect.value;
            toSelect.value = tempValue;
            
            // Trigger change event if needed
            const event = new Event('change');
            fromSelect.dispatchEvent(event);
            toSelect.dispatchEvent(event);
        });

        // Set minimum return date based on departure date
        const departureDate = document.querySelector('input[name="date"]');
        const returnDate = document.querySelector('input[name="return_date"]');
        
        departureDate.addEventListener('change', function() {
            returnDate.min = this.value;
            if (returnDate.value && new Date(returnDate.value) < new Date(this.value)) {
                returnDate.value = this.value;
            }
        });
    });
</script>
@endpush
