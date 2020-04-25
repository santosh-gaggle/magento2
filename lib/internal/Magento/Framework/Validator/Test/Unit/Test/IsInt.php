<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\Validator\Test\Unit\Test;

use Magento\Framework\Validator\ValidatorInterface;

/**
 * Integer test validator
 */
class IsInt extends \Zend_Validate_Int implements ValidatorInterface
{
}
