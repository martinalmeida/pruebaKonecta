@extends('layout.constructor')

@section('title')
    Konecta - Inicio
@endsection

@section('head')
    <x-header title="Inicio">
    </x-header>
@endsection

@section('content')
    <x-card lg="9" xl="9">
        <div class="col-12">
            <div class="d-flex flex-column align-items-center justify-content-center p-4">
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_tic6wso3.json" background="transparent"
                    speed="1" style="width: 250px; height: 250px;" loop autoplay></lottie-player>
                <h5 class="mb-0 fw-700 text-center mt-3">
                    Bienvenido a Konecta {{ auth()->user()->name }}
                </h5>
            </div>
        </div>
    </x-card>

    <x-card lg="3" xl="3">
        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
            <div class='icon-stack display-3 flex-shrink-0'>
                <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                <i class="fas fa-graduation-cap icon-stack-1x opacity-100 color-primary-500"></i>
            </div>
            <div class="ml-3">
                <strong>
                    Calificaciones
                </strong>
                <br>
                Califica y deja tus comentarios en nuestras redes.
            </div>
        </a>
    </x-card>
@endsection

@section('subName')
    Pagina de Inicio
@endsection

@section('script')
    <script></script>
@endsection
