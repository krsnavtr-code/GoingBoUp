<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageEnquiry extends Model
{
    use HasFactory;
    protected $table = 'package_enquiry';
    public $timestamps = false;

    protected $fillable = [
        'company_name', 
        'contact_no', 
        'email',
        'city',
        'date_of_journey',
        'number_of_days',
        'destination', 
        'no_of_adults',
        'no_of_children',
        'children_ages',
        'guest_details'
    ];
}
