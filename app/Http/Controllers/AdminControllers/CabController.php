<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\BaseControllers\CabBase;
use App\Models\Cab;
use App\Models\City;
use App\Models\BusinessLogin;
use App\Models\CabRoute;
use Illuminate\Http\Request;

class CabController extends CabBase
{
    private const DRIVER_IMG = parent::IMG_PATH . "cab assets/driver/";
    private const VEHICLE_IMG = parent::IMG_PATH . "cab assets/vehicle/";

    function ui_view_cabs()
    {
        $data = ["cabs" => Cab::all()->toArray()];
        return view("admin.cab.view_cabs", $data);
    }
    function ui_add_cab()
    {
        return view("admin.cab.add_cab");
    }
    function ui_edit_cab($cabId)
    {
        $cab = Cab::find($cabId);
        // $vehicleFeatures = json_decode($cab['vehicle_features'], true);

        // var_dump($vehicleFeatures);
        // die();
        if (is_null($cab)) {
            return redirect()->to('/admin/cab');
        } else {
            return view("admin.cab.edit_cab", compact('cab'));
        }
    }

    function ui_delete_cab($cabId){
    // dd($cabId);
    /* $cab = Cab::find($cabId);
    if (!$cab) {
        session()->flash('result',["error" => "Record not found"]);
        return redirect('/admin/cab');
    }

    $cab->cab_bookings()->delete();
    $cab->cab_routes()->delete();
    $cab->cab_booking_bids()->delete();

    session()->flash('result', ["success"=> $cab->delete()]);
    return redirect()->back(); */
    }

    function ui_view_cab_routes()
    {
        $data = ["routes" => CabRoute::with(['cab', 'from_city', 'to_city'])->get()->toArray()];
        // dd($data);
        return view("admin.cab.view_cab_routes", $data);
    }
    function ui_add_cab_route($cabId)
    {
        $data = Cab::find($cabId);
        $cities = City::all();
        // view('admin.cab_routes', ['cabId' => $cabId]);
        return view("admin.cab.add_cab_route", ['data' => $data, 'cities' => $cities ]);
    }
    function ui_edit_cab_route($routeId)
    {
    }

    function web_add_cab(Request $request)
    {
        $fea = [];
        $features = $request->feature;
        foreach ($features['other'] as $key => $value) {
            $fea[] = $key;
        }
        $features['other'] = $fea;
        $params = [
            "business_profile" => $request->business_profile,  
            "company_id" => $request->company_id,              
            "owner_name" => $request->owner_name,
            "company_name" => $request->company_name,
            "company_address" => $request->company_address,
            "gst_number" => $request->gst_number,
            "owner_contact" => $request->owner_contact,
            "owner_email" => $request->owner_email,
            "owner_upi" => $request->owner_upi,
            "driver_name" => $request->driver_name,
            "driver_license" => $request->driver_license,
            "driver_img" => $request->driver_img,
            "vehicle_number" => $request->vehicle_number,
            "vehicle_model" => $request->vehicle_model,
            "vehicle_img" => $request->vehicle_img,
            "km_price" => $request->km_price,
            "vehicle_features" => $features,
            "yr_of_exp" => $request->yr_of_exp,
            "min_charge" => $request->min_charge,

        ];
        session()->flash('result', self::add_cab($params));
        return redirect()->back();
    }
    function web_edit_cab(Request $request, $cabId)
    {
        $fea = [];
        $features = $request->feature;
        foreach ($features['other'] as $key => $value) {
            $fea[] = $key;
        }
        $features['other'] = $fea;

        $params = [
            "owner_name" => $request->owner_name,
            "company_name" => $request->company_name,
            "company_address" => $request->company_address,
            "gst_number" => $request->gst_number,
            "owner_contact" => $request->owner_contact,
            "owner_email" => $request->owner_email,
            "owner_upi" => $request->owner_upi,
            "driver_name" => $request->driver_name,
            "driver_license" => $request->driver_license,
            "driver_img" => $request->driver_img,
            "vehicle_number" => $request->vehicle_number,
            "vehicle_model" => $request->vehicle_model,
            "vehicle_img" => $request->vehicle_img,
            "km_price" => $request->km_price,
            "vehicle_features" => $features,
            "yr_of_exp" => $request->yr_of_exp,
            "min_charge" => $request->min_charge,
        ];
        session()->flash('result', self::edit_cab($params, $cabId));
        return redirect()->back();
    }
    function web_toggle_cab(Request $request)
    {
    }
    function web_approve_cab(Request $request)
    {
    }
    function web_add_cab_route(Request $request)
    {
        $params = [
            "from_location" => $request->from_location,
            "to_location" => $request->to_location,
            "night_halt" => $request->night_halt,
            "price" => $request->price,
            "cab_id" => $request->vehicle_number,
            "free_cancel" => $request->free_cancel,
            "coupon" => $request->coupon,
            "reserved_at" => now()->timestamp,
        ];
        session()->flash('result', self::add_cab_route($params));
        return redirect()->back();
    }
    function web_edit_cab_route(Request $request)
    {
    }
    function web_toggle_cab_route(Request $request)
    {
    }
    function web_approve_cab_route(Request $request)
    {
    }

