<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        $decodedString = base64_decode($request->data);
        $data = json_decode($decodedString, true);

        $course = session('course');

        if (array_key_exists("status", $data)) {
            $status = $data["status"];

            if ($status === "COMPLETE") {
                if ($course) {
                    $user = Auth::user();
                    $enrollment = Enrollment::create([
                        'user_id' => $user->id,
                        'course_id' => $course,
                        'enrollment_date' => now(),
                    ]);

                    return redirect()->route('website.courses.show', $course)
                                     ->with('success', 'Enrolled successfully.');
                }
            }
        }

        return redirect()->route('website.courses.show', $course)
                         ->with('error', 'Enrollment failed. Please try again.');
    }

    public function paymentFailure(){
        $course = session('course');
        return redirect()->route('website.home')
        ->with('error', 'Enrollment failed. Please try again.');
    }
}
