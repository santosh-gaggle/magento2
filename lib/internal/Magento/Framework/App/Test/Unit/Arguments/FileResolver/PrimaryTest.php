<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\App\Test\Unit\Arguments\FileResolver;

use Magento\Framework\App\Arguments\FileResolver\Primary;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Config\FileIteratorFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\Read;
use PHPUnit\Framework\TestCase;

class PrimaryTest extends TestCase
{
    /**
     * @param array $fileList
     * @param string $scope
     * @param string $filename
     * @dataProvider getMethodDataProvider
     */
    public function testGet(array $fileList, $scope, $filename)
    {
        $directory = $this->createMock(Read::class);
        $filesystem = $this->createMock(Filesystem::class);
        $iteratorFactory = $this->createPartialMock(FileIteratorFactory::class, ['create']);

        $filesystem->expects(
            $this->once()
        )->method(
            'getDirectoryRead'
        )->with(
            DirectoryList::CONFIG
        )->will(
            $this->returnValue($directory)
        );

        $directory->expects($this->once())->method('search')->will($this->returnValue($fileList));

        $iteratorFactory->expects($this->once())->method('create')->will($this->returnValue(true));

        $model = new Primary($filesystem, $iteratorFactory);

        $this->assertTrue($model->get($filename, $scope));
    }

    /**
     * @return array
     */
    public function getMethodDataProvider()
    {
        return [[['config/di.xml', 'config/some_config/di.xml'], 'primary', 'di.xml']];
    }
}
