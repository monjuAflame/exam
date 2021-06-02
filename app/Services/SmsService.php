<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class SmsService
{

    /* 
        supply $contents according to the following format:
            $contents = [
                'contact_number' => 'message to be sent',
                '01819400400' => 'Hello Nobody, you ranked 1st in the last exam. Cheers!',
            ];
            then call like this: SmsService::sendSms($contents);

    */
    public static function sendSms(array $contents)
    {
        $contents = static::prepareSmsData($contents);

        if (count($contents) > 0) {
            $params = static::preparePostRequestParams($contents);
            $url = static::getSmsUrl();

            logger("Sending request to: {$url}");
            logger("with the payload: " . json_encode($params));

            $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ])->post($url, $params);            
            
            if ($response->successful()) {
                $body = $response->body();
                logger($body);
                return json_decode($body);
            } else {
                logger($response->status());
                return false;
            }
                    
        } else {
            return false;
        }

    }


    private static function prepareSmsData($contents)
    {
        $data = [];
        foreach ($contents as $number => $content) {
            array_push($data, [
                'to' => $number,
                'message' => $content,
                'type' => 'text',
            ]);
        }

        return $data;
    }

    private static function preparePostRequestParams($payload)
    {
        return [
            'api_key' => env('SMS_API_KEY'),
            'messages' => $payload,
        ];
    }

    private static function getSmsUrl()
    {
        return env('SMS_API_ENDPOINT');
    }

}
