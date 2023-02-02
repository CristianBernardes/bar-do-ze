@extends('template')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Vendas do dia</p>
                        <h6 class="mb-0">{{ $salesOfTheDay }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Venda média por dia</p>
                        <h6 class="mb-0">{{ $averageSaleInTheMonth }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Vendas do mês</p>
                        <h6 class="mb-0">{{ $salesOfTheMonth }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Top Produtos mais vendidos</h6>
                    </div>
                    @foreach ($topSellingProducts as $topSellingProduct)
                        <div class="d-flex align-items-center border-bottom py-3">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">{{ $topSellingProduct->products_name }}</h6>
                                    <small>{{ $topSellingProduct->amount }} vendas</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Top Produtos menos vendidos</h6>
                    </div>
                    @foreach ($leastSoldProducts as $leastSoldProduct)
                        <div class="d-flex align-items-center border-bottom py-3">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">{{ $leastSoldProduct->products_name }}</h6>
                                    <small>{{ $leastSoldProduct->amount }} vendas</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Evolução das vendas do mês de {{ monthFullName(date('m')) }}</h6>
                    <canvas height="60" id="bar-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('chart-values')
    <script>
        const sumOfDaySales = {{ Js::from($sumOfDaySales) }};
    </script>
@endpush
