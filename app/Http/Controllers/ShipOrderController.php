<?php

namespace App\Http\Controllers;

use App\Models\ShipOrder;
use App\Http\Requests\ShipOrderRequest;

class ShipOrderController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ship-orders.index', ['dashboard' => (new ShipOrder)->buildDashboard()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ship-orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipOrderRequest $request)
    {
        ShipOrder::create($request->validated());

        return redirect('/ship-orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShipOrder  $shipOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ShipOrder $shipOrder)
    {
        return view('ship-orders.show', [
            'shipOrder' => $shipOrder,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShipOrder  $shipOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipOrder $shipOrder)
    {
        return view('ship-orders.edit', [
            'shipOrder' => $shipOrder,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShipOrder  $shipOrder
     * @return \Illuminate\Http\Response
     */
    public function update(ShipOrderRequest $request, ShipOrder $shipOrder)
    {
        $shipOrder->update($request->validated());
        
        return redirect('/ship-orders');
    }

    /**
     * Delete the specified resource in storage
     *
     * @param ShipOrder $shipOrder
     * @return void
     */
    public function delete(ShipOrder $shipOrder)
    {
        return view('ship-orders.delete', [
            'shipOrder' => $shipOrder,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShipOrder  $shipOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipOrder $shipOrder)
    {
        $shipOrder->delete();
        
        return redirect('/ship-orders');
    }
}
