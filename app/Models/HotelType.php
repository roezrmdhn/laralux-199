<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'hotels_type';
    protected $fillable = ['name'];
}
    