<?php

namespace Kasssh\Payment\Http\Resources;

class Store extends Resource
{
    public function get($storeId)
    {
        return $this->client->request('get', "/api/store/{$storeId}/info");
    }

    public function setWebhook($webhookUrl)
    {
        return $this->client->request('patch', '/api/charge/delete', [
            'webhook_url' => $webhookUrl,
        ]);
    }

}

