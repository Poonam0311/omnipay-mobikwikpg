<?php
namespace Omnipay\Mobikwikpg\Message;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
/**
 * Authorize Request
 *
 * @method Response send()
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [
            'amount' => $this->getAmount(),
            'buyerEmail' => $this->getBuyerEmail() ,
            'merchantIdentifier' => $this->getMerchantIdentifier(),
            'merchantIpAddress' => $this->getMerchantIpAddress(),
            'mode' => $this->getMode(),
            'orderId' => $this->getOrderId(),
            'txnType' => $this->getTxnType(),
            'currency' => $this->getCurrency(),
            'returnUrl' => $this->getReturnUrl()
        ];

        // special validation
        if ($this->getChecksum()) {
            $data['checksum'] = $this->getChecksum();
        } else {
            throw new InvalidRequestException('The checksum field should be set.');
        }

        return $data;

        return $data;
    }
    
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    public function getMerchantIdentifier()
    {
        return $this->getParameter('merchantIdentifier');
    }

    public function setMerchantIdentifier($value)
    {
        return $this->setParameter('merchantIdentifier', $value);
    }

    public function getMerchantSecret()
    {
        return $this->getParameter('merchantSecret');
    }

    public function setMerchantSecret($value)
    {
        return $this->setParameter('merchantSecret', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getBuyerEmail()
    {
        return $this->getParameter('buyerEmail');
    }

    public function setBuyerEmail($value)
    {
        return $this->setParameter('buyerEmail', $value);
    }

    public function getMerchantIpAddress()
    {
        return $this->getParameter('merchantIpAddress');
    }

    public function setMerchantIpAddress($value)
    {
        return $this->setParameter('merchantIpAddress', $value);
    }

    public function getMode()
    {
        return $this->getParameter('mode');
    }

    public function setMode($value)
    {
        return $this->setParameter('mode', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    public function getTxnType()
    {
        return $this->getParameter('txnType');
    }

    public function setTxnType($value)
    {
        return $this->setParameter('txnType', $value);
    }

    public function getChecksum()
    {
        $str = "amount="+$this->getAmount()+
        "buyerEmail="+$this->getBuyerEmail()+
        "currency="+$this->getCurrency()+
        "merchantIdentifier="+$this->getMerchantIdentifier()+
        "merchantIpAddress="+$this->getMerchantIpAddress()+
        "mode="+$this->getMode()+
        "orderId="+$this->getOrderId()+
        "returnUrl="+$this->getReturnUrl()+
        "txnType="+$this->getTxnType();
        $value = hash_hmac("sha256", $str, $this->getMerchantSecret());
        $this->setParameter('checksum', $value);
        return $this->getParameter('checksum');
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function setCurency($value)
    {
        return $this->setParameter('currency', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

}
