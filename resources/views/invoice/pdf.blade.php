<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        body {
            font-family: 'XBRiyaz', sans-serif;
            @if(config('app.locale') == "ar")
            direction: rtl;
            @endif
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 9px;
            line-height: 24px;
            font-family: 'XBRiyaz', sans-serif;
            color: #555;
            @if(config('app.locale') == "ar")
            direction: rtl;
            @endif
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: {{ config('app.locale') == 'ar'? 'left': 'right' }};
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td {
            text-align: {{ config('app.locale') == 'ar'? 'right': 'left' }};
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 30px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: 'XBRiyaz', sans-serif;
        }

        .rtl table {
            text-align: {{ config('app.locale') == 'ar'? 'left': 'right' }};
        }

        .rtl table tr td {
            text-align: {{ config('app.locale') == 'ar'? 'left': 'right' }};
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>


</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{asset('imgs/store.png')}}" style="width:100%; max-width:300px;">
                            </td>

                            <td>
                                {{ __('invoice.invoice_number') }} #: {{ $invoice->invoice_number }}<br>
                                {{ __('invoice.invoice_date') }}: {{ $invoice->invoice_date }}<br>
                                {{ __('invoice.total_due') }}: {{ $invoice->total_due }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                                {{ $invoice->customer_name }}<br>
                                {{ $invoice->customer_email }}<br>
                                {{ $invoice->customer_mobile }}
                            </td>

                            <td>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td style="width: 30px"></td>
                <td >{{ __('invoice.product-name') }}</td>
                <td style="width: 80px">{{ __('invoice.unit') }}</td>
                <td style="width: 80px">{{ __('invoice.quantity') }}</td>
                <td style="width: 80px">{{ __('invoice.unit-price') }}</td>
                <td style="width: 120px">{{ __('invoice.subtotal') }}</td>
            </tr>

            @foreach ($invoice->details as $key => $details)
            <tr class="item" >
                <td>{{ $loop->iteration }}</td>
                <td>{{ $details->product_name }}</td>
                <td>{{ __('invoice.' . $details->unit) }}</td>
                <td>{{ $details->quantity }}</td>
                <td>{{ $details->unit_price }}</td>
                <td>{{ $details->row_sub_total }}</td>
            </tr>
            @endforeach



            <tr class="total">
                <td colspan="3"></td>
                <td colspan="2">{{ __('invoice.subtotal') }}</td>
                <td colspan="">{{ $invoice->details()->subTotal() }}</td>
            </tr>
            <tr class="total">
                <td colspan="3"></td>
                <td colspan="2">{{ __('invoice.discount') }}</td>
                <td colspan="">
                    <div >
                        {{ __('invoice.' . $invoice->discount_type) }}
                        {{ $invoice->discount_value }}
                    </div>
                </td>
            </tr>
            <tr class="total">
                <td colspan="3"></td>
                <td colspan="2">{{ __('invoice.vat') }} (5%)</td>
                <td colspan="">
                    {{ $invoice->vat_value }}
                </td>
            </tr>
            <tr class="total">
                <td colspan="3"></td>
                <td colspan="2">{{ __('invoice.shipping') }}</td>
                <td colspan="">{{ $invoice->shipping }}</td>
            </tr>
            <tr class="total">
                <td colspan="3"></td>
                <td colspan="2">{{ __('invoice.total_due') }}</td>
                <td colspan="">{{ $invoice->total_due }}</td>
            </tr>

        </table>
    </div>
</body>
</html>
