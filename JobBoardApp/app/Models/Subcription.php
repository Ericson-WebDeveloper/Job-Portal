<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcription extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function getIsSubcribedAttribute()
    {
        return $this->status == "subcribed" ? true : false;
    }

    public function getUntilWhenAttribute()
    {
        return $this->end ? Carbon::parse($this->end)->format('Y-m-d') : null;
    }

    public function getIsSubcribedValidAttribute()
    {
        $datenow = Carbon::now('Asia/Manila');
        return $datenow->greaterThan(Carbon::parse($this->end));
    }

    public function getDueDateAttribute()
    {
        // exact date and time
        // $datenow = Carbon::now('Asia/Manila');
        // return $datenow->equalTo(Carbon::parse($this->end));

        // new code
        // 1 middleware with partner
        $datenow = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
        $end = Carbon::parse($this->end)->format('Y-m-d H:i:s');
        // return $datenow->gt($end); // date now is greater than due date subcription
        // return $end->gt($datenow) && // date now is greater than due date subcription
        return $datenow >= $end;
    }

    public function getDueDateTodayAttribute()
    {
        // exact date
        // 1 middleware with partner
        $datenow = Carbon::now('Asia/Manila')->format('Y-m-d');
        $end = Carbon::parse($this->end)->format('Y-m-d');
        return $datenow >= $end;
    }

    public function getDueDateTimeAttribute()
    {
        // exact date and time
        // alisin na
        $datenow = Carbon::now('Asia/Manila');
        $hours = $datenow->diffInHours(Carbon::parse($this->end));
        return $hours <= 12 ? true : false;
    }

    // checking 1 week -> 6 or 7 days -> notify the user in dashboard
    public function getOneWeekAttribute()
    {
        // one week
        $datenow = Carbon::now('Asia/Manila');
        $end = Carbon::parse($this->end);
        $days = $datenow->diffInDays($end);
        return $days == 6 || $days == 7;
    }
}
