<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunoController extends Controller
{
    public function alunos()
    {
        $alunos = Aluno::all(); // Você pode ajustar isso conforme necessário
        return view('alunos.aluno', compact('alunos'));
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        // $request->validate([
        //     'nome' => 'required|string|max:255',
        //     'email' => 'required|email|unique:alunos,email',
        //     'telefone' => 'required|string|max:20',
        //     'cidade' => 'required|string|max:255',
        //     'dia_aula' => 'required|string|max:255',
        //     'horario_aula' => 'required|string|max:255',
        //     'data_pagamento' => 'required|date',
        //     'status_pagamento' => 'required|in:pendente,pago',
        // ]);
    
        // Criação de um novo aluno com base nos dados do formulário
        $aluno = new Aluno([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'cidade' => $request->input('cidade'),
            'dia_aula' => $request->input('dia_aula'),
            'horario_aula' => $request->input('horario_aula'),
            'data_pagamento' => $request->input('data_pagamento'),
            'status_pagamento' => $request->input('status_pagamento'),
        ]);
    
        // Salva o aluno no banco de dados
        $aluno->save();
    
        // Redireciona de volta à página de listagem de alunos (ou qualquer outra página desejada)
        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }
    

    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.edit', compact('aluno'));
    }


    public function update(Request $request, $id)
    {
        // Valide os dados do formulário conforme necessário
    
        // Encontre o aluno pelo ID
        $aluno = Aluno::find($id);
    
        // Atribua os novos valores aos campos do aluno
        $aluno->nome = $request->input('nome');
        $aluno->email = $request->input('email');
        $aluno->telefone = $request->input('telefone');
        $aluno->cidade = $request->input('cidade');
        $aluno->dia_aula = $request->input('dia_aula');
        $aluno->horario_aula = $request->input('horario_aula');
        $aluno->data_pagamento = $request->input('data_pagamento');
        $aluno->status_pagamento = $request->input('status_pagamento');
        // Adicione outros campos conforme necessário
    
        // Salve as modificações
        $aluno->save();

                ////////////////////////////////////////////////INICIO INTEGRAÇÃO WHATSAPP
                //Preciso estar com o número do whatsapp ativo para darcerto
                // $curl = curl_init();

                // curl_setopt_array($curl, array(
                // CURLOPT_URL => "https://api.positus.global/v2/sandbox/whatsapp/numbers/814e1f43-af0b-4ecb-a3ee-719c3481fabf/messages",
                // CURLOPT_RETURNTRANSFER => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                // CURLOPT_TIMEOUT => 0,
                // CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => "POST",
                // CURLOPT_POSTFIELDS =>"{\r\n  \"to\": \"+5551997726349\",\r\n  \"type\": \"text\",\r\n  \"text\": {\r\n      \"body\": \"Mensagem de Teste php\"\r\n  }\r\n}",
                // CURLOPT_HTTPHEADER => array(
                //     "Content-Type: application/json",
                //     "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNWY4NzVlOTExNjliMjM4MWVhOTg5Njc3NzM1NmM1M2Q0OWVjZDM0NzFiMWQzZGYzZjNhMTQzODZmODg3M2RiZDUwYzIxYzQ0MDc5ZGZmYTkiLCJpYXQiOjE3MDU0OTI1NjQuMjk2MDM2LCJuYmYiOjE3MDU0OTI1NjQuMjk2MDM5LCJleHAiOjE3MzcxMTQ5NjQuMjk0MzUxLCJzdWIiOiIzMjIwMiIsInNjb3BlcyI6W119.EBPgD3PgRMawZ6y1SSrEQQyqlDJlErG70BPrKY8Vnu4NEv0EOrcIsRDIoLMYliqTzytQQqM5_qO5aavQzwe_gumF3z-MtXzQibSbfYoO3Aw4wsYROWZb3KvjGZ8pIxEaPWakMYn8vT0UbPaIzO220DyKFTSGh0tIV68NDoHPiDn2f9F58AGOz5q8UtMaB9_9IKy4gp4AbvtYW9YXNKU10_S8JNqnu5lMrS2dCQp28QWnR2Pb1MlyhO19DkaONU9fJqpvfNmjL6ixhIwTkSXh88YYxGU7Ceuh7LiIFRp9OVGevK_yJ3xmjw29eNGKFX4rZmg-vLIV582CeJHjON_r94G5KfXf88P5gUizyaDFkvzjj_PPm8ivcmXXdk8nQNJIEEKFuQCsyQ9eNwNiWVTO-n1JIk0kvJ6uCRTWHCmaXium3Y4D62Qnm54s0HNc5mGeA6-iG1vjivUCJ9VDqW9nMFqTYHAfqq0Lu7md6Rge3zaXJPAWa5Q5j-vygap_Y96EV5ddhOBhAqHB7zeQ3sbQw2v4OwJ8EpPEBi0E3u9zh_qlTGZxDiPVEfupufKOm_iBf8cqrLXaCG3bN8tbNB9eLGtCUHabg3xkdfLNxb4TnxS1R45AQ0g9t6xQ8HWYcHdM6M9_atmsGx6RUj8Q5ZZJWIik1H-Hjq9gv5qcQFs8460"
                // ),
                // ));
        
                // $response = curl_exec($curl);
        
                // curl_close($curl);
                // echo $response;

                //dd($response);
                ////////////////////////////////////////////////FIM INTEGRAÇÃO WHATSAPP
    
        // Redirecione de volta para a página de detalhes ou para onde desejar
        return redirect()->route('alunos.index')->with('success', 'Modificações salvas com sucesso!');
    }
    

    public function delete($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.delete', compact('aluno'));
    }

    public function destroy($id)
    {
        // Encontre o aluno pelo ID
        $aluno = Aluno::find($id);
    
        if (!$aluno) {
            // Se o aluno não for encontrado, redirecione ou retorne uma resposta apropriada
            return redirect()->route('alunos.index')->with('error', 'Aluno não encontrado');
        }
    
        // Exclua o aluno
        $aluno->delete();
    
        // Redirecione para a página de alunos com uma mensagem de sucesso
        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso');
    }

    public function valeapena(){
        return view('valeapena');
    }
}
