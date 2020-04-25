<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Url\Test\Unit;

use Magento\Framework\Url\Decoder;
use Magento\Framework\Url\Encoder;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\TestCase;

class DecoderTest extends TestCase
{
    /**
     * @covers \Magento\Framework\Url\Encoder::encode
     * @covers \Magento\Framework\Url\Decoder::decode
     */
    public function testDecode()
    {
        $urlBuilderMock = $this->createMock(UrlInterface::class);
        /** @var \Magento\Framework\UrlInterface|\PHPUnit_Framework_MockObject_MockObject $urlBuilderMock */
        $decoder = new Decoder($urlBuilderMock);
        $encoder = new Encoder();

        $data = uniqid();
        $result = $encoder->encode($data);
        $urlBuilderMock->expects($this->once())
            ->method('sessionUrlVar')
            ->with($this->equalTo($data))
            ->will($this->returnValue($result));
        $this->assertNotContains('&', $result);
        $this->assertNotContains('%', $result);
        $this->assertNotContains('+', $result);
        $this->assertNotContains('=', $result);
        $this->assertEquals($result, $decoder->decode($result));
    }
}
