<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class perfectweight extends Controller
{
    public function index()
    {
        return view('MainPages.weight.perfectweight');
    }
    public function result(Request $request)
    {
        // Get weight and height from the request
        $weight = $request->input('weight'); // in kg
        $height = $request->input('height'); // in cm

        // Convert height to meters
        $heightInMeters = $height / 100;

        // Calculate BMI
        $bmi = $weight / ($heightInMeters * $heightInMeters);

        // Determine the perfect weight range based on BMI
        $minPerfectWeight = 18.5 * ($heightInMeters * $heightInMeters);
        $maxPerfectWeight = 24.9 * ($heightInMeters * $heightInMeters);

        // Check if the weight is normal, underweight, or overweight
        $weightStatus = '';
        if ($weight < $minPerfectWeight) {
            $weightStatus = 'Underweight';
        } elseif ($weight > $maxPerfectWeight) {
            $weightStatus = 'Overweight';
        } else {
            $weightStatus = 'Normal';
        }
        // Return the BMI, perfect weight range, and weight status
        return view('MainPages.weight.Result', [
            'bmi' => $bmi,
            'minPerfectWeight' => $minPerfectWeight,
            'maxPerfectWeight' => $maxPerfectWeight,
            'weightStatus' => $weightStatus,
        ]);
    }
}
