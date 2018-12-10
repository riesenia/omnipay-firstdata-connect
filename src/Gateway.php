<?php
namespace Omnipay\FirstDataConnect;

use Omnipay\Common\AbstractGateway;

/**
 * FirstDataConnect Gateway
 */
class Gateway extends AbstractGateway
{
    /**
     * Gateway name
     *
     * @return string
     */
    public function getName()
    {
        return 'FirstDataConnect';
    }

    /**
     * Get default parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'storeId' => '',
            'sharedSecret' => '',
            'testMode' => false,
            'checkoutoption' => 'classic'
        ];
    }

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
     * Setter
     *
     * @param string
     * @return $this
     */
    public function setCheckoutoption($value)
    {
        return $this->setParameter('checkoutoption', $value);
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getCheckoutoption()
    {
        return $this->getParameter('checkoutoption');
    }

    /**
     * Setter
     *
     * @param string
     * @return $this
     */
    public function setPaymentMethod($value)
    {
        return $this->setParameter('checkoutoption', $value);
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->getParameter('paymentMethod');
    }

    /**
     * Create a purchase request
     *
     * @param array $parameters
     * @return \Omnipay\FirstDataConnect\Message\PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\FirstDataConnect\Message\PurchaseRequest', $parameters);
    }

    /**
     * Create a complete purchase request
     *
     * @param array $parameters
     * @return \Omnipay\FirstDataConnect\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\FirstDataConnect\Message\CompletePurchaseRequest', $parameters);
    }
}
