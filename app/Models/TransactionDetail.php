<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'transaction_details';
    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }
    // foreign key yang dititipkan pada tabel, akan menggunakan relasi belongsTo. Sedangkan tabel utama yang menitipkan, di modelsnya menggunakan relasi hasMany / hasOne!!!!
}
