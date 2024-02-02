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
            ["nome" => "Isaque", "phone" => "+5551997726349", "pixKey" => "00020101021226830014br.gov.bcb.pix2561qrcodespix.sejaefi.com.br/v2/1b9075c3f59443ddab18f92734eb369852040000530398654041.005802BR5919Isaque600962080504txid63043C53"],
           //["nome" => "Heidy", "phone" => "+5551985172060", "pixKey" => "00020101021226830014br.gov.bcb.pix2561qrcodespix.sejaefi.com.br/v2/1b9075c3f59443ddab18f92734eb369852040000530398654041.005802BR5919Heidy600962080504txid63043C53"],
            //["nome" => "Sites Driver Soft", "phone" => "+5551999006797", "pixKey" => "00020101021226830014br.gov.bcb.pix2561qrcodespix.sejaefi.com.br/v2/1b9075c3f59443ddab18f92734eb369852040000530398654041.005802BR5919Sites Driver Soft6009SAO PAULO62080504txid63043C53"],
            // Adicione mais alunos conforme necessário
        ];

        $client = new Client();

        foreach ($alunos as $aluno) {
            // Mensagem principal sem a chave PIX
            $mainMessage = "$aluno[nome],
                Queremos lembrá-lo sobre o pagamento da mensalidade da escola de música, que está atualmente em atraso.
                É de extrema importância manter os pagamentos em dia para garantir benefícios exclusivos.
                Pedimos que, por favor, regularize seu pagamento o mais breve possível.
                Agradecemos pela sua atenção e colaboração.
                Segue abaixo QRCODE e código PIX para efetuar o pagamento: 
                %SendFile%%Url%https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Codigo_QR.svg/1024px-Codigo_QR.svg.png%/Url%%/SendFile%";

            // Enviar mensagem principal
            $this->enviarMensagem($apiUrl, $client, $clientApi, $clientSecret, $aluno["phone"], $mainMessage);

            // Mensagem separada com a chave PIX
            $pixMessage = "$aluno[pixKey]";

            // Enviar mensagem PIX
            $this->enviarMensagem($apiUrl, $client, $clientApi, $clientSecret, $aluno["phone"], $pixMessage);
        }
    }

    private function enviarMensagem($apiUrl, $client, $clientApi, $clientSecret, $phone, $message)
    {
        $messageTemplate = [
            "clientApi" => $clientApi,
            "clientSecret" => $clientSecret,
            "phone" => $phone,
            "message" => $message,
        ];

        try {
            $response = $client->post($apiUrl, [
                'json' => $messageTemplate,
            ]);

            if ($response->getStatusCode() == 200) {
                echo "Mensagem enviada para $phone\n";
            } else {
                echo "Falha ao enviar mensagem para $phone. Código de status: " . $response->getStatusCode() . "\n";
            }
        } catch (\Exception $e) {
            echo "Erro ao enviar mensagem para $phone. Mensagem de erro: " . $e->getMessage() . "\n";
        }
    }
}

