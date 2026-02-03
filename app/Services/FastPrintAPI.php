<?php

namespace App\Services;

class FastprintApi
{
    private function generateUsername(): string
    {
        $prefix = 'tesprogrammer';
        $date   = date('dmy'); // ddmmyy
        $hour   = date('H');   // 00 - 23

        return $prefix . $date . 'C' . $hour;
    }
    private function generatePasswordMd5(): string
    {
        date_default_timezone_set('Asia/Jakarta');
        $plainPassword =
            'bisacoding-' .
            date('d') . '-' .
            date('m') . '-' .
            date('y');

        return md5($plainPassword);
    }

    public function fetch()
    {
        $username = $this->generateUsername();
        $password = $this->generatePasswordMd5();

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post(
                'https://recruitment.fastprint.co.id/tes/api_tes_programmer',
                [
                    'form_params' => [
                        'username' => $username,
                        'password' => $password,
                    ],
                    'http_errors' => false, // jangan throw otomatis
                ]
            );

            return [
                'status'  => $response->getStatusCode(),
                'body'    => json_decode($response->getBody(), true),
                'headers' => $response->headers(),
                'cookies' => $response->getHeaderLine('Set-Cookie'),
            ];
        } catch (\Throwable $e) {
            return [
                'status'  => 500,
                'error'   => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
