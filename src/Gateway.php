<?php

namespace Omnipay\Mobikwikpg;


use Omnipay\Common\AbstractGateway;

/**
 * Mobikwikpg Gateway.
 */
class Gateway extends AbstractGateway
{
 
    /**
     * {@inheritdoc}
     */

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
        return $this->createRequest('Omnipay\Mobikwikpg\Message\PurchaseRequest', $parameters);
    }  

    /**
     * @param array $parameters
     *
     * @return Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        
        return $this->createRequest('Omnipay\Mobikwikpg\Message\CompletePurchaseRequest', $parameters);
    }
     
}
