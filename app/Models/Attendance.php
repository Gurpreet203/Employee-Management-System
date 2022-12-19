<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attendance extends Model
{
    use HasFactory;

    const PRESENT = 'Present';
    const ABSENT = 'Absent';
    const LEAVE = 'Leave';

    protected $fillable = [
        'user_id',
        'status',
        'date',
        'penality'
    ];

    // scopes

    public function scopeExist($query)
    {
        return $query->where('date', now()->toDateString())
            ->where('user_id', Auth::id());
    }

    public function scopeLeaves($query)
    {
        return $query->where('user_id', Auth::id())
            ->where('status', 'Leave')
            ->where('date', now()->toDateString());
    }

    public function scopeLatestDate($query)
    {
        return $query->where('user_id', Auth::id())
            ->latest();
    }

    public function scopeAbsent($query)
    {
        return $query->where('user_id', Auth::id())
            ->where('status', 'Absent');
    }

    public function scopeAttendenceRecord($query, User $user)
    {
        return $query->where('user_id', $user->id)
            ->latest();
    }
}
