<?php
namespace Omnipay\FirstDataConnect\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * FirstDataConnect CompletePurchase Request
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * Get the raw data array for the message
     *
     * @return mixed
     */
    public function getData()
    {
        if ($this->getHash() != $this->getBankHash()) {
            throw new InvalidResponseException('Odpoveď z platobnej brány sa nepodarilo overiť. Prosím kontaktujte nás.');
        }

        return $this->httpRequest->request->all();
    }

    /**
     * Send the request with specified data
     *
     * @param mixed
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

    /**
     * Get hash for response
     *
     * @param string timestamp
     * @return string
     */
    public function getHash()
    {
        return $this->createHash($this->getSharedSecret() . $this->httpRequest->request->get('approval_code') . $this->httpRequest->request->get('chargetotal') . $this->getCurrencyNumeric() . $this->httpRequest->request->get('txndatetime') . $this->getStoreId());
    }

    /**
     * Get hash from bank response
     *
     * @return string
     */
    protected function getBankHash()
    {
        return $this->httpRequest->request->get('response_hash');
    }
}
