<?php

namespace Kasssh\Payment\Http\Resources;

class Charge extends Resource
{

    public function create($data)
    {
        return $this->client->request('post', '/api/charge/create', $data);
    }

    public function get($token)
    {
        return $this->client->request('post', '/api/charge/get', [
            'token' => $token,
        ]);
    }

    public function delete($token)
    {
        return $this->client->request('post', '/api/charge/delete', [
            'token' => $token,
        ]);
    }

}
