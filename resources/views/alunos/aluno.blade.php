@extends('layouts.main')

@section('title', 'Lista de Alunos')

@section('content')
    <div class="container">
        <h1>Lista de Alunos</h1>

        <div class="accordion" id="alunosAccordion">
            @foreach($alunos as $aluno)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $aluno->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $aluno->id }}" aria-expanded="true" aria-controls="collapse{{ $aluno->id }}">
                            <span>
                                {{ $aluno->nome }}
                                @if ($aluno->status_pagamento == 'pendente')
                                    <span class="badge bg-warning">Pendente</span>
                                @elseif ($aluno->status_pagamento == 'pago')
                                    <span class="badge bg-success">Pago</span>
                                @else
                                    <span class="badge bg-secondary">Desconhecido</span>
                                @endif
                            </span>
                        </button>
                    </h2>
                    <div id="collapse{{ $aluno->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $aluno->id }}" data-bs-parent="#alunosAccordion">
                        <div class="accordion-body">
                            <p><strong>Email:</strong> {{ $aluno->email }}</p>
                            <p><strong>Telefone:</strong> {{ $aluno->telefone }}</p>
                            <p><strong>Cidade:</strong> {{ $aluno->cidade }}</p>
                            <p><strong>Dia da Aula:</strong> {{ $aluno->dia_aula }}</p>
                            <p><strong>Horário da Aula:</strong> {{ $aluno->horario_aula }}</p>
                            <p><strong>Dia pagamento (mensal):</strong> {{ $aluno->data_pagamento }}</p>
                            <p><strong>Status de Pagamento:</strong> {{ $aluno->status_pagamento }}</p>

                            <div class="btn-group" role="group" aria-label="Botões de Ação">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $aluno->id }}">Editar</button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $aluno->id }}">Excluir</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para Edição -->
                <div class="modal fade" id="editModal{{ $aluno->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $aluno->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $aluno->id }}">Editar Aluno: {{ $aluno->nome }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulário de Edição -->
                                <form action="{{ route('alunos.update', $aluno->id) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <!-- Campos do formulário -->
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome:</label>
                                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $aluno->nome }}" required>
                                    </div>

                                    <!-- Adicione os outros campos do formulário aqui -->

                                    <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de Confirmação para Exclusão -->
                <div class="modal fade" id="deleteModal{{ $aluno->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $aluno->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $aluno->id }}">Confirmar Exclusão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza de que deseja excluir o aluno {{ $aluno->nome }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('alunos.destroy', $aluno->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endsection
