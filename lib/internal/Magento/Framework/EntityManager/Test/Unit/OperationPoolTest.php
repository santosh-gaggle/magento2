<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\EntityManager\Test\Unit;

use Magento\Framework\EntityManager\Operation\Read;
use Magento\Framework\EntityManager\OperationPool;
use Magento\Framework\ObjectManagerInterface;
use PHPUnit\Framework\TestCase;

class OperationPoolTest extends TestCase
{
    public function testGetOperationUsesDefaultValueForEntityThatDoesNotProvideCustomMapping()
    {
        $objectManagerMock = $this->createMock(ObjectManagerInterface::class);
        $operationPool = new OperationPool(
            $objectManagerMock,
            []
        );

        $objectManagerMock->expects($this->once())
            ->method('get')
            ->with(Read::class);
        $operationPool->getOperation('entity_type', 'read');
    }

    public function testGetOperationUsesOverriddenDefaultValueForEntityThatDoesNotProvideCustomMapping()
    {
        $customReadOperation = 'CustomReadOperation';
        $objectManagerMock = $this->createMock(ObjectManagerInterface::class);
        $operationPool = new OperationPool(
            $objectManagerMock,
            [
                'default' => [
                    'read' => $customReadOperation,
                    'new' => 'CustomNewOperation',
                ],
            ]
        );

        $objectManagerMock->expects($this->once())
            ->method('get')
            ->with($customReadOperation);
        $operationPool->getOperation('entity_type', 'read');
    }
}
