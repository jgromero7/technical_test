@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-dark text-white">Buscar Personas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="form-search" class="form-inline">
                        <div class="form-group mx-sm-2 mb-2">
                            <label for="names" class="sr-only">Nombres y Apellidos</label>
                            <input type="text" class="form-control" id="names" name="names" placeholder="Nombres y Apellidos" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="percentage" class="sr-only">Porcentaje</label>
                            <input type="number" min="0" max="100" class="form-control" id="percentage" name="percentage" placeholder="Porcentaje" required>
                        </div>
                        <button id="search" type="submit" class="btn btn-primary mb-2">Buscar</button>
                        <div class="spinner-border loader text-primary mx-sm-2 mb-2 text-center" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre Buscado</th>
                        <th scope="col">Porcentaje Buscado</th>
                        <th scope="col">Nombre Encontrado</th>
                        <th scope="col">Porcentaje Encontrado</th>
                        <th scope="col">Tipo de Cargo</th>
                    </tr>
                </thead>
                <tbody class="bg-light"></tbody>
            </table> 
        </div>
        <div class="col-md-12">
            <a id="export-pdf" href="{{ route('export-pdf') }}" class="btn btn-success mb-2">{{ __('Exportar PDF') }}</a>
        </div>
    </div>

</div>
@endsection
