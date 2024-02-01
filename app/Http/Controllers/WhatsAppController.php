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

        // Lista de números de telefone
        $numbers = ["+5551997726349", "+5551980388229"];

        // Mensagem com placeholders para o número de telefone
        $messageTemplate = [
            "clientApi" => $clientApi,
            "clientSecret" => $clientSecret,
            "phone" => $numbers,
            "message" => "	Prezado  Aluno,
            Queremos lembrá-lo sobre o pagamento da mensalidade da escola de música, que está atualmente em atraso.
            É de extrema importância manter os pagamentos em dia para garantir beneficios exclusivos.
            Pedimos que, por favor, regularize seu pagamento o mais breve possível.
            Se precisar de qualquer assistência ou quiser discutir opções de pagamento, entre em contato conosco.
            Agradecemos pela sua atenção e colaboração.
            PIX copia e cola: 
        
        00020101021226830014br.gov.bcb.pix2561qrcodespix.sejaefi.com.br/v2/1b9075c3f59443ddab18f92734eb369852040000530398654041.005802BR5919João Paulo da Silva6009SAO PAULO62080504txid63043C53
        %SendFile%%Url%https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Codigo_QR.svg/1024px-Codigo_QR.svg.png%/Url%%/SendFile%",
        ];

        $client = new Client();

        // Enviar para cada número
        foreach ($numbers as $number) {
            $messageTemplate["phone"] = $number;

            try {
                $response = $client->post($apiUrl, [
                    'json' => $messageTemplate,
                ]);

                if ($response->getStatusCode() == 200) {
                    echo "Mensagem enviada para $number\n";
                } else {
                    echo "Falha ao enviar mensagem para $number. Código de status: " . $response->getStatusCode() . "\n";
                }
            } catch (\Exception $e) {
                echo "Erro ao enviar mensagem para $number. Mensagem de erro: " . $e->getMessage() . "\n";
            }
        }
    }
}