@extends('layouts.invoice')

@section('title')

@endsection

@section('content')

    <div class="card">
        <div class="card-title p-2 bg-dark text-white">
            <span>{{ __('invoice.invoice-show') }} </span>
            <strong>{{ $invoice->customer_name }}</strong>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>{{ __('invoice.customer_name') }}</th>
                        <td>{{ $invoice->customer_name }}</td>
                        <th>{{ __('invoice.customer_email') }}</th>
                        <td>{{ $invoice->customer_email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('invoice.customer_mobile') }}</th>
                        <td>{{ $invoice->customer_mobile }}</td>
                        <th>{{ __('invoice.company_name') }}</th>
                        <td>{{ $invoice->company_name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('invoice.invoice_number') }}</th>
                        <td>{{ $invoice->invoice_number }}</td>
                        <th>{{ __('invoice.invoice_date') }}</th>
                        <td>{{ $invoice->invoice_date }}</td>
                    </tr>
                </table>
            </div>


            <div class="table-responsive">
                <table class="table" id="invoice-details">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ __('invoice.product-name') }}</th>
                            <th>{{ __('invoice.unit') }}</th>
                            <th>{{ __('invoice.quantity') }}</th>
                            <th>{{ __('invoice.unit-price') }}</th>
                            <th>{{ __('invoice.subtotal') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($invoice->details as $key => $details)
                        <tr class="coloning_row" id="{{ $key }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $details->product_name }}</td>
                            <td>{{ __('invoice.' . $invoice->unit) }}</td>
                            <td>{{ $details->quantity }}</td>
                            <td>{{ $details->unit_price }}</td>
                            <td>{{ $details->row_sub_total }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">{{ __('invoice.subtotal') }}</td>
                            <td colspan="">{{ $invoice->details()->subTotal() }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">{{ __('invoice.discount') }}</td>
                            <td colspan="">
                                <div >
                                    {{ __('invoice.' . $invoice->discount_type) }}
                                    {{ $invoice->discount_value }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">{{ __('invoice.vat') }} (5%)</td>
                            <td colspan="">
                                {{ $invoice->vat_value }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">{{ __('invoice.shipping') }}</td>
                            <td colspan="">{{ $invoice->shipping }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">{{ __('invoice.total_due') }}</td>
                            <td colspan="">{{ $invoice->total_due }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- end table-responsive -->

        </div><!-- end card-body -->
        <div class="text-center">
            <a href="{{ route('invoice.print', $invoice->id) }}" class="btn btn-info btn-sm">{{ __('invoice.print') }}</a>
            <a href="{{ route('invoice.pdf', $invoice->id) }}" class="btn btn-primary btn-sm">{{ __('invoice.export_pdf') }}</a>
            <a href="{{ route('invoice.sendEmail', $invoice->id) }}" class="btn btn-success btn-sm">{{ __('invoice.send_email') }}</a>
        </div><!-- end card-body -->
    </div><!-- end card -->



@endsection


