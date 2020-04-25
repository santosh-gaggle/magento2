<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\App\Test\Unit\Config;

use Magento\Framework\App\Config\Base;
use Magento\Framework\App\Config\BaseFactory;
use Magento\Framework\TestFramework\Unit\AbstractFactoryTestCase;

class BaseFactoryTest extends AbstractFactoryTestCase
{
    protected function setUp(): void
    {
        $this->instanceClassName = Base::class;
        $this->factoryClassName = BaseFactory::class;
        parent::setUp();
    }
}
