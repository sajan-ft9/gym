<?php

use Carbon\Carbon;



function getRemainingDays($start_date, $end_date){
    $startDate = Carbon::parse($start_date);
    $endDate = Carbon::parse($end_date);
    $remaining_days = $startDate->diffInDays($endDate);
    return $remaining_days;
}