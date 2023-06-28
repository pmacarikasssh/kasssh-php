<?php

namespace Kasssh\Payment\Http\Resources;

class Customer extends Resource
{

    public function email($token)
    {
        return $this->client->request('post', '/api/customer/email', [
            'token' => $token,
        ]);
    }
    public function sms($token)
    {
        return $this->client->request('post', '/api/customer/sms', [
            'token' => $token,
        ]);
    }

}
