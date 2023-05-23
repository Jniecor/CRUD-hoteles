<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Apartment;
class WebController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::where('availability', true)->get();
        $apartments = Apartment::where('availability', true)->get();
        return view('welcome', compact('apartments', 'hotels'));
    }
}
