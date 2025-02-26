<?php
if(!function_exists('firebase_config'))
{
    function firebase_config(): array
    {
        if (file_exists(storage_path('app/private/firebase-auth.json'))) {
            return json_decode(file_get_contents(storage_path('app/private/firebase-auth.json')), true);
        }
        return [
                "apiKey" => '',
                "authDomain" => '',
                "project_id" => '',
                "storageBucket" => '',
                "messagingSenderId" => '',
                "appId" => '',
                'vapidKey' => ''
        ];
    }
}
