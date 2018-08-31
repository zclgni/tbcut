<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Constraint;

class SameSize extends Count
{
    /**
     * @param array|\Countable|\Traversable $expected
     */
    public function __construct($expected)
    {
        parent::__construct($this->getCountOf($expected));
    }
}
