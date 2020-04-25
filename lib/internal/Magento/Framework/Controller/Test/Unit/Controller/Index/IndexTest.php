<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Controller\Test\Unit\Controller\Index;

use Magento\Framework\Controller\Index\Index;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testExecute()
    {
        $objectManager = new ObjectManager($this);
        /**
         * @var Index
         */
        $controller = $objectManager->getObject(Index::class);

        // The execute method is empty and returns void, just calling to verify
        // the method exists and does not throw an exception
        $controller->execute();
    }
}