    function api_add_cab(Request $request)
    {
    }
    function api_edit_cab(Request $request)
    {
    }
    function api_toggle_cab($cabId)
    {
        return self::api_response(self::toggle_cab($cabId));
    }
    function api_approve_cab(Request $request)
    {
    }
    function api_add_cab_route(Request $request)
    {
    }
    function api_edit_cab_route(Request $request)
    {
    }
    function api_toggle_cab_route(Request $request)
    {
    }
    function api_approve_cab_route(Request $request)
    {
    }

    private function add_cab($params)
    {
        $driver_img = self::move_file($params['driver_img'], self::DRIVER_IMG);
        $vehicle_img = self::move_file($params['vehicle_img'], self::VEHICLE_IMG);


        $cab = new Cab([
            "business_profile" => $params['business_profile'],   
            "company_id" => $params['company_id'], 
            "owner_name" => $params['owner_name'],
            "company_name" => $params['company_name'],
            "company_address" => $params['company_address'],
            "gst_number" => $params['gst_number'],
            "owner_contact" => $params['owner_contact'],
            "owner_email" => $params['owner_email'],
            "owner_upi" => $params['owner_upi'],
            "driver_name" => $params['driver_name'],
            "driver_license" => $params['driver_license'],
            "driver_img" => $driver_img['filename'],
            "vehicle_number" => $params['vehicle_number'],
            "vehicle_model" => $params['vehicle_model'],
            "vehicle_img" => $vehicle_img['filename'],
            "km_price" => $params['km_price'],
            "vehicle_features" => json_encode($params['vehicle_features']),
            "yr_of_exp" => $params['yr_of_exp'],
            "min_charge" => $params['min_charge'],
        ]);
        return ["success" => $cab->save()];
    }
    private function edit_cab($params, $cabId)
    {
        $cab = Cab::find($cabId);

         // If a new driver image is uploaded, handle the file upload
         if ($params->hasFile('driver_img')) {
            $driver_img = $this->move_file($params->driver_img, self::DRIVER_IMG); 
            $cab->driver_img = $driver_img['filename'];  
        }

        // If a new vehicle image is uploaded, handle the file upload
        if ($params->hasFile('vehicle_img')) {
            $vehicle_img = $this->move_file($params->vehicle_img, self::VEHICLE_IMG); 
            $cab->vehicle_img = $vehicle_img['filename'];  
        }

        // Check if the record exists
        if ($cab) {
            // Update the fields with new values
            $cab->owner_name = $params['owner_name'];
            $cab->company_name = $params['company_name'];
            $cab->company_address = $params['company_address'];
            $cab->gst_number = $params['gst_number'];
            $cab->owner_contact = $params['owner_contact'];
            $cab->owner_email = $params['owner_email'];
            $cab->owner_upi = $params['owner_upi'];
            $cab->driver_name = $params['driver_name'];
            $cab->driver_license = $params['driver_license'];
            $cab->vehicle_number = $params['vehicle_number'];
            $cab->vehicle_model = $params['vehicle_model'];
            $cab->km_price = $params['km_price'];
            $cab->vehicle_features = json_encode($params['vehicle_features']);
            $cab->yr_of_exp = $params['yr_of_exp'];
            $cab->min_charge = $params['min_charge'];

            // Save the updated record
            $success = $cab->save();

            return ["success" => $success];
        } else {
            // Record not found
            return ["error" => "Record not found"];
        }
    }
    private function toggle_cab($cabId)
    {
        $cab = Cab::find($cabId);
        if (!$cab) return ["success" => false, "msg" => "Cab not exists"];
        $cab->cab_status = !$cab->cab_status;
        return  ["success" => $cab->save(), "msg" => $cab->cab_status ? "Cab Enabled" : "Cab Disabled"];
    }
    private function approve_cab()
    {
    }
    private function add_cab_route($params)
    {
        $cab = new CabRoute([
            "from_location" => $params['from_location'],
            "to_location" => $params['to_location'],
            "night_halt" => $params['night_halt'],
            "price" => $params['price'],
            "cab_id" => $params['cab_id'],
            "free_cancel" =>$params['free_cancel'],
            "coupon" => $params['coupon'],
            "reserved_at" => $params['reserved_at'],
        ]);
        return ["success" => $cab->save()];
    }
    private function edit_cab_route()
    {
    }
    private function toggle_cab_route()
    {
    }
    private function approve_cab_route()
    {
    }

