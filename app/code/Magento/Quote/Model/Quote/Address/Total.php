<?php
declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Quote\Model\Quote\Address;

use Magento\Framework\DataObject;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;

/**
 * Class Total
 *
 * @method string getCode()
 *
 * @api
 * @since 100.0.2
 */
class Total extends DataObject
{
    const PRICE_PRECISION = 4;

    /**
     * @var array
     */
    protected $totalAmounts = [];

    /**
     * @var array
     */
    protected $baseTotalAmounts = [];

    /**
     * Serializer interface instance.
     *
     * @var JsonSerializer
     */
    private $serializer;

    /**
     * Constructor
     *
     * @param array $data
     * @param JsonSerializer|null $serializer
     */
    public function __construct(
        array $data = [],
        JsonSerializer $serializer = null
    ) {
        $this->serializer = $serializer;
        parent::__construct($data);
    }

    /**
     * Set total amount value
     *
     * @param string $code
     * @param float $amount
     * @return $this
     */
    public function setTotalAmount(string $code, $amount): self
    {
        $amount = is_float($amount) ? round($amount, self::PRICE_PRECISION) : $amount;

        $this->totalAmounts[$code] = $amount;
        if ($code != 'subtotal') {
            $code = $code . '_amount';
        }

        return $this->setData($code, $amount);
    }

    /**
     * Set total amount value in base store currency
     *
     * @param string $code
     * @param float $amount
     * @return $this
     */
    public function setBaseTotalAmount(string $code, $amount): self
    {
        $amount = is_float($amount) ? round($amount, self::PRICE_PRECISION) : $amount;

        $this->baseTotalAmounts[$code] = $amount;
        if ($code != 'subtotal') {
            $code = $code . '_amount';
        }

        return $this->setData('base_' . $code, $amount);
    }

    /**
     * Add amount total amount value
     *
     * @param string $code
     * @param float $amount
     * @return $this
     */
    public function addTotalAmount(string $code, $amount): self
    {
        $amount = $this->getTotalAmount($code) + $amount;

        return $this->setTotalAmount($code, $amount);
    }

    /**
     * Add amount total amount value in base store currency
     *
     * @param string $code
     * @param float $amount
     * @return $this
     */
    public function addBaseTotalAmount(string $code, $amount): self
    {
        $amount = $this->getBaseTotalAmount($code) + $amount;

        return $this->setBaseTotalAmount($code, $amount);
    }

    /**
     * Get total amount value by code
     *
     * @param string $code
     * @return  float|int
     */
    public function getTotalAmount(string $code)
    {
        if (isset($this->totalAmounts[$code])) {
            return $this->totalAmounts[$code];
        }

        return 0;
    }

    /**
     * Get total amount value by code in base store currency
     *
     * @param string $code
     * @return  float|int
     */
    public function getBaseTotalAmount(string $code)
    {
        if (isset($this->baseTotalAmounts[$code])) {
            return $this->baseTotalAmounts[$code];
        }

        return 0;
    }

    //@codeCoverageIgnoreStart

    /**
     * Get all total amount values
     *
     * @return array
     */
    public function getAllTotalAmounts(): array
    {
        return $this->totalAmounts;
    }

    /**
     * Get all total amount values in base currency
     *
     * @return array
     */
    public function getAllBaseTotalAmounts(): array
    {
        return $this->baseTotalAmounts;
    }

    //@codeCoverageIgnoreEnd

    /**
     * Set the full info, which is used to capture tax related information.
     *
     * If a string is used, it is assumed to be serialized.
     *
     * @param array|string $info
     * @return $this
     * @since 100.1.0
     */
    public function setFullInfo($info): self
    {
        return $this->setData('full_info', $info);
    }

    /**
     * Returns the full info, which is used to capture tax related information.
     *
     * @return array
     * @since 100.1.0
     */
    public function getFullInfo(): array
    {
        $fullInfo = $this->getData('full_info');
        if (is_string($fullInfo)) {
            $fullInfo = $this->serializer->unserialize($fullInfo);
        }

        return $fullInfo;
    }
}
