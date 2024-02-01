<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WhatsAppController extends Controller
{
    public function enviarMensagens()
    {
        $apiUrl = "https://myhs.app/messages/sendMessage";
        $clientApi = "api-1du2bcc52ktmgtp4546d";
        $clientSecret = "744685942";

        // Lista de alunos com seus números de telefone
        $alunos = [
            ["nome" => "Isaque", "phone" => "+5551997726349", "pixKey" => "00020101021226830014br.gov.bcb.pix2561qrcodespix.sejaefi.com.br/v2/1b9075c3f59443ddab18f92734eb369852040000530398654041.005802BR5919Isaque6009SAO PAULO62080504txid63043C53"],
            ["nome" => "Ana Caroline", "phone" => "+5551980388229", "pixKey" => "00020101021226830014br.gov.bcb.pix2561qrcodespix.sejaefi.com.br/v2/1b9075c3f59443ddab18f92734eb369852040000530398654041.005802BR5919Ana Caroline6009SAO PAULO62080504txid63043C53"],
            // Adicione mais alunos conforme necessário
        ];

        $client = new Client();

        foreach ($alunos as $aluno) {
            $messageTemplate = [
                "clientApi" => $clientApi,
                "clientSecret" => $clientSecret,
                "phone" => $aluno["phone"],
                "message" => "$aluno[nome],
                    Queremos lembrá-lo sobre o pagamento da mensalidade da escola de música, que está atualmente em atraso.
                    É de extrema importância manter os pagamentos em dia para garantir benefícios exclusivos.
                    Pedimos que, por favor, regularize seu pagamento o mais breve possível.
                    Se precisar de qualquer assistência ou quiser discutir opções de pagamento, entre em contato conosco.
                    Agradecemos pela sua atenção e colaboração.
                    PIX copia e cola:

                    $aluno[pixKey]
                    <button onclick=\"copiarParaAreaTransferencia('$aluno[pixKey]')\">Copiar PIX</button>
                    %SendFile%%Url%https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Codigo_QR.svg/1024px-Codigo_QR.svg.png%/Url%%/SendFile%",
            ];

            try {
                $response = $client->post($apiUrl, [
                    'json' => $messageTemplate,
                ]);

                if ($response->getStatusCode() == 200) {
                    echo "Mensagem enviada para {$aluno['nome']} - {$aluno['phone']}\n";
                } else {
                    echo "Falha ao enviar mensagem para {$aluno['nome']} - {$aluno['phone']}. Código de status: " . $response->getStatusCode() . "\n";
                }
            } catch (\Exception $e) {
                echo "Erro ao enviar mensagem para {$aluno['nome']} - {$aluno['phone']}. Mensagem de erro: " . $e->getMessage() . "\n";
            }
        }
    }
}

