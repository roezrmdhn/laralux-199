<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['name', 'image',  'price', 'rating', 'status', 'facilities_id', 'room_type_id', 'hotels_id'];
    public function facilities()
    {
        return $this->belongsTo(Facilities::class);
    }
    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }
    // foreign key yang dititipkan pada tabel, akan menggunakan relasi belongsTo. Sedangkan tabel utama yang menitipkan, di modelsnya menggunakan relasi hasMany / hasOne!!!!
}
