<?php
/*
 * This file is part of PharIo\Manifest.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PharIo\Manifest;

use PHPUnit\Framework\TestCase;

/**
 * @covers PharIo\Manifest\PhpExtensionRequirement
 */
class PhpExtensionRequirementTest extends TestCase {
    public function testCanBeCreated() {
        $this->assertInstanceOf(PhpExtensionRequirement::class, new PhpExtensionRequirement('dom'));
    }

    public function testCanBeUsedAsString() {
        $this->assertEquals('dom', new PhpExtensionRequirement('dom'));
    }
}
