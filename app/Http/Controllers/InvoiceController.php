<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
class InvoiceController extends Controller
{


    public function index()
    {
        $invoices = Invoice::latest('id')->paginate(10);
        return view('invoice.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoice.create');
    }

    public function store()
    {
        // dd(request()->all());
        // request()->validate([
        //     'customer_name' =>  'required|string|min:100'
        // ]);

        try{
            $data = [];
            $data['customer_name'] = request()->customer_name;
            $data['customer_email'] = request()->customer_email;
            $data['customer_mobile'] = request()->customer_mobile;
            $data['company_name'] = request()->company_name;
            $data['invoice_number'] = request()->invoice_number;
            $data['invoice_date'] = request()->invoice_date;
            $data['discount_type'] = request()->discount_type;
            $data['discount_value'] = request()->discount_value;
            $data['vat_value'] = request()->vat_value;
            $data['shipping'] = request()->shipping;
            $data['total_due'] = request()->total_due;

            DB::beginTransaction();
            $invoice = Invoice::create($data);

            $details = [];
            foreach(request()->product_name as $key => $value){
                $details[$key] = [
                    'invoice_id' => $invoice->id,
                    'product_name' => request()->product_name[$key],
                    'unit' => request()->unit[$key],
                    'quantity' => request()->quantity[$key],
                    'unit_price' => request()->unit_price[$key],
                    'row_sub_total' => request()->row_sub_total[$key],
                ];
            }

            $invoice->details()->createMany($details);
            DB::commit();

            return redirect()->route('invoice.create')->with('success', __('invoice.created_successfully'));
        }
        catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('invoice.create')->with('error', __('invoice.created_failed'));
        }
    }

    public function show($id)
    {
        try{
            $invoice = Invoice::where('id', $id)->with(['details' => function($query){
                return $query;
            }])->first();

            if(!$invoice)
                return redirect()->route('invoice')->with('error', __('invoice.not_found'));

            return view('invoice.show', compact('invoice'));
        }
        catch(\Exception $ex){
            return redirect()->route('invoice.show')->with('error', __('invoice.edited_failed'));
        }
    }


    public function edit($id)
    {
        try{
            $invoice = Invoice::where('id', $id)->with(['details' => function($query){
                return $query;
            }])->first();

            if(!$invoice)
                return redirect()->route('invoice')->with('error', __('invoice.not_found'));

            return view('invoice.edit', compact('invoice'));
        }
        catch(\Exception $ex){
            return redirect()->route('invoice.edit')->with('error', __('invoice.edited_failed'));
        }
    }

    public function update($id)
    {
        try{
            $invoice = Invoice::where('id', $id)->with(['details' => function($query){
                return $query;
            }])->first();

            if(!$invoice)
                return redirect()->route('invoice.create')->with('error', __('invoice.not_found'));

            $data = [];
            $data['customer_name'] = request()->customer_name;
            $data['customer_email'] = request()->customer_email;
            $data['customer_mobile'] = request()->customer_mobile;
            $data['company_name'] = request()->company_name;
            $data['invoice_number'] = request()->invoice_number;
            $data['invoice_date'] = request()->invoice_date;
            $data['discount_type'] = request()->discount_type;
            $data['discount_value'] = request()->discount_value;
            $data['vat_value'] = request()->vat_value;
            $data['shipping'] = request()->shipping;
            $data['total_due'] = request()->total_due;

            DB::beginTransaction();
            $invoice->update($data);

            $details = [];
            foreach(request()->product_name as $key => $value){
                $details[$key] = [
                    'invoice_id' => $invoice->id,
                    'product_name' => request()->product_name[$key],
                    'unit' => request()->unit[$key],
                    'quantity' => request()->quantity[$key],
                    'unit_price' => request()->unit_price[$key],
                    'row_sub_total' => request()->row_sub_total[$key],
                ];
            }

            $invoice->details()->delete();
            $invoice->details()->createMany($details);
            DB::commit();

            return redirect()->route('invoice')->with('success', __('invoice.updated_successfully'));
        }
        catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('invoice.edit', $id)->with('error', __('invoice.updated_failed'));
        }
    }

    public function delete($id)
    {
        # code...
    }


    public function print($id)
    {
        try{
            $invoice = Invoice::where('id', $id)->with(['details' => function($query){
                return $query;
            }])->first();

            if(!$invoice)
                return redirect()->route('invoice')->with('error', __('invoice.not_found'));

            return view('invoice.print', compact('invoice'));
        }
        catch(\Exception $ex){
            return redirect()->route('invoice')->with('error', __('invoice.edited_failed'));
        }
    }

    public function pdf($id)
    {
        try{
            $invoice = Invoice::where('id', $id)->with(['details' => function($query){
                return $query;
            }])->first();

            if(!$invoice)
                return redirect()->route('invoice')->with('error', __('invoice.not_found'));

            $pdf = PDF::loadView('invoice.pdf',  compact('invoice'));
            if(request()->route()->getName() == 'iinvoice.pdf'){
                // return view('invoice.pdf', compact('invoice'));
                return $pdf->download($invoice->id . '.pdf');
            }
            else{
                $pdf->save(public_path('mails/invoices/').$invoice->invoice_number.'.pdf');
                return $invoice->invoice_number.'.pdf';
            }
        }
        catch(\Exception $ex){
            dd($ex);
            return redirect()->route('invoice.show', $id)->with('error', __('invoice.edited_failed'));
        }
    }

    public function sendEmail($id)
    {
        try{
            $invoice = Invoice::where('id', $id)->with(['details' => function($query){
                return $query;
            }])->first();

            if(!$invoice)
                return redirect()->route('invoice')->with('error', __('invoice.not_found'));

           $this->pdf($id);

           config('mail.from.address', "admin@invoice-system.com");
           config('mail.from.name', 'Invoice System Admin');
           Mail::to($invoice->customer_email)->send(new InvoiceMail($invoice));

            return redirect()->route('invoice.show', $id)->with('success', __('invoice.sent_successfully'));
        }
        catch(\Exception $ex){
            dd($ex);
            return redirect()->route('invoice.show', $id)->with('error', __('invoice.edited_failed'));
        }
    }



}// end controller
