<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'hotels';
    protected $fillable = ['name', 'address', 'phone', 'email', 'hotels_type_id'];
    public function hotel_type()
    {
        return $this->belongsTo(HotelType::class, 'hotels_type_id', 'id');
    }
}
