@extends('layouts.app')

@section('content')
    <x-back title="Cadastro de clientes" route="clients"></x-back>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('clients.store') }}" class="row">
                @csrf

                <h4>Dados da empresa</h4>
                <!-- cnpj -->
                <div class="col-md-4">
                    <label for="cnpj" class="form-label">{{ __('Cnpj') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('cnpj') is-invalid @enderror" name="cnpj"
                               id="cnpj" value="{{ old('cnpj') }}" maxlength="16">
                        <div class="input-group-append">
                            <button id="btnConsultarCnpj" class="btn btn-success" type="button"><i
                                    class="bi bi-search"></i></button>
                        </div>
                        @error('cnpj')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- corporate_name -->
                <div class="col-md-8">
                    <label for="name" class="form-label">{{ __('Corporate Name') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" id="name" value="{{ old('name') }}" maxlength="200">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h4 class="mt-3">Dados do Responsável</h4>

                <!-- responsible_name -->
                <div class="col-md-4">
                    <label for="responsible_name" class="form-label">{{ __('Responsible Name') }}</label>
                    <input type="text" class="form-control @error('responsible_name') is-invalid @enderror"
                           name="responsible_name" id="responsible_name" value="{{ old('responsible_name') }}"
                           maxlength="50">
                    @error('responsible_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- cell_phone -->
                <div class="col-md-4">
                    <label for="cell_phone" class="form-label">{{ __('Cell Phone') }}</label>
                    <input type="text" class="form-control @error('cell_phone') is-invalid @enderror" name="cell_phone"
                           id="cell_phone" value="{{ old('cell_phone') }}" maxlength="15">
                    @error('cell_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- email -->
                <div class="col-md-4">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                           id="email" value="{{ old('email') }}" maxlength="150">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h4 class="mt-3">Endereço da Empresa</h4>
                <!-- zip_code -->
                <div class="col-md-2">
                    <label for="zip_code" class="form-label">{{ __('Zip Code') }}</label>
                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code"
                           id="zip_code" value="{{ old('zip_code') }}" maxlength="8">
                    @error('zip_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- address -->
                <div class="col-md-4">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                           id="address" value="{{ old('address') }}" maxlength="200">
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- number -->
                <div class="col-md-2">
                    <label for="number" class="form-label">{{ __('Number') }}</label>
                    <input type="text" class="form-control @error('number') is-invalid @enderror" name="number"
                           id="number" value="{{ old('number') }}" maxlength="9">
                    @error('complement')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- complement -->
                <div class="col-md-4">
                    <label for="complement" class="form-label">{{ __('Complement') }}</label>
                    <input type="text" class="form-control @error('complement') is-invalid @enderror" name="complement"
                           id="complement" value="{{ old('complement') }}" maxlength="60">
                    @error('complement')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- neighborhood -->
                <div class="col-md-4 mt-3">
                    <label for="neighborhood" class="form-label">{{ __('Neighborhood') }}</label>
                    <input type="text" class="form-control @error('neighborhood') is-invalid @enderror"
                           name="neighborhood" id="neighborhood" value="{{ old('neighborhood') }}" maxlength="50">
                    @error('neighborhood')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- city -->
                <div class="col-md-4 mt-3">
                    <label for="city" class="form-label">{{ __('City') }}</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                           id="city" value="{{ old('city') }}" maxlength="25">
                    @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- state -->
                <div class="col-md-4 mt-3">
                    <label for="state" class="form-label">{{ __('State') }}</label>
                    <input type="text" class="form-control @error('state') is-invalid @enderror" name="state"
                           id="state" value="{{ old('state') }}" maxlength="2">
                    @error('state')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection



@push ('scripts')

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script type="text/javascript">

        var cnpjField = document.querySelector('#cnpj')
        var submitButton = document.querySelector('#btnConsultarCnpj')

        var corporate_name = document.querySelector('#name')
        var responsible_name = document.querySelector('#responsible_name')
        var cell_phone = document.querySelector('#cell_phone')
        var email = document.querySelector('#email')

        var zip_code = document.querySelector('#zip_code')
        var address = document.querySelector('#address')
        var number = document.querySelector('#number')

        var complement = document.querySelector('#complement')
        var neighborhood = document.querySelector('#neighborhood')
        var city = document.querySelector('#city')
        var state = document.querySelector('#state')

        submitButton.addEventListener('click', run)

        function clearFields() {
            corporate_name.value = ''
            responsible_name.value = ''
            cell_phone.value = ''
            email.value = ''
            zip_code.value = ''
            address.value = ''
            number.value = ''
            complement.value = ''
            neighborhood.value = ''
            city.value = ''
            state.value = ''
            cnpj.focus;
        }

        function run(event) {
            event.preventDefault();
            var cnpj = cnpjField.value;
            if (cnpj.length < 11) {
                alert('Cnpj deve conter 11 caracteres');
                clearFields();
                cnpjField.value = '';
                cnpjField.focus();
                return;
            }

            var url = "{{ route('clients.cnpj', ':cnpj') }}";
            url = url.replace(':cnpj', encodeURIComponent(cnpj));

            axios.get(url).then(function (response) {

                console.log(response.data)
                if (response.data.status == 'OK') {
                    corporate_name.value = response.data.nome
                    responsible_name.value = response.data.qsa[0].nome
                    cell_phone.value = response.data.telefone.replace(/\D/g, '');
                    email.value = response.data.email

                    zip_code.value = response.data.cep.replace(/\D/g, '');
                    address.value = response.data.logradouro
                    number.value = response.data.numero

                    complement.value = response.data.complemento
                    neighborhood.value = response.data.bairro
                    city.value = response.data.municipio
                    state.value = response.data.uf
                }

                if (response.data.status == 'ERROR') {
                    alert(response.data.message);
                    clearFields();
                }

            })
                .catch(function (error) {
                    alert('Tente novamente em um minuto!');
                })

        }
    </script>

@endpush
