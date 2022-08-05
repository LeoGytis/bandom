<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
use App\Models\User;


class Order extends Model
{
    use HasFactory;

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    const STATUSES = [
        1 => 'Not approved',
        2 => 'Canceled',
        3 => 'Pending',
        4 => 'Approved'
    ];
}
