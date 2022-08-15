<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
// use App\Http\Requests\StoreHotelRequest;
// use App\Http\Requests\UpdateHotelRequest;
use Illuminate\Http\Request;
use App\Models\Country;
use Validator;
use Image;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hotels = match ($request->sort) {
            'price-asc' => Hotel::orderBy('price', 'asc')->get(),
            'price-desc' => Hotel::orderBy('price', 'desc')->get(),
            default => Hotel::all()
        };
        
        $countries = Country::all();
        // $hotels = Hotel::all();
        // $countries = Country::where('id', '=', $countryId)->first();  
        return view('hotel.index', ['countries' => $countries, 'hotels' => $hotels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('hotel.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHotelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'hotel_name' => ['required', 'min:5', 'max:64'],
                'hotel_price' => ['required', 'min:5', 'max:64'],
                'hotel_trip_time' => ['required', 'min:5', 'max:64'],
            ],
        );
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $hotel = new Hotel;
        $hotel->name = $request->hotel_name;
        $hotel->price = $request->hotel_price;
        $hotel->trip_time = $request->hotel_trip_time;
        
        // ========================== Photo file ==========================

        if ($request->file('hotel_photo')) {

            $photo = $request->file('hotel_photo');
            $ext = $photo->getClientOriginalExtension();  //get extention of the file
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME); //original file name

            $file = $name. '-' . rand(100, 111). '.' . $ext;  //create new name for the file
            $photo->move(public_path().'/images', $file); //move file from tmp

            $hotel->photo = asset('/images') . '/' . $file; //read file path as url
        }


        $hotel->country_id = $request->country_id;
        $hotel->save();
        return redirect()->route('hotel.index')->with('pop_message', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $countries = Country::all();
        return view('hotel.edit', ['hotel' => $hotel, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelRequest  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $hotel->name = $request->hotel_name;
        $hotel->price = $request->hotel_price;
        $hotel->trip_time = $request->hotel_trip_time;
        $hotel->photo = $request->hotel_photo;
        $hotel->country_id = $request->country_id;
        $hotel->save();
        return redirect()->route('hotel.index')->with('pop_message', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotel.index')->with('pop_message', 'Successfully deleted!');
    }

    public function deletePicture(Hotel $hotel) 
    {
        $name = pathinfo($hotel->photo, PATHINFO_FILENAME);
        $ext = pathinfo($hotel->photo, PATHINFO_EXTENSION);

        $path = asset('/images') . '/' . $name . '.' . $ext;

        if(file_exists($path)) {
            unlink($path);
        }
        
        $hotel->photo = null;
        $hotel->save();

        return redirect()->back()->with('pop_message', 'hotel have no photo now');
    }
}
