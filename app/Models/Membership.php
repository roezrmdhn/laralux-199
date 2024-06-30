<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $table = 'memberships';
    protected $guarded = ['id'];
    protected $fillable = ['users_id', 'status'];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
