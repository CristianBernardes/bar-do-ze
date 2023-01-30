@extends('template')

@section('content')
    <div class="col-12">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Produtos Cadastrados</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Preço</th>
                        </tr>
                    </thead>
                    <tbody id="products">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script src="{{ url('assets/js/site/product.js') }}"></script>
@endpush
