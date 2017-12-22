<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryCatalog\Ui\Component;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\InventoryApi\Api\Data\StockInterface;
use Magento\InventoryCatalog\Api\DefaultStockProviderInterface;
use Magento\Ui\Component\Container;

class Record extends Container
{
    /**
     * @var DefaultStockProviderInterface
     */
    private $defaultStockProvider;

    public function __construct(
        ContextInterface $context,
        DefaultStockProviderInterface $defaultStockProvider,
        $components = [],
        array $data = []
    ) {
        parent::__construct($context, $components, $data);
        $this->defaultStockProvider = $defaultStockProvider;
    }

    /**
     * @inheritdoc
     */
    public function prepare()
    {
        parent::prepare();

        // Disable assign sources if stock is default
        $stockId = (int) $this->context->getRequestParam(StockInterface::STOCK_ID);
        if ($stockId === $this->defaultStockProvider->getId()) {
            $deleteConfig = $this->components['actionDelete']->getData('config');
            $deleteConfig['disabled'] = true;
            $deleteConfig['notice'] = __('Disabled for default stock');
            $this->components['actionDelete']->setData('config', $deleteConfig);
        }
    }
}
