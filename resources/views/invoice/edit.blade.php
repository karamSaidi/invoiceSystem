@extends('layouts.invoice')

@section('title')

@endsection

@section('content')

    <div class="card">
        <div class="card-title p-2 bg-dark text-white">
            <span>{{ __('invoice.invoice-edit') }}</span>
            <strong>{{ $invoice->customer_name }}</strong>
        </div>
        <div class="card-body">

            <form action="{{ route('invoice.update', $invoice->id) }}" method="post" id="invoice-form">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input type="text" name="customer_name"
                                value="{{ $invoice->customer_name }}"
                                placeholder="{{ __('invoice.customer_name') }}"
                                class="form-control @error('customer_name') is-invalid @endif">
                            @error('customer_name')
                            <small  class="text-muted text-danger">{{ $message }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input type="email" name="customer_email"
                                value="{{ $invoice->customer_email }}"
                                placeholder="{{ __('invoice.customer_email') }}"
                                class="form-control @error('customer_email') is-invalid @endif">
                            @error('customer_email')
                            <small  class="text-muted text-danger">{{ $message }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input type="text" name="customer_mobile"
                                value="{{ $invoice->customer_mobile }}"
                                placeholder="{{ __('invoice.customer_mobile') }}"
                                class="form-control @error('customer_mobile') is-invalid @endif">
                            @error('customer_mobile')
                            <small  class="text-muted text-danger">{{ $message }}</small>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input type="text" name="company_name"
                                value="{{ $invoice->company_name }}"
                                placeholder="{{ __('invoice.company_name') }}"
                                class="form-control @error('company_name') is-invalid @endif">
                            @error('company_name')
                            <small  class="text-muted text-danger">{{ $message }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input type="text" name="invoice_number"
                                value="{{ $invoice->invoice_number}}"
                                placeholder="{{ __('invoice.invoice_number') }}"
                                class="form-control @error('invoice_number') is-invalid @endif">
                            @error('invoice_number')
                            <small  class="text-muted text-danger">{{ $message }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input type="text" name="invoice_date"
                                value="{{ $invoice->invoice_date }}"
                                placeholder="{{ __('invoice.invoice_date') }}"
                                class="form-control datepicker @error('invoice_date') is-invalid @endif">
                            @error('invoice_date')
                            <small  class="text-muted text-danger">{{ $message }}</small>
                            @endif
                        </div>
                    </div>
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
                                <td><button type="button" class="btn btn-danger btn-delete btn-sm">{{ __('invoice.delete') }}</button></td>
                                <td>
                                    <input type="text" name="product_name[{{ $key }}]"
                                        value="{{ $details->product_name}}"
                                        placeholder="{{ __('invoice.product_name') }}"
                                        class="product_name form-control @error('product_name') is-invalid @endif">
                                    @error('product_name')
                                    <small  class="text-muted text-danger">{{ $message }}</small>
                                    @endif
                                </td>
                                <td>
                                    <select name="unit[{{ $key }}]"
                                        class="unit custom-select  @error('unit') is-invalid @endif">
                                        <option value="">{{ __('invoice.unit') }}</option>
                                        <option value="piece" {{ $details->unit == 'piece'? 'selected': '' }}>{{ __('invoice.piece') }}</option>
                                        <option value="g" {{ $details->unit == 'g'? 'selected': '' }}>{{ __('invoice.gram') }}</option>
                                        <option value="kg" {{ $details->unit == 'kg'? 'selected': '' }}>{{ __('invoice.kilo-gram') }}</option>
                                    </select>
                                    @error('unit')
                                    <small  class="text-muted text-danger">{{ $message }}</small>
                                    @endif
                                </td>
                                <td>
                                    <input type="number" step="1"  name="quantity[{{ $key }}]"
                                        value="{{ $details->quantity }}"
                                        placeholder="{{ __('invoice.quantity') }}"
                                        class="quantity form-control  @error('quantity') is-invalid @endif">
                                    @error('quantity')
                                    <small  class="text-muted text-danger">{{ $message }}</small>
                                    @endif
                                </td>
                                <td>
                                    <input type="number" step="0.01"  name="unit_price[{{ $key }}]"
                                        value="{{ $details->unit_price }}"
                                        placeholder="{{ __('invoice.unit_price') }}"
                                        class="unit_price form-control @error('unit_price') is-invalid @endif">
                                    @error('unit_price')
                                    <small  class="text-muted text-danger">{{ $message }}</small>
                                    @endif
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="row_sub_total[{{ $key }}]"
                                        value="{{ $details->row_sub_total }}"
                                        placeholder="{{ __('invoice.row_sub_total') }}" readonly="readonly"
                                        class="row_sub_total form-control  @error('row_sub_total') is-invalid @endif">
                                    @error('row_sub_total')
                                    <small  class="text-muted text-danger">{{ $message }}</small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <button type="button" class="btn-add-row btn btn-primary">{{ __('invoice.add_another_product') }}</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">{{ __('invoice.subtotal') }}</td>
                                <td colspan="">
                                    <input type="number" name="sub_total" id="sub_total"  class="sub_total form-control" readonly="readonly">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">{{ __('invoice.discount') }}</td>
                                <td colspan="">
                                   <div class="input-group mb-3">
                                       <select name="discount_type" id="discount_type" class="discount_type custom-select">
                                           <option value="fixed" {{ $invoice->discount_type == 'fixed'? 'selected':'' }}>{{ __('invoice.sr') }}</option>
                                           <option value="percentage" {{ $invoice->discount_type == 'percentage'? 'selected':'' }}>{{ __('invoice.percentage') }}</option>
                                       </select>
                                       <div class="input-grop-append">
                                           <input type="number" name="discount_value"
                                                value="{{ $invoice->discount_value }}"
                                                name="discount_value" class="discount_value form-control" step="0.01" >
                                       </div>
                                       <div class="input-grop-append">
                                           <input type="number" name="discount_final"  class="discount_final form-control" step="0.01" value="0.00" readonly="readonly">
                                       </div>
                                   </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">{{ __('invoice.vat') }} (5%)</td>
                                <td colspan="">
                                    <input type="number" name="vat_value"  class="vat_value form-control" step="0.01" value="0.00"  readonly="readonly">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">{{ __('invoice.shipping') }}</td>
                                <td colspan="">
                                    <input type="number" name="shipping"  class="shipping form-control" step="0.01"
                                        value="{{ $invoice->shipping }}" >
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">{{ __('invoice.total_due') }} (5%)</td>
                                <td colspan="">
                                    <input type="number" name="total_due" name="total_due" class="total_due form-control" step="0.01" value="0.00" readonly="readonly" >
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- end table-responsive -->

                <button type="submit" class="btn btn-success mt-3 ">{{ __('invoice.save') }}</button>

            </form>

        </div><!-- end card-body -->
    </div><!-- end card -->



@endsection

@push('script')
    <script>
        let row = `<tr class="coloning_row" id="0">
        <td><button type="button" class="btn btn-danger btn-delete btn-sm">{{ __('invoice.delete') }}</button></td>
        <td>
            <input type="text" name="product_name[]"  placeholder="{{ __('invoice.product_name') }}"
                class="product_name form-control @error('product_name') is-invalid @endif">
            @error('product_name')
            <small  class="text-muted text-danger">{{ $message }}</small>
            @endif
        </td>
        <td>
            <select name="unit[]" id="unit"
                class="unit custom-select  @error('unit') is-invalid @endif">
                <option value="">{{ __('invoice.unit') }}</option>
                <option value="piece">{{ __('invoice.piece') }}</option>
                <option value="g">{{ __('invoice.gram') }}</option>
                <option value="kg">{{ __('invoice.kilo-gram') }}</option>
            </select>
            @error('unit')
            <small  class="text-muted text-danger">{{ $message }}</small>
            @endif
        </td>
        <td>
            <input type="number" step="1" value="0" name="quantity[]" placeholder="{{ __('invoice.quantity') }}"
                class="quantity form-control  @error('quantity') is-invalid @endif">
            @error('quantity')
            <small  class="text-muted text-danger">{{ $message }}</small>
            @endif
        </td>
        <td>
            <input type="number" step="0.01" value="0.00" name="unit_price[]"  placeholder="{{ __('invoice.unit_price') }}"
                class="unit_price form-control @error('unit_price') is-invalid @endif">
            @error('unit_price')
            <small  class="text-muted text-danger">{{ $message }}</small>
            @endif
        </td>
        <td>
            <input type="number" step="0.01" name="row_sub_total[]"  placeholder="{{ __('invoice.row_sub_total') }}" readonly="readonly"
                class="row_sub_total form-control  @error('row_sub_total') is-invalid @endif">
            @error('row_sub_total')
            <small  class="text-muted text-danger">{{ $message }}</small>
            @endif
        </td>
    </tr>`;
    </script>
    <script src="{{ asset('js/invoice.js') }}"></script>
    {{-- form validation --}}
    {{-- <script src="{{ asset('js/form_validate/jquery.form.js') }}"></script> --}}
    <script src="{{ asset('js/form_validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/form_validate/additional-methods.min.js') }}"></script>

    {{-- pickDate --}}
    <script src="{{ asset('js/pickadate/picker.js') }}"></script>
    <script src="{{ asset('js/pickadate/picker.date.js') }}"></script>
    @if(app()->getLocale() == 'ar'))
    <script src="{{ asset('js/form_validate/messages_ar.js') }}"></script>
    <script src="{{ asset('js/pickadate/ar.js') }}"></script>
    @endif
    <script>
        $(document).ready(function () {

            $('.datepicker').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true,
                selectYears: true
            });

        });



         $('#invoice-form').on('submit', function(e){
             $('input.product_name').each(function(){$(this).rules("add", {required:true});});
                $('select.unit').each(function(){$(this).rules("add", {required:true});});
                $('input.quantity').each(function(){$(this).rules("add", {required:true, digits:true});});
                $('input.unit_price').each(function(){$(this).rules("add", {required:true, digits:true});});


                // e.preventDefault();
            });
            $('#invoice-form').validate({
                rules:{
                   'customer_name' : {required:true},
                   'customer_email' : {required:true, email:true},
                   'customer_mobile' : {required:true, digits:true, minlength:10, maxlength:15},
                   'company_name' : {required:true},
                   'invoice_number' : {required:true, digits:true},
                   'invoice_date' : {required:true}
                }
                // , submitHandler: function(form) {
                //         //    if ($('#invoice-form').valid())
                //                form.submit();
                //         //    return false; // prevent normal form posting
                //     }

            });

            SumTotal('.row_sub_total');
    </script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('css/pickadate/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pickadate/classic.date.css') }}">
    @if(app()->getLocale() == 'ar'))
    <link rel="stylesheet" href="{{ asset('css/pickadate/rtl.css') }}">
    @endif
    <style>
        label.error{color:red;}
    </style>
@endpush
