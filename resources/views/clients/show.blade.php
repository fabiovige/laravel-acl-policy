@extends('layouts.app')

@section('content')
    <x-back title="Informações do clientes" route="clients"></x-back>

    <div class="card">
        <div class="card-body">


            <h4>Dados da empresa</h4>
            <!-- cnpj -->
            <div class="col-md-4">
                <label for="cnpj" class="form-label">{{ __('Cnpj') }}</label><br>
                {{ $client->cnpj ?? old('cnpj') }}

            </div>

            <!-- corporate_name -->
            <div class="col-md-8">
                <label for="corporate_name" class="form-label">{{ __('Corporate Name') }}</label><br>
                {{ $client->corporate_name ?? old('corporate_name') }}

            </div>

            <h4 class="mt-3">Dados do Responsável</h4>

            <!-- responsible_name -->
            <div class="col-md-4">
                <label for="responsible_name" class="form-label">{{ __('Responsible Name') }}</label><br>
                {{ $client->responsible_name ?? old('responsible_name') }}

            </div>

            <!-- cell_phone -->
            <div class="col-md-4">
                <label for="cell_phone" class="form-label">{{ __('Cell Phone') }}</label><br>
                {{ $client->cell_phone ?? old('cell_phone') }}

            </div>

            <!-- email -->
            <div class="col-md-4">
                <label for="email" class="form-label">{{ __('Email') }}</label><br>
                {{ $client->email ?? old('email') }}

            </div>

            <h4 class="mt-3">Endereço da Empresa</h4>
            <!-- zip_code -->
            <div class="col-md-2">
                <label for="zip_code" class="form-label">{{ __('Zip Code') }}</label><br>
                {{ $client->zip_code ?? old('zip_code') }}

            </div>

            <!-- address -->
            <div class="col-md-4">
                <label for="address" class="form-label">{{ __('Address') }}</label><br>
                {{ $client->address ?? old('address') }}

            </div>

            <!-- number -->
            <div class="col-md-2">
                <label for="number" class="form-label">{{ __('Number') }}</label><br>
                {{ $client->number ?? old('number') }}

            </div>

            <!-- complement -->
            <div class="col-md-4">
                <label for="complement" class="form-label">{{ __('Complement') }}</label><br>
                {{ $client->complement ?? old('complement') }}

            </div>


            <!-- neighborhood -->
            <div class="col-md-4">
                <label for="neighborhood" class="form-label">{{ __('Neighborhood') }}</label><br>
                {{ $client->neighborhood ?? old('neighborhood') }}
            </div>

            <!-- city -->
            <div class="col-md-4">
                <label for="city" class="form-label">{{ __('City') }}</label><br>
                {{ $client->city ?? old('city') }}
            </div>

            <!-- state -->
            <div class="col-md-4">
                <label for="state" class="form-label">{{ __('State') }}</label><br>
                {{ $client->state ?? old('state') }}
            </div>


        </div>
    </div>
@endsection



@push ('scripts')


@endpush
