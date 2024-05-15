@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Hello, {{ auth()->user()->name }}</h1>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    You are Logged In

                    <div class="row">
                        <div class="col-6">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Total User</h5>
                                <h1 class="card-subtitle mb-2 text-body-secondary">{{ $user }}</h1>
                            </div>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Total Transaksi</h5>
                                <h1 class="card-subtitle mb-2 text-body-secondary">10</h1>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="p-6 m-20 bg-white rounded shadow">
                        {!! $chart->container() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endsection