<!-- resources/views/alunos/create.blade.php -->

@extends('layouts.main') <!-- Se você tiver um layout padrão, substitua 'app' pelo nome do seu layout -->

@section('title', 'Cadastrar Aluno')

@section('content')

    <!-- Conteudo Central -->
    <div class="conteudo-central">
        <div class="centralized-content2">
        </div>
    </div>
    <!-- Conteudo Central -->

    <div id="event-create-container" class="col-md-6 offset-md-3">

        <div class="container">
            <h1>Cadastrar Aluno</h1>
            <form action="{{ route('alunos.store') }}" method="post">
                @csrf

                <!-- Campos do formulário -->
                <div class="form-group">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="@gmail.com">
                </div>

                <div class="form-group">
                    <label for="telefone" class="form-label">Telefone:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="(51)99999-9999">
                </div>

                <div class="form-group">
                    <label for="cidade" class="form-label">Cidade:</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="Taquara">
                </div>

                <div class="form-group">
                    <label for="dia_aula" class="form-label">Dia da Aula:</label>
                    <input type="text" class="form-control" id="dia_aula" name="dia_aula" value="Sexta-feira" required>
                </div>

                <div class="form-group">
                    <label for="horario_aula" class="form-label">Horário da Aula:</label>
                    <input type="text" class="form-control" id="horario_aula" name="horario_aula" required>
                </div>

                <div class="form-group">
                    <label for="data_pagamento" class="form-label">Data de Pagamento:</label>
                    <input type="date" class="form-control" id="data_pagamento" name="data_pagamento" required>
                </div>

                <div class="form-group">
                    <label for="status_pagamento" class="form-label">Status de Pagamento:</label>
                    <select class="form-select" id="status_pagamento" name="status_pagamento" required>
                        <option value="pendente">Pendente</option>
                        <option value="pago">Pago</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </div>
    
@endsection
