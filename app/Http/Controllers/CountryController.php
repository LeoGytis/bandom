<?php

namespace App\Http\Controllers;

use App\Models\Country;
// use App\Http\Requests\StoreCountryRequest;
// use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Http\Request;
use Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('country.index', ['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'country_name' => ['required', 'min:5', 'max:64'],
                'country_s_time' => ['required', 'min:5', 'max:64'],
            ],

        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $country = new Country;
        $country->name = $request->country_name;
        $country->s_time = $request->country_s_time;
        $country->save();
        return redirect()->route('country.index')->with('pop_message', 'Successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('country.edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country->name = $request->country_name;
        $country->s_time = $request->country_s_time;
        $country->save();
        return redirect()->route('country.index')->with('pop_message', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {

        if (!$country->hotels->count()) {
            $country->delete();
            return redirect()->route('country.index')->with('pop_message', 'Successfully deleted!');
        }
        return redirect()->back()->with('pop_message', 'Cant not delete this country!');
    }
}
