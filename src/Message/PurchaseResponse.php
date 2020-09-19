<?php

namespace Omnipay\Mobikwik\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
        public function isSuccessful()
        {
            return false;
        }

        public function isRedirect()
        {
            return true;
        }

        public function getRedirectUrl()
        {
            return $this->getRequest()->getReturnUrl();
        }
    
        public function getRedirectMethod()
        {
            return 'POST';
        }
    
        public function getRedirectData()
        {
            return $this->data;
        }
}