<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'leave_dates',
        'status'
    ];

    //scopes

    public function scopeLatestLeaveDates($query)
    {
        return $query->where('user_id', Auth::id())
            ->whereNot('status', 'Rejected')
            ->latest();
    }

    //Attributes

    public function getDatesAttribute()
    {
        $dates = json_decode($this->leave_dates);
        
        return $dates->start_date.' To '.$dates->end_date;
    }

    //relations

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
