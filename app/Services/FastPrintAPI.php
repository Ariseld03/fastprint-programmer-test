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
    try{
        $response = $client->request('POST',
            'https://recruitment.fastprint.co.id/tes/api_tes_programmer',
            [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body' => http_build_query([
                    'username' => $username,
                    'password' => $password,
                ]),
                'http_errors' => false,
            ]
        );

            return json_decode($response->getBody(), true);
        }
        catch(\Exception $e){
            // dd('Error API Access', $e->getMessage());
            return [
                'error' => 1,
                'message' => $e->getMessage(),
            ];
        }
    $body=$response->getBody();
    // dd([
    //             'status_code'=>$response->getStatusCode(), 
    //             'response'=>$body
    //             ]);
    }
}
