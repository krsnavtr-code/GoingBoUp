<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\BaseControllers\HotelBase;
use Illuminate\Http\Request;
use App\Models\HotelSpecial;
use App\Models\BusinessLogin;
use Carbon\Carbon;


class HotelController extends HotelBase
{
    private const HOTEl_IMG = parent::IMG_PATH . "special-hotels/hotel_images/";
    private const ROOM_IMG = parent::IMG_PATH . "special-hotels/room_images/";

    public function business_create_hotels()
    {
        return view('admin.business.hotel.add_hotel');
    }

    public function business_store_hotels(Request $request)
    {
        $businessLoginId = session('businessId');

        $company = BusinessLogin::find($businessLoginId);
        $companyName = $company ? $company->company_name : 'UnknownCompany';
    
        // Validate the form data
        $request->validate([
            'hotel_name' => 'required|string|max:255',
            'hotel_address' => 'required|string|max:255',
            'hotel_city' => 'required|string|max:255',
            'hotel_description' => 'required|string',
            'hotel_rating' => 'required|numeric|min:1|max:5',
            'phone_number' => 'required|string|max:10',
            'fax_number' => 'nullable|string|max:10',
            'country_name' => 'required|string|max:255',
            'check_in_time' => 'required|string',
            'check_out_time' => 'required|string',
            'hotel_opened' => 'required|string|max:255',
            'hotel_number_of_rooms' => 'required|string|max:255',
            'hotel_renovated' => 'nullable|string|max:255',

            'hotel_overview' => 'required|string',
            'payment' => 'nullable|string|max:255',
            'travel_insurance' => 'nullable|string|max:255',
            'hotel_services' => 'required|string',
            'hotel_reviews' => 'required|integer|min:0',

            'children_policies' => 'nullable|string|max:255',
            'dining_time' => 'nullable|string|max:255',
            'dining_price' => 'nullable|string|max:255',
            'type_of_dinner' => 'nullable|string|max:255',

            'meal_type' => 'required|string',
            'is_refundable' => 'required|boolean',
            'lat' => 'nullable|numeric',
            'lon' => 'nullable|numeric',

            'room' => 'required|array',
            'room.*.room' => 'required|string',
            'room.*.roomavailable' => 'required|string',
            'amenities' => 'nullable|array',
            'free_cancellation_until' => 'required|integer',
            'refundable_days' => 'required|integer',
            'refundable_percent' => 'required|integer',
            'pay_at_hotel' => 'required|string',
        ]);


        // Handle hotel images upload
        $hotelImages = [];
        if ($request->hasFile('hotel_images')) {
            foreach ($request->file('hotel_images') as $image) {
                $filenameData  = self::move_file($image, self::HOTEl_IMG);
                $hotelImages[] = ['type' => $filenameData['filename']];
            }
        }

        // Handle room images upload
        $roomImages = [];
        if ($request->hasFile('room_images')) {
            foreach ($request->file('room_images') as $image) {
                $filenameData  = self::move_file($image, self::ROOM_IMG);
                $roomImages[] = ['type' => $filenameData['filename']];
            }
        }

        // Construct JSON fields
        $hotelDescription = [
            'hotel_description' => $request->input('hotel_description'),
            'hotel_opened' => $request->input('hotel_opened'),
            'hotel_number0froom' => $request->input('hotel_number_of_rooms'),
            'hotel_renovated' => $request->input('hotel_renovated'),
        ];

        $hotelOverview = [
            'overview' => $request->input('hotel_overview'),
            'payment' => $request->input('payment'),
            'travel_insurance' => $request->input('travel_insurance'),
            'hotel_opened' => $request->input('hotel_opened'),
            'hotel_number0froom' => $request->input('hotel_number_of_rooms'),
            'hotel_renovated' => $request->input('hotel_renovated'),
        ];

        $hotelPolicies = [
            'checkintime' => $request->input('check_in_time'),
            'checkouttime' => $request->input('check_out_time'),
            'childrenpolicies' => $request->input('children_policies'),
            'diningtime' => $request->input('dining_time'),
            'diningprice' => $request->input('dining_price'),
            'typeofdinner' => $request->input('type_of_dinner'),
            'payment_mode' => $request->input('payment'),
            'pay_at_hotel' => $request->input('pay_at_hotel'),
            'cancellation' => [
                'free_cancellation_until' => $request->input('free_cancellation_until'),
                'refundable_days' => $request->input('refundable_days'),
                'refundable_percent' => $request->input('refundable_percent'),
            ],
        ];

        $hotelServices = [
            "type" => $request->input('hotel_services'),
        ];

        $roomsInput = $request->input('room');
        $hotelRoomData = [];

        foreach ($roomsInput as $roomInput) {
            $policiesArray = explode(',', $roomInput['policies']);
            $policiesData = [];
            foreach ($policiesArray as $policy) {
                $policiesData[] = ['poilices' => trim($policy)];
            }

            $facilitiesArray = explode(',', $roomInput['failities']);
            $facilitiesData = [];
            foreach ($facilitiesArray as $facility) {
                $facilitiesData[] = ['facilities' => trim($facility)];
            }

            $roomData = [
                'room' => $roomInput['room'],
                'roomavailable' => $roomInput['roomavailable'],
                'totalroom' => $roomInput['totalroom'],
                'Room_Bed' => $roomInput['Room_Bed'],
                'roomcurrency' => $roomInput['roomcurrency'],
                'roomactualprice' => $roomInput['roomactualprice'],
                'roomofferprice' => $roomInput['roomofferprice'],
                'roomtax' => $roomInput['roomtax'],
                'totalprice' => $roomInput['totalprice'],
                'room_type' => $roomInput['room_type'],
                'policies' => json_encode($policiesData),
                'failities' => json_encode($facilitiesData),
                'Extar_charage' => $roomInput['Extar_charage'],
                'Childerh_chrage' => $roomInput['Childerh_chrage'],
                'room_other_charge' => $roomInput['room_other_charge'],
                'room_discount' => $roomInput['room_discount'],
                'room_published_price' => $roomInput['room_published_price'],
                'room_offer_price_rounded_off' => $roomInput['room_offer_price_rounded_off'],
                'room_agentcomission' => $roomInput['room_agentcomission'],
                'TDS' => $roomInput['TDS'],
                'room_dimention' => $roomInput['room_dimention'],
                'Floors' => $roomInput['Floors'],
                // Add other fields as necessary
            ];
            $hotelRoomData[] = $roomData;
        }

        // Process hotel_amenities
        $amenitiesInput = $request->input('amenities');
        $hotelAmenitiesData = [];

        if (!empty($amenitiesInput['transportation'])) {
            $transportationArray = explode(',', $amenitiesInput['transportation']);
            foreach ($transportationArray as $transportation) {
                $hotelAmenitiesData['transportation'][] = ['type' => trim($transportation)];
            }
        }

        if (!empty($amenitiesInput['General'])) {
            $generalArray = explode(',', $amenitiesInput['General']);
            foreach ($generalArray as $general) {
                $hotelAmenitiesData['General'][] = ['type' => trim($general)];
            }
        }

        if (!empty($amenitiesInput['Food_Drink'])) {
            $foodDrinkArray = explode(',', $amenitiesInput['Food_Drink']);
            $hotelAmenitiesData['Food_Drink'] = implode(',', array_map('trim', $foodDrinkArray));
        }

        // Prepare data for insertion
        $data = [
            'company_id' => $businessLoginId,
            'hotel_name' => $request->input('hotel_name'),
            'hotel_address' => $request->input('hotel_address'),
            'hotel_city' => $request->input('hotel_city'),
            'hotel_images' => $hotelImages,
            'hotel_description' => $hotelDescription,
            'hotel_location' => $request->input('hotel_location'),
            'hotel_rating' => $request->input('hotel_rating'),
            'hotel_overview' => $hotelOverview,
            'hotel_policies' => $hotelPolicies,
            'hotel_services' => $hotelServices,
            'payment_type' => $request->input('payment'),
            'hotel_reviews' => $request->input('hotel_reviews'), // If there's a field for reviews
            'lat' => $request->input('lat'),
            'lon' => $request->input('lon'),
            'phone_number' => $request->input('phone_number'),
            'fax_number' => $request->input('fax_number'),
            'country_name' => $request->input('country_name'),
            'check_in_time' => $request->input('check_in_time'),
            'check_out_time' => $request->input('check_out_time'),
            'room_images' => $roomImages,
            'meal_type' => $request->input('meal_type'),
            'is_refundable' => $request->input('is_refundable'),
            'hotel_room' => $hotelRoomData,
            'hotel_amenities' => $hotelAmenitiesData,
        ];

        HotelSpecial::create($data);

        // // Convert arrays to JSON
        // $validated['room_name'] = json_encode($validated['room_name']);
        // $validated['room_description'] = json_encode($validated['room_description']);
        // $validated['cancellation_policies'] = json_encode($validated['cancellation_policies']);

        // $validated['hotel_images'] = json_encode($hotelImages);
        // $validated['room_images'] = json_encode($roomImages);   

        // $validated['company_id'] = $businessLoginId;
       
        // HotelSpecial::create($validated);

        return redirect('admin/business-login/hotel/add')->with('success', 'Hotel added successfully!');
    }
}
