<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\App\Test\Unit\Config;

use Magento\Framework\App\Config\InitialConfigSource;
use Magento\Framework\App\DeploymentConfig\Reader;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InitialConfigSourceTest extends TestCase
{
    /**
     * @var Reader|MockObject
     */
    private $reader;

    /**
     * @var string
     */
    private $configType;

    /**
     * @var InitialConfigSource
     */
    private $source;

    public function setUp(): void
    {
        $this->reader = $this->getMockBuilder(Reader::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->configType = 'configType';
        $this->source = new InitialConfigSource($this->reader, $this->configType);
    }

    public function testGet()
    {
        $path = 'path';
        $this->reader->expects($this->once())
            ->method('load')
            ->willReturn([$this->configType => [$path => 'value']]);
        $this->assertEquals('value', $this->source->get($path));
    }
}
