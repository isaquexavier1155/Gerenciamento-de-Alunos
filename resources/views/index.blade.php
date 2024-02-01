<!-- resources/views/index.blade.php -->
@extends('layouts.main')

@section('title', 'Página de Boas-Vindas')

@section('content')
    <!-- Adicione o código abaixo no início do seu conteúdo -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right mt-3">
                <img src="{{ asset('caminho/para/sua/imagem/logo-sitesdriversoft.jpg') }}" alt="Logo" class="img-fluid" style="max-height: 50px;">
            </div>
        </div>

        <!-- Conteudo Central -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="display-4">Seja bem-vindo!</h1>
                <p class="lead">Gerencie seus alunos de maneira eficiente.</p>
            </div>
        </div>

        <!-- Cards de Serviços -->
        <div class="row mt-5">
            <div class="col-md-12 text-center" style="z-index: -100;"> <!-- Adicione a classe mx-auto aqui -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Matrícula Simples</h5>
                        <p class="card-text">Realize matrículas de forma rápida e fácil, mantendo todos os dados dos alunos organizados.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3 text-center" style="z-index: -100;"> <!-- Adicione a classe mx-auto aqui -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gerenciamento de Pagamentos</h5>
                        <p class="card-text">Acompanhe o status de pagamento de todos os alunos.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3 text-center" style="z-index: -100;"> <!-- Adicione a classe mx-auto aqui -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Comunicação Eficiente</h5>
                        <p class="card-text">Mantenha alunos informados sobre próximas datas de pagamento.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim dos Cards de Serviços -->
    </div>
    <!-- Conteudo Central -->
@endsection
