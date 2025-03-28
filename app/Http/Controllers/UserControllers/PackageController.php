<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\BaseControllers\PackageBase;
use Illuminate\Http\Request;
use App\Models\PackageEnquiry;
use Illuminate\Support\Facades\Mail;

class PackageController extends PackageBase
{
    public function package_enq_store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:50',
            'contactNo' => 'required|digits:10',
            'email' => 'required|email|max:50',
            'city' => 'required|string|max:16',
            'date_of_journey' => 'required|date',
            'number_of_days' => 'required|integer|min:1',
            'destination' => 'required|string|max:255',
            'no_of_adults' => 'required|integer|min:1',
            'no_of_children' => 'nullable|integer|min:0',
            'children_ages' => 'nullable|string',
        ]);

        // Save the enquiry data to the database
        $enquiry = new PackageEnquiry();
        $enquiry->company_name = $request->name;
        $enquiry->contact_no = $request->contactNo;
        $enquiry->email = $request->email;
        $enquiry->city = $request->city;
        $enquiry->date_of_journey = $request->date_of_journey;
        $enquiry->number_of_days = $request->number_of_days;
        $enquiry->destination = $request->destination;
        $enquiry->no_of_adults = $request->no_of_adults;
        $enquiry->no_of_children = $request->no_of_children;
        $enquiry->children_ages = $request->children_ages;
        $enquiry->save();


        // Send the email using PHP's mail() function
        $to = 'anand24h@gmail.com';
        $subject = "New Package Enquiry from " . $request->name;
        $message = "<h3>New Package Enquiry</h3>
        <p> Name:  $request->name  </p>
        <p>Contact No:  $request->contactNo  </p>
        <p>Email:  $request->email  </p>
        <p>City:  $request->city  </p>
        <p>Date of Journey:  $request->date_of_journey  </p>
        <p>Number of Days:  $request->number_of_days  </p>
        <p>Destination:  $request->destination  </p>
        <p>Number of Adults:  $request->no_of_adults  </p>
        <p>Number of Children:  $request->no_of_children  </p>
        <p>Children Ages:  $request->children_ages  </p>";

        $headers = "From: info@goingbo.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8";

        mail($to, $subject, $message, $headers);

        // Redirect back or show success message
        return redirect()->back()->with('success', 'Enquiry submitted successfully.');
    }
}
