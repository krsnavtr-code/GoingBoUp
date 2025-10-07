@extends('user.components.layout')

@push('css')
<link rel="stylesheet" href="css/index.css">
<style>
    .search-summary {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .bus-card {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .bus-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .bus-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .bus-operator {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }
    
    .bus-type {
        color: #6c757d;
        font-size: 14px;
    }
    
    .bus-body {
        padding: 20px;
    }
    
    .timing {
        text-align: center;
    }
    
    .departure-time {
        font-size: 20px;
        font-weight: 600;
        color: #212529;
    }
    
    .duration {
        font-size: 14px;
        color: #6c757d;
        margin: 5px 0;
    }
    
    .arrival-time {
        font-size: 16px;
        color: #495057;
    }
    
    .amenities {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    
    .amenity {
        background: #e9ecef;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 12px;
        color: #495057;
    }
    
    .fare {
        text-align: right;
    }
    
    .price {
        font-size: 24px;
        font-weight: 600;
        color: #28a745;
        margin: 0;
    }
    
    .price-label {
        font-size: 12px;
        color: #6c757d;
    }
    
    .view-seats-btn {
        margin-top: 15px;
        width: 100%;
    }
    
    .filter-section {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .filter-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .form-check-label {
        cursor: pointer;
    }
    
    .no-buses {
        text-align: center;
        padding: 50px 0;
    }
    
    .no-buses i {
        font-size: 50px;
        color: #6c757d;
        margin-bottom: 20px;
    }
    
    .boarding-points, .dropping-points {
        margin-top: 15px;
    }
    
    .point {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        border-bottom: 1px dashed #e9ecef;
    }
    
    .point:last-child {
        border-bottom: none;
    }
    
    .point-name {
        font-weight: 500;
    }
    
    .point-time {
        color: #6c757d;
    }
</style>
@endpush

@section('main')
    <div class="container py-4">
        <div class="search-summary">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-2">
                        {{ $searchParams['from'] }} to {{ $searchParams['to'] }}
                        <small class="text-muted">| {{ \Carbon\Carbon::parse($searchParams['date'])->format('D, d M Y') }}</small>
                    </h4>
                    <p class="mb-0 text-muted">{{ $totalBuses }} buses found</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ url('bus') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i> Modify Search
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-3">
                <div class="filter-section">
                    <h5 class="filter-title">Filter by Bus Type</h5>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="AC" id="filterAc" checked>
                        <label class="form-check-label" for="filterAc">
                            AC Buses
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="Non-AC" id="filterNonAc" checked>
                        <label class="form-check-label" for="filterNonAc">
                            Non-AC Buses
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="Sleeper" id="filterSleeper" checked>
                        <label class="form-check-label" for="filterSleeper">
                            Sleeper
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="Seater" id="filterSeater" checked>
                        <label class="form-check-label" for="filterSeater">
                            Seater
                        </label>
                    </div>
                </div>
                
                <div class="filter-section">
                    <h5 class="filter-title">Departure Time</h5>
                    <div class="form-check mb-2">
                        <input class="form-check-input time-filter" type="checkbox" value="morning" id="timeMorning">
                        <label class="form-check-label" for="timeMorning">
                            12 AM - 8 AM
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input time-filter" type="checkbox" value="day" id="timeDay">
                        <label class="form-check-label" for="timeDay">
                            8 AM - 4 PM
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input time-filter" type="checkbox" value="evening" id="timeEvening">
                        <label class="form-check-label" for="timeEvening">
                            4 PM - 12 AM
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                @if(count($buses) > 0)
                    @foreach($buses as $bus)
                        <div class="bus-card" data-type="{{ strtolower($bus['type']) }}" data-time="{{ date('H', strtotime($bus['departure_time'])) >= 0 && date('H', strtotime($bus['departure_time'])) < 8 ? 'morning' : (date('H', strtotime($bus['departure_time'])) < 16 ? 'day' : 'evening') }}">
                            <div class="bus-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="bus-operator">{{ $bus['operator'] }}</h5>
                                        <p class="bus-type mb-0">{{ $bus['type'] }} • {{ $bus['rating'] }} <i class="fas fa-star text-warning"></i></p>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-secondary view-details" data-bus-id="{{ $bus['id'] }}">
                                            View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="bus-body">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="timing">
                                            <div class="departure-time">{{ $bus['departure_time'] }}</div>
                                            <div class="duration">{{ $bus['duration'] }}</div>
                                            <div class="arrival-time">Arrives at {{ $bus['arrival_time'] }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="boarding-points">
                                            <p class="mb-2"><strong>Boarding Points</strong></p>
                                            @foreach($bus['boarding_points'] as $point)
                                                <div class="point">
                                                    <span class="point-name">{{ $point['name'] }}</span>
                                                    <span class="point-time">{{ $point['time'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="dropping-points">
                                            <p class="mb-2 mt-3"><strong>Dropping Points</strong></p>
                                            @foreach($bus['dropping_points'] as $point)
                                                <div class="point">
                                                    <span class="point-name">{{ $point['name'] }}</span>
                                                    <span class="point-time">{{ $point['time'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="amenities">
                                            @foreach($bus['amenities'] as $amenity)
                                                <span class="amenity">{{ $amenity }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="fare">
                                            <p class="price">₹{{ $bus['fare'] }}</p>
                                            <p class="price-label">per seat</p>
                                            <p class="text-success">{{ $bus['available_seats'] }} seats left</p>
                                            <a href="#" class="btn btn-primary view-seats-btn">View Seats</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="no-buses">
                        <i class="fas fa-bus"></i>
                        <h4>No buses found</h4>
                        <p class="text-muted">We couldn't find any buses matching your search criteria.</p>
                        <a href="{{ url('bus') }}" class="btn btn-primary mt-3">Modify Search</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Bus Details Modal -->
    <div class="modal fade" id="busDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bus Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Bus details will be loaded here via JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-primary" id="viewSeatsBtn">View Seats</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter buses based on selected filters
        function filterBuses() {
            const selectedTypes = [];
            document.querySelectorAll('.filter-checkbox:checked').forEach(checkbox => {
                selectedTypes.push(checkbox.value.toLowerCase());
            });
            
            const selectedTimes = [];
            document.querySelectorAll('.time-filter:checked').forEach(checkbox => {
                selectedTimes.push(checkbox.value);
            });
            
            document.querySelectorAll('.bus-card').forEach(card => {
                const busType = card.getAttribute('data-type');
                const busTime = card.getAttribute('data-time');
                
                const typeMatch = selectedTypes.length === 0 || selectedTypes.some(type => busType.includes(type));
                const timeMatch = selectedTimes.length === 0 || selectedTimes.includes(busTime);
                
                if (typeMatch && timeMatch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show no results message if no buses match filters
            const visibleBuses = document.querySelectorAll('.bus-card[style="display: block;"]').length;
            if (visibleBuses === 0) {
                document.querySelector('.no-buses').style.display = 'block';
            } else {
                document.querySelector('.no-buses').style.display = 'none';
            }
        }
        
        // Add event listeners to filter checkboxes
        document.querySelectorAll('.filter-checkbox, .time-filter').forEach(checkbox => {
            checkbox.addEventListener('change', filterBuses);
        });
        
        // Bus details modal
        const busDetailsModal = new bootstrap.Modal(document.getElementById('busDetailsModal'));
        
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const busId = this.getAttribute('data-bus-id');
                // In a real app, you would fetch the bus details via AJAX
                // For now, we'll just show a simple message
                document.querySelector('#busDetailsModal .modal-body').innerHTML = `
                    <h5>Bus Details</h5>
                    <p>Loading bus details for ${busId}...</p>
                    <p>In a real application, this would show detailed information about the bus, 
                    including amenities, cancellation policy, boarding points, etc.</p>
                `;
                document.getElementById('viewSeatsBtn').href = `#${busId}`; // Set the correct URL for viewing seats
                busDetailsModal.show();
            });
        });
        
        // Initialize filters
        filterBuses();
    });
</script>
@endpush
