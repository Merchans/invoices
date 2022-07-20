<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();

        return view('invoices.index', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        // dd($request->descriptions);

        $invoice = Invoice::create($request->all());

        for ($i = 0; $i < count($request->descriptions); $i++) {
            $item = [
                'description' => $request->descriptions[$i],
                'quantity' => $request->quantities[$i],
                'price' => $request->price_per_units[$i],
            ];

            $invoice->items()->create($item);
        }

        if (!$invoice) {
            return back()->with('message', __('Something is wrong invoice was not created.'));
        }
        return back()->with('message', __('Invoice was successfuled created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {
        $invoice = Invoice::find($invoice);

        // dd($invoice->items);

        return view('invoices.show', ['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($invoice)
    {
        $invoice = Invoice::find($invoice);

        // $data = $invoice->only(['receiver', 'supplier', 'amount']);

        return view('invoices.edit', ['data' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request)
    {
        $invoice = Invoice::find($request->id);

        

        $invoice->update([
            'receiver' => $request->receiver,
            'supplier' => $request->supplier,
            'issue_date' => $request->issue_date,
            'terms' => $request->terms,
        ]);

        $invoice->items()->delete();

        for ($i = 0; $i < count($request->descriptions); $i++) {
            $items = [
                'description' => $request->descriptions[$i],
                'quantity' => $request->quantities[$i],
                'price' => $request->price_per_units[$i],
            ];
            
            $invoice->items()->create($items);
        }

        
        

        return back()->with('message', __('Invoice has been successfully updated'));;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoice)
    {
        $invoice = Invoice::find($invoice);

        $invoice->delete();

        return back()->with('message', __('Invoice has been successfully destroyed'));
    }
}
