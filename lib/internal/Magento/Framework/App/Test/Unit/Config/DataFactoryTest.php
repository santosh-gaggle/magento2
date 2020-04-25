<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\App\Test\Unit\Config;

use Magento\Framework\App\Config\Data;
use Magento\Framework\App\Config\DataFactory;
use Magento\Framework\TestFramework\Unit\AbstractFactoryTestCase;

class DataFactoryTest extends AbstractFactoryTestCase
{
    protected function setUp(): void
    {
        $this->instanceClassName = Data::class;
        $this->factoryClassName = DataFactory::class;
        parent::setUp();
    }
}
