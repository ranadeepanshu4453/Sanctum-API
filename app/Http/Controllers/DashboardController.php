<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $data = Student::select('name', \DB::raw('count(*) as count'))
        ->groupBy('name')
        ->get();
        $student=Student::all();

        return view('Dashboard.graph',[
            'data'=>$data,
            'students'=>$student,
        ]);
    
    }

    public function map(){
        $latitude = 30.704649; // Example latitude
    $longitude = 76.717873; // Example longitude

    return view('Dashboard.map', compact('latitude', 'longitude'));
    }
}
