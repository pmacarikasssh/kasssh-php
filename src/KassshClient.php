<?php

namespace Kasssh\Payment;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Kasssh\Payment\Exceptions\HttpMethodNotSupported;
use Kasssh\Payment\Exceptions\InvalidApiResponse;
use Kasssh\Payment\Exceptions\InvalidConfig;
use Kasssh\Payment\Exceptions\InvalidResource;
use Kasssh\Payment\Http\Resources\Charge;
use Kasssh\Payment\Http\Resources\Customer;
use Kasssh\Payment\Http\Resources\Store;

/**
 * @method static Charge charge()
 * @method static Customer customer()
 * @method static Store store()
 */
class KassshClient
{
    private static $instance = null;
    private $client;
    private static $availableResources = [
        'charge' => Charge::class,
        'customer' => Customer::class,
        'store' => Store::class,
    ];
    private string $baseUrl;

    private string $key;
    private string $storeId;

    public function __construct(string $key, string $storeId = null, $baseUrl = null)
    {
        $this->baseUrl = $baseUrl ?? 'https://api.kasssh.com/api/';
        $this->key = $key;
        $this->storeId = $storeId;
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => $this->getHeaders(),
        ]);
    }

    public function request(string $method, string $url, ?array $parameters = [])
    {
        if (!in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
            throw new HttpMethodNotSupported("$method not supported");
        }

        $parameters = array_merge([
            'key' => $this->key,
            'store_id' => $this->storeId,
        ], $parameters);

        try{
            $response = $this->client->request($method, $url, $parameters);
        } catch(ClientException $e) {
            throw new InvalidApiResponse($e->getMessage(),$e->getRequest(), $e->getResponse());
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function getHeaders()
    {
        return [
            'X-Store-Key' =>  $this->key,
            'X-Store-Id' =>  $this->storeId,
        ];
    }

    public static function config(string $key, string $storeId)
    {
        self::$instance = new static($key, $storeId);
        return self::$instance;
    }

    protected static function resource($resource)
    {
        if (!array_key_exists($resource, self::$availableResources)) {
            throw new InvalidResource();
        }

        if (!self::$instance) {
            throw new InvalidConfig('Configure client before accessing resource');
        }

        return new static::$availableResources[$resource](self::$instance);

    }

    public static function __callStatic(string $name, array $arguments)
    {
        if (array_key_exists($name, self::$availableResources)) {
            return static::resource($name, ...$arguments);
        }

        throw new \BadMethodCallException("Method $name not defined on " . static::class);
    }

    public function getStoreId()
    {
        return $this->storeId;
    }

}
