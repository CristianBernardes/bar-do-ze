@extends('template')

@section('content')
    <div class="col-12">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Vendas Realizadas</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Identificação</th>
                            <th scope="col">Método de pagamento</th>
                            <th scope="col">Data da venda</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody id="sales">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script src="{{ url('assets/js/site/sale.js') }}"></script>
@endpush