    function business_ui_view_cabs()
    {
        // Get the logged-in business user’s ID from the session
        $businessLoginId = session('businessId');

        // Fetch business login details from the database
        $businessLogin = BusinessLogin::find($businessLoginId);

        // Check if the business login details were retrieved successfully
        if (!$businessLogin) {
            // If not found, maybe redirect to login or show an error message
            return redirect('admin/business-login')->withErrors(['msg' => 'User not found.']);
        }

        // Fetch cabs that belong to the same company as the logged-in business
        $data = [
            "cabs" => Cab::where('company_id', $businessLogin->id)->get()->toArray()
        ];

        // Return the view with the filtered cabs data
        return view("admin.business.cab.view_cab", $data);

    }


    function business_ui_add_cab(){
        $businessLoginId = session('businessId');

        // Fetch business login details from the database
        $businessLogin = BusinessLogin::find($businessLoginId);

        // Check if the business login details were retrieved successfully
        if (!$businessLogin) {
            // If not found, maybe redirect to login or show an error message
            return redirect('admin/business-login')->withErrors(['msg' => 'User not found.']);
        }
        $businessLogin = BusinessLogin::find($businessLoginId);
        return view("admin.business.cab.add_cab", compact('businessLogin'));

    }

    function business_ui_edit_cab($cabId)
    {
        $cab = Cab::find($cabId);
        // $vehicleFeatures = json_decode($cab['vehicle_features'], true);

        // var_dump($vehicleFeatures);
        // die();
        if (is_null($cab)) {
            return redirect()->to('/admin/business-login/dashboard');
        } else {
            return view("admin.business.cab.edit_cab", compact('cab'));
        }
    }

    public function business_web_add_cab(Request $request)
    {
        // Handle and prepare features array
        $fea = [];
        $features = $request->feature;
        foreach ($features['other'] as $key => $value) {
            $fea[] = $key;
        }
        $features['other'] = $fea;

        // Handle file uploads
        $driver_img = $this->move_file($request->driver_img, self::DRIVER_IMG); // Assuming move_file method is already defined
        $vehicle_img = $this->move_file($request->vehicle_img, self::VEHICLE_IMG); // Assuming move_file method is already defined

        // Create new Cab record
        $cab = new Cab([
            "business_profile" => $request->business_profile,
            "company_id" => $request->company_id,
            "owner_name" => $request->owner_name,
            "company_name" => $request->company_name,
            "company_address" => $request->company_address,
            "gst_number" => $request->gst_number,
            "owner_contact" => $request->owner_contact,
            "owner_email" => $request->owner_email,
            "owner_upi" => $request->owner_upi,
            "driver_name" => $request->driver_name,
            "driver_license" => $request->driver_license,
            "driver_img" => $driver_img['filename'], // Use the moved file name for driver image
            "vehicle_number" => $request->vehicle_number,
            "vehicle_model" => $request->vehicle_model,
            "vehicle_img" => $vehicle_img['filename'], // Use the moved file name for vehicle image
            "km_price" => $request->km_price,
            "vehicle_features" => json_encode($features), // Encode the features array into JSON
            "yr_of_exp" => $request->yr_of_exp,
            "min_charge" => $request->min_charge,
        ]);

        // Save the cab and check if successful
        $success = $cab->save();

        // Flash the result to the session and redirect back
        session()->flash('result', ['success' => $success]);

        return redirect()->back();
    }
    
    public function business_web_edit_cab(Request $request, $cabId){
        // Retrieve the cab record by ID
        $cab = Cab::find($cabId);

        // Check if the record exists
        if (!$cab) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        }

        // Handle and prepare features array
        $fea = [];
        $features = $request->feature;
        foreach ($features['other'] as $key => $value) {
            $fea[] = $key;
        }
        $features['other'] = $fea;

        // If a new driver image is uploaded, handle the file upload
        if ($request->hasFile('driver_img')) {
            $driver_img = $this->move_file($request->driver_img, self::DRIVER_IMG); 
            $cab->driver_img = $driver_img['filename'];  
        }

        // If a new vehicle image is uploaded, handle the file upload
        if ($request->hasFile('vehicle_img')) {
            $vehicle_img = $this->move_file($request->vehicle_img, self::VEHICLE_IMG); 
            $cab->vehicle_img = $vehicle_img['filename'];  
        }

        // Update the other fields with new values
        $cab->owner_name = $request->owner_name;
        $cab->company_name = $request->company_name;
        $cab->company_address = $request->company_address;
        $cab->gst_number = $request->gst_number;
        $cab->owner_contact = $request->owner_contact;
        $cab->owner_email = $request->owner_email;
        $cab->owner_upi = $request->owner_upi;
        $cab->driver_name = $request->driver_name;
        $cab->driver_license = $request->driver_license;
        $cab->vehicle_number = $request->vehicle_number;
        $cab->vehicle_model = $request->vehicle_model;
        $cab->km_price = $request->km_price;
        $cab->vehicle_features = json_encode($features);  // Encode features to JSON
        $cab->yr_of_exp = $request->yr_of_exp;
        $cab->min_charge = $request->min_charge;

        // Save the updated record
        $success = $cab->save();

        // Flash the result to the session and redirect back
        if ($success) {
            session()->flash('result', ['success' => 'Cab updated successfully']);
        } else {
            session()->flash('result', ['error' => 'Error updating cab']);
        }

        return redirect()->back();

    }

    public function business_toggle_cab($cabId)
    {
        $cab = Cab::find($cabId);
        if (!$cab) return ["success" => false, "msg" => "Cab not exists"];
        $cab->cab_status = !$cab->cab_status;
        return  ["success" => $cab->save(), "msg" => $cab->cab_status ? "Cab Enabled" : "Cab Disabled"];
    }

    public function business_ui_view_cab_route(){
        // Fetch the logged-in business user's ID from the session
        $businessLoginId = session('businessId');

        // Fetch business login details from the database
        $businessLogin = BusinessLogin::find($businessLoginId);

        // Check if the business login details were retrieved successfully
        if (!$businessLogin) {
            // If not found, maybe redirect to login or show an error message
            return redirect('admin/business-login')->withErrors(['msg' => 'User not found.']);
        }

        // Fetch only cab routes where the company_id of the cab matches the logged-in business user's company_id
        $data = [
            "routes" => CabRoute::whereHas('cab', function ($query) use ($businessLogin) {
                $query->where('company_id', $businessLogin->id);
            })
            ->with(['cab', 'from_city', 'to_city'])  // Eager load the relationships
            ->get()
            ->toArray()
        ];

        return view("admin.business.cab.view_cab_routes", $data);
    }

    public function business_ui_add_cab_route($cabId)
    {
        $data = Cab::find($cabId);
        $cities = City::all();
        // view('admin.business.cab_routes', ['cabId' => $cabId]);
        return view("admin.business.cab.add_cab_route", ['data' => $data, 'cities' => $cities ]);
    }

    public function business_web_add_cab_route(Request $request)
    {
    
        // Create new CabRoute entry
        $cabRoute = new CabRoute([
            "from_location" => $request->from_location,
            "to_location" => $request->to_location,
            "night_halt" => $request->night_halt,
            "price" => $request->price,
            "cab_id" => $request->vehicle_number,
            "free_cancel" => $request->free_cancel,
            "coupon" => $request->coupon,
            "reserved_at" => now()->timestamp,
        ]);
    
        // Save the CabRoute to the database and check for success
        $success = $cabRoute->save();
    
        // Flash the result to the session and redirect back
        if ($success) {
            session()->flash('result', ['success' => 'Cab route added successfully']);
        } else {
            session()->flash('result', ['error' => 'Failed to add cab route']);
        }
    
        return redirect()->back();
    }
    
}
