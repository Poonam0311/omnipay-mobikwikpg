<?php

namespace Omnipay\Mobikwikpg\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * CompletePurchaseResponse
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (isset($this->data['success'])) {
            return $this->data['success'];
        }

        return false;
    }

}
