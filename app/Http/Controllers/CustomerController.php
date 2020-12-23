<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Validate Customer
     *
     * @return void
     */
    protected function validateCustomer()
    {
        return request()->validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable','string', 'email', 'max:255', 'unique:users'],
            'gender' => ['nullable','string', 'max:25'],
            'ip_address' => ['nullable','ipv4'],
            'company' => ['nullable','string', 'max:50'],
            'city' => ['nullable','string', 'max:50'],
            'title' => ['nullable','string', 'max:15'],
            'website' => ['nullable','active_url', 'max:255'],
            ]);
    }

    protected function buildDashboard()
    {
        $customers = Customer::all();
        $total = count($customers);
        $unique = count($customers->unique(function ($item) { return $item['first_name'].$item['last_name'].$item['email'].$item['company'].$item['city'].$item['gender']; }));
        $no_email = count($customers->filter(function ($item) { return empty($item->email);}));
        $no_last_name = count($customers->filter(function ($item) { return empty($item->last_name);}));
        $no_gender = count($customers->filter(function ($item) { return empty($item->gender);}));
        $duplicated = $total - $unique;
        $per_unique = floor($unique/$total*100);
        $per_duplicated = floor($duplicated/$total*100);
        $per_no_email = floor($no_email/$total*100);
        $per_no_last_name = floor($no_last_name/$total*100);
        $per_no_gender = floor($no_gender/$total*100);

        $dashboard = collect([ 	'total' => $total,
                                'unique' => $unique,
                                'duplicated' => $duplicated,
                                'no_email' =>  $no_email,
                                'no_last_name' => $no_last_name,	
                                'no_gender' => $no_gender,
                                'per_unique' => $per_unique,
                                'per_duplicated' => $per_duplicated,
                                'per_no_email' =>  $per_no_email,
                                'per_no_last_name' => $per_no_last_name,	
                                'per_no_gender' => $per_no_gender,
                                
        ]);	

        return $dashboard;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dashboard = $this->buildDashboard();
        
        return view('customers.index')->with(compact('dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Customer::create($this->validateCustomer());

        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show', [
            'customer' => $customer,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($this->validateCustomer());
        
        return redirect('/customers');
    }

    /**
     * Delete the specified resource in storage
     *
     * @param Customer $customer
     * @return void
     */
    public function delete(Customer $customer)
    {
        return view('customers.delete', [
            'customer' => $customer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        
        return redirect('/customers');
    }
}
