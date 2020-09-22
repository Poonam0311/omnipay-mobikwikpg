<?php
namespace Omnipay\Mobikwikpg\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class CompletePurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $parameters = $this->httpRequest->request->all();            
        return $parameters; 
    }

    public static function verifyChecksum($checksum, $all, $secret) {
        $hash = hash_hmac('sha256', $all , $secret);
        $bool = 0;
        if($hash == $checksum)	{
            $bool = 1;
        }
        
        return $bool;
    }

    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $resp = [];
        $all = "";
        $checksumsequence = array("amount","bank","bankid","cardId",
        "cardScheme","cardToken","cardhashid","doRedirect","orderId",
        "paymentMethod","paymentMode","responseCode","responseDescription",
        "productDescription","product1Description","product2Description",
        "product3Description","product4Description","pgTransId","pgTransTime");
        foreach($checksumsequence as $seqvalue)	{
            if(array_key_exists($seqvalue, $data))	{
                
                $all .= $seqvalue;
                $all .="=";
                $all .= $data[$seqvalue];
                $all .= "&";
            }
        }
        
        $status = self::verifyChecksum($data['checksum'], $all, $data['secret']);
        if (isset($data['responseCode']) && $data['responseCode']=="100" && $status) {
             $resp['success'] = true;
        }
            
            
        return new Response($resp);
    }

}
