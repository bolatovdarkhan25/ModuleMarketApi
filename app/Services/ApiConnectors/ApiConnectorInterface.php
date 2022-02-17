<?php

namespace App\Services\ApiConnectors;

use Psr\Http\Message\ResponseInterface;

interface ApiConnectorInterface
{
    public function get(string $url, array $params = [], array $headers = []): ResponseInterface;

    public function post(string $url, array $params = [], array $headers = []): ResponseInterface;

    public function put(string $url, array $data = [], array $headers = []): ResponseInterface;

    public function delete(string $url): ResponseInterface;

    public function requestMultipart(string $url, $multipart = null, string $type = 'post'): ResponseInterface;
}
