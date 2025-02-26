<?php

namespace App\Services;

use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationService
{
    protected Messaging $messaging;
    public function __construct(protected CloudMessage $cloudMessage)
    {
        $this->messaging = app('firebase.messaging');
    }

    public function sendNotify(array $data, array $tokens): void
    {
        $message =$this->cloudMessage->withData($data);

        $this->messaging->sendMulticast($message, $tokens);
    }

}
