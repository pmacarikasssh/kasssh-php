<?php

namespace Kasssh\Payment\Http\Resources;

class Store extends Resource
{
    public function info()
    {
        $storeId = $this->client->getStoreId();
        return $this->client->request('get', "/api/store/{$storeId}/info");
    }

    public function setWebhook($webhookUrl)
    {
        return $this->client->request('patch', '/api/charge/delete', [
            'webhook_url' => $webhookUrl,
        ]);
    }

}

