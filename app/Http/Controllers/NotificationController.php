<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(protected NotificationService $notificationService)
    {}

    public function show()
    {
        return view('notification.show');
    }

    public function send(Request $request)
    {
        $params = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'click_action' => 'nullable'
        ]);

        $tokens = User::query()->whereNotNull('fcm_token')->select(['fcm_token'])->get()->pluck('fcm_token')->toArray();
        $data = [
            'title' => $params['title'],
            'body' => $params['body'],
            'click_action' => $params['click_action'] ?? null
        ];

        $this->notificationService->sendNotify($data, $tokens);

        return redirect()->route('notification.show');
    }
}
