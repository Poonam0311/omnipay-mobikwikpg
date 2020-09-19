<?php

namespace Omnipay\Mobikwikpg;

use Mobikwikpg\Configuration;
use Mobikwikpg\Gateway as MobikwikGateway;
use Mobikwikpg\WebhookNotification;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Http\ClientInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
/**
 * Mobikwikpg Gateway.
 */
class Gateway extends AbstractGateway
{
    /**
     * @var MobikwikGateway
     */
    protected $mobikwikpg;

    /**
     * Create a new gateway instance.
     *
     * @param ClientInterface  $httpClient  A Guzzle client to make API calls with
     * @param HttpRequest      $httpRequest A Symfony HTTP request object
     * @param MobikwikGateway $mobikwikpg   The Mobikwikpg gateway
     */
    public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null, MobikwikGateway $mobikwikpg = null)
    {
        $this->mobikwikpg = $mobikwikpg ?: Configuration::gateway();

        parent::__construct($httpClient, $httpRequest);
    }

    /**
     * {@inheritdoc}
     */
    protected function createRequest($class, array $parameters)
    {
        $obj = new $class($this->httpClient, $this->httpRequest, $this->mobikwikpg);

        return $obj->initialize(array_replace($this->getParameters(), $parameters));
    }

    public function getName()
    {
        return 'Mobikwikpg';
    }

    public function getDefaultParameters()
    {
        return [];
    }

    /**
     * @param array $parameters
     *
     * @return Message\PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        print("kl");
        return $this->createRequest('\Omnipay\Mobikwikpg\Message\PurchaseRequest', $parameters);
    }  

    /**
     * @param array $parameters
     *
     * @return Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        
        return $this->createRequest('\Omnipay\Mobikwikpg\Message\CompletePurchaseRequest', $parameters);
    }
     
}
