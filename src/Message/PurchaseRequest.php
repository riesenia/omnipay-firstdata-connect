<?php
namespace Omnipay\FirstDataConnect\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * FirstDataConnect Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * Live endpoint
     *
     * @var string
     */
    protected $liveEndpoint = 'https://www.ipg-online.com/connect/gateway/processing';

    /**
     * Test endpoint
     *
     * @var string
     */
    protected $testEndpoint = 'https://test.ipg-online.com/connect/gateway/processing';

    /**
     * Timestamp
     *
     * @var string
     */
    private $timestamp;

    /**
     * Setter
     *
     * @param string
     * @return $this
     */
    public function setStoreId($value)
    {
        return $this->setParameter('storeId', $value);
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getStoreId()
    {
        return $this->getParameter('storeId');
    }

    /**
     * Setter
     *
     * @param string
     * @return $this
     */
    public function setSharedSecret($value)
    {
        return $this->setParameter('sharedSecret', $value);
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getSharedSecret()
    {
        return $this->getParameter('sharedSecret');
    }

    /**
     * Get hash for request
     *
     * @return string
     */
    public function getHash()
    {
        return $this->createHash($this->getStoreId() . $this->getTimestamp() . $this->getAmount() . $this->getCurrencyNumeric() . $this->getSharedSecret());
    }

    /**
     * Timestamp
     *
     * @return string
     */
    public function getTimestamp()
    {
        if (!$this->timestamp) {
            $this->timestamp = (new \DateTime(null, new \DateTimeZone('Europe/Bratislava')))->format('Y:m:d-H:i:s');
        }

        return $this->timestamp;
    }

    /**
     * Get the raw data array for the message
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validate('amount', 'transactionId');

        $data = [];
        $data['txntype'] = 'sale';
        $data['timezone'] = 'Europe/Bratislava';
        $data['txndatetime'] = $this->getTimestamp();
        $data['hash_algorithm'] = 'SHA256';
        $data['hash'] = $this->getHash();
        $data['storename'] = $this->getStoreId();
        $data['mode'] = 'payonly';
        $data['paymentMethod'] = 'M';
        $data['chargetotal'] = $this->getAmount();
        $data['currency'] = $this->getCurrencyNumeric();
        $data['oid'] = $this->getTransactionId();
        $data['responseSuccessURL'] = $this->getReturnUrl();
        $data['responseFailURL'] = $this->getReturnUrl();

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param mixed
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    /**
     * Get endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * Create hash
     *
     * @param string
     * @return string
     */
    public function createHash($string)
    {
        return sha1(bin2hex($sign));
    }
}
