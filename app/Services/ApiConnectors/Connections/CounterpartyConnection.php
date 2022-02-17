<?php

namespace App\Services\ApiConnectors\Connections;

use App\Services\ApiConnectors\ApiConnector;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class CounterpartyConnection extends ApiConnector
{
    private string $defaultPrefix = 'api/v1';
    private string $unloadPrefix;

    public function __construct(string $service = 'counterparty')
    {
        $this->unloadPrefix = $this->defaultPrefix . '/data/unload';

        parent::__construct($service);
    }

    /**
     * @throws GuzzleException
     */
    public function getUnloadFilter(array $data = []): ResponseInterface
    {
        return $this->get($this->unloadPrefix . '/filter', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function getUnloadBuy(array $data = []): ResponseInterface
    {
        return $this->get($this->unloadPrefix . '/buy', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function getUnloadRegions(array $data = []): ResponseInterface
    {
        return $this->get($this->unloadPrefix . '/regions', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function getUnloadCompanySizes(array $data = []): ResponseInterface
    {
        return $this->get($this->unloadPrefix . '/company-sizes', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function getUnloadCounterpartyTypes(array $data = []): ResponseInterface
    {
        return $this->get($this->unloadPrefix . '/counterparty-types', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function getUnloadActivities(array $data = []): ResponseInterface
    {
        return $this->get($this->unloadPrefix . '/activities', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function getUnloadActivityCodes(array $data = []): ResponseInterface
    {
        return $this->get($this->unloadPrefix . '/activity/codes', $data);
    }

    /**
     * @throws GuzzleException
     */
    public function getUnloadRiskDegrees(array $data = []): ResponseInterface
    {
        return $this->get($this->unloadPrefix . '/risk-degrees', $data);
    }
}
