<?php

namespace App\Services\ApiConnectors;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class ApiConnector implements ApiConnectorInterface
{
    protected Client $client;
    protected string $baseUrl;
    protected array $apiConfig;

    /**
     * API response
     *
     * @var mixed
     */
    protected mixed $response;

    public function __construct(string $service)
    {
        $this->apiConfig = config('api_modules.' . $service);
        $this->baseUrl = $this->apiConfig['base_url'];
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => $this->apiConfig['options']['headers'],
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $url, array $params = [], array $headers = []): ResponseInterface
    {
        return $this->client->get(
            $url, [
                'query' => $params,
                'headers' => $headers,
            ]
        );
    }

    /**
     * @throws GuzzleException
     */
    public function post(string $url, array $params = [], array $headers = []): ResponseInterface
    {
        return $this->client->post(
            $url, [
                'json' => $params,
                'headers' => $headers,
            ]
        );
    }

    /**
     * @throws GuzzleException
     */
    public function put(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->client->put(
            $url, [
                'json' => $data,
                'headers' => $headers,
            ]
        );
    }

    /**
     * @throws GuzzleException
     */
    public function delete(string $url, ?array $data = null): ResponseInterface
    {
        return $this->client->delete($url, $data);
    }

    public function requestMultipart(string $url, $multipart = null, string $type = 'post'): ResponseInterface
    {
        return $this->client->$type($url, $this->getHttpOptionMultipart($multipart));
    }

    protected function getHttpOption(?array $body = null): array
    {
        $result = $this->apiConfig['options'];

        if (!empty($body)) {
            $result['json'] = $body;
        }

        return $result;
    }

    /**
     * Get multipart options for request
     * Upload files, photo, doc
     */
    protected function getHttpOptionMultipart(mixed $multipart = null): array
    {
        $result = $this->apiConfig['options'];

        if (!empty($multipart)) {
            $result['multipart'] = $multipart;
        }

        return $result;
    }
}
