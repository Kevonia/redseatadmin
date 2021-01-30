<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\User;
use App\Package;
use App\Fee;
use App\Billing;

class CustomerInvoice extends Controller
{
    //


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            
        $user = User::all();
        
        $package = Package::all();

       

        return view('/vendor/voyager/customerinvoice', compact('user','package') );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
     

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
  

     
        $user = User::where('id', '=', $request->user)->get();
        $package = Package::where('id', '=', $request->package)->get();

        $fee = Fee::where('name','=','Processing Fee')->where('lower_limit','<=',$package[0]->weight)->get();

        $fee1 =Fee::where('name','!=','Processing Fee')->where('lower_limit','<=',$package[0]->weight)->where('upper_limit','>=',$package[0]->weight)->get();


        
        $customer = new Party([
            'name'          => $user[0]->name,
            'email'         =>$user[0]->email,
        ]);

  

        $items = [
            (new InvoiceItem())->title($package[0]->description)->pricePerUnit($fee1[0]->value_jmd)->quantity($package[0]->weight)->units($fee[0]->value_jmd),
      
        ];

        if($request->custom_fees!=0){
            $items[1]= (new InvoiceItem())->title("Custom Duty")->pricePerUnit($request->custom_fees)->quantity(1)->units(1);
        }


        if($request->purchasing_fees!=0){
            $items[2]= (new InvoiceItem())->title("Purchasing Fee")->pricePerUnit($request->purchasing_fees)->quantity(1)->units(1);
        }
      
            $billing = Billing::create(
                    [
                    'description' => $fee1[0]->name,
                    'status' => 1,
                    'value' => $fee1[0]->value_jmd,
                    'package' => $package[0]->id,
                ]
            );

        $billing = Billing::create(
                [
                    'description' => 'Custom Duty',
                    'status' => 1,
                    'value' => $request->custom_fees,
                    'package' => $package[0]->id,
                ],
        );

        $billing = Billing::create(
            [
                'description' => 'Purchasing Fee',
                'status' => 1,
                'value' => $request->purchasing_fees,
                'package' => $package[0]->id,
            ],
        );

 

        

        $invoice = Invoice::make('receipt')
            ->series('RSCJA')
            ->sequence($billing->id)
            ->serialNumberFormat('{SERIES}-{SEQUENCE}')
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator(',')
            ->currencyDecimalPoint('.')
            ->filename($customer->name.' '.$billing->id.' '.$package[0]->description)
            ->addItems($items)

            ->logo(public_path('vendor/invoices/sample-logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
