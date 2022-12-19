<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Leave extends Model
{
    use HasFactory;

    const APPROVED = 'Approved';
    const PENDING = 'Pending';
    const REJECTED = 'Rejected';

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'leave_dates',
        'status'
    ];

    //scopes

     public function scopeSearch($query ,array $filter)
    {
       $query->when($filter['search'] ?? false, function($query , $search) {
           return $query
            ->where('status','like','%'.$search.'%');
        });
    }

    public function scopeVisibleTo($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function scopeLatestLeaveDates($query)
    {
        return $query->visibleTo()
            ->whereNot('status', 'Rejected')
            ->latest();
    }

    public function scopePendingLeaves($query)
    {
        return $query->where('status', Leave::PENDING);
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
