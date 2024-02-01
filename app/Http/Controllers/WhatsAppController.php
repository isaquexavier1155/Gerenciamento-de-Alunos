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
            "message" => "Boa Tarde enviado via PHP%SendFile%%Url%https://sitesdriversoft.com.br/Gerenciamento-de-Alunos/public/img/logo-sitesdriversoft.jpg%/Url%%/SendFile%",
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