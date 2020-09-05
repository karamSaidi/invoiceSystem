@extends('layouts.invoice')

@section('title')

@endsection

@section('content')

    <div class="card">
        <div class="card-title p-2 bg-dark text-white">
            <span>{{ __('invoice.invoice-system') }}</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table card-table">
                    <thead>
                        <tr>
                            <th>{{ __('invoice.customer_name') }}</th>
                            <th>{{ __('invoice.invoice_date') }}</th>
                            <th>{{ __('invoice.total_due') }}</th>
                            <th>{{ __('invoice.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->customer_name }}</td>
                                <td>{{ $invoice->invoice_date }}</td>
                                <td>{{ $invoice->total_due }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('invoice.show', $invoice->id) }}" class="btn btn-sm btn-info mx-1">{{ __('invoice.show') }}</a>
                                        <a href="{{ route('invoice.edit', $invoice->id) }}" class="btn btn-sm btn-success mx-1">{{ __('invoice.edit') }}</a>
                                        <a href="#" class="btn btn-sm btn-danger mx-1">{{ __('invoice.delete') }}</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="d-flex justify-content-center">
                                    {!! $invoices->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection


