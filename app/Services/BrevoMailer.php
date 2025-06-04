<?php

namespace App\Services;

// Import Brevo SDK and Guzzle
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use GuzzleHttp\Client;
use SendinBlue\Client\Model\SendSmtpEmail;

class BrevoMailer
{
    protected $apiInstance;

    public function __construct()
    {
        // brevo api key dari .env
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));

        // nanti sa cari tau ini apa artinya
        $this->apiInstance = new TransactionalEmailsApi(new Client(), $config);
    }

    /**
     * Send an email using Brevo's API
     *
     * @param string $toEmail Recipient's email
     * @param string $toName Recipient's name
     * @param string $subject Email subject
     * @param string $htmlContent HTML content of the email
     * @return mixed API response
     */
    public function sendEmail($toEmail, $toName, $subject, $htmlContent)
    {
        $sendSmtpEmail = new SendSmtpEmail([
            'subject' => $subject,
            'htmlContent' => $htmlContent,
            'sender' => [
                'name' => 'Sistem Informasi Gereja Katedral Merauke',
                'email' => 'juanmalau203@gmail.com' // Kalau mau ganti, harus pakai yang verified di brevo
            ],
            'to' => [
                [
                    'email' => $toEmail,
                    'name' => $toName
                ]
            ],
        ]);

        // Kirim email
        return $this->apiInstance->sendTransacEmail($sendSmtpEmail);
    }
}
