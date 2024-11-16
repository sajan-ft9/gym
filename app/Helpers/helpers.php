<?php

use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

if (!function_exists('formatDuration')) {
    /**
     * Convert minutes to hours and minutes format (e.g., 90 minutes => 1 hour 30 minutes)
     *
     * @param int $minutes
     * @return string
     */
    function formatDuration(int $minutes)
    {
        // Calculate hours and remaining minutes
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        // Build the result string
        $result = '';

        // Append hours if applicable
        if ($hours > 0) {
            $result .= $hours . ' hr' . ($hours > 1 ? 's' : '') . ' ';
        }

        // Append minutes if applicable
        if ($remainingMinutes > 0) {
            $result .= $remainingMinutes . ' min' . ($remainingMinutes > 1 ? 's' : '');
        }

        // If no hours and no minutes, return 0 minutes
        return $result ?: '0 minutes';
    }
}

if (!function_exists('isEnrolled')) {

    function isEnrolled($courseId)
    {
        if (Auth::check()) {
            return Enrollment::where('user_id', Auth::id())
                ->where('course_id', $courseId)
                ->exists();
        }
        return false;
    }
}
