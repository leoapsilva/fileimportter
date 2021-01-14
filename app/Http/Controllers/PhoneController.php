<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Http\Requests\PhoneRequest;

class PhoneController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phones.index', ['dashboard' => (new Phone)->buildDashboard()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhoneRequest $request)
    {
        Phone::create($request->validated());

        return redirect('/phones');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        return view('phones.show', [
            'phone' => $phone,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {
        return view('phones.edit', [
            'phone' => $phone,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(PhoneRequest $request, Phone $phone)
    {
        $phone->update($request->validated());
        
        return redirect('/phones');
    }

    /**
     * Delete the specified resource in storage
     *
     * @param Phone $phone
     * @return void
     */
    public function delete(Phone $phone)
    {
        return view('phones.delete', [
            'phone' => $phone,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        $phone->delete();
        
        return redirect('/phones');
    }
}
