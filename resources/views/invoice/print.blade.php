@extends('layouts.print_master')

@section('title')

@endsection

@section('content')

    <div class="card">
        <div class="card-title ">
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
                            <th style="width: 5%"></th>
                            <th style="width: 50%">{{ __('invoice.product-name') }}</th>
                            <th style="width: 10%">{{ __('invoice.unit') }}</th>
                            <th style="width: 10%">{{ __('invoice.quantity') }}</th>
                            <th style="width: 10%">{{ __('invoice.unit-price') }}</th>
                            <th style="width: 15%">{{ __('invoice.subtotal') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($invoice->details as  $details)
                        <tr class="coloning_row" >
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $details->product_name }}</td>
                            <td>{{ __('invoice.' . $details->unit) }}</td>
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

    </div><!-- end card -->



@endsection

@push('script')
<script>
    window.print();
</script>
@endpush
