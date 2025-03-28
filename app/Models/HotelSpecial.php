<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelSpecial
 * 
 * @property int $id
 * @property string $hotel_name
 * @property string $hotel_address
 * @property string $hotel_images
 * @property string $hotel_description
 * @property string $hotel_location
 * @property string $hotel_rating
 * @property string $hotel_amenities
 * @property string $hotel_overview
 * @property string $hotel_policies
 * @property string $hotel_room
 * @property string $hotel_services
 * @property string $payment_type
 * @property string $hotel_reviews
 * @property float $lat
 * @property float $lon
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class HotelSpecial extends Model
{
	protected $table = 'hotel_specials';

	protected $casts = [
		'lat' => 'float',
		'lon' => 'float',
		'is_refundable' => 'boolean', 
        'hotel_images' => 'array',   
        'room_images' => 'array', 
        'hotel_description' => 'array',
        'hotel_overview' => 'array',
        'hotel_policies' => 'array',  
        'hotel_amenities' => 'array',
        'hotel_room' => 'array', 
        'hotel_services' => 'array',
	];

	protected $fillable = [
        'company_id',
		'hotel_name',
        'hotel_address',
        'hotel_city',
        'hotel_location',
        'hotel_description',
        'hotel_rating',
        'phone_number',
        'fax_number',
        'country_name',
        'check_in_time',
        'check_out_time',
        'hotel_amenities',   
        'hotel_overview',    
        'hotel_policies',    
        'hotel_room',        
        'hotel_services',    
        'payment_type',      
        'hotel_reviews',     
        'meal_type',
        'is_refundable',       
        'lat',
        'lon',
        'hotel_images',  
        'room_images',   
 
	];

}
