<?php

namespace Omnipay\Mobikwikpg\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Response
 */
class Response extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (isset($this->data->success)) {
            return $this->data->success;
        }

        return false;
    }

}
