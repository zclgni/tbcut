<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Tests\Session\Storage;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

/**
 * Test class for PhpSessionStorage.
 *
 * @author Drak <drak@zikula.org>
 *
 * These tests require separate processes.
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PhpBridgeSessionStorageTest extends TestCase
{
    private $savePath;

    protected function setUp()
    {
        $this->iniSet('session.save_handler', 'files');
        $this->iniSet('session.save_path', $this->savePath = sys_get_temp_dir().'/sf2test');
        if (!is_dir($this->savePath)) {
            mkdir($this->savePath);
        }
    }

    protected function tearDown()
    {
        session_write_close();
        array_map('unlink', glob($this->savePath.'/*'));
        if (is_dir($this->savePath)) {
            rmdir($this->savePath);
        }

        $this->savePath = null;
    }

    /**
     * @return PhpBridgeSessionStorage
     */
    protected function getStorage()
    {
        $storage = new PhpBridgeSessionStorage();
        $storage->registerBag(new AttributeBag());

        return $storage;
    }

    public function testPhpSession()
    {
        $storage = $this->getStorage();

        $this->assertNotSame(\PHP_SESSION_ACTIVE, session_status());
        $this->assertFalse($storage->isStarted());

        session_start();
        $this->assertTrue(isset($_SESSION));
        $this->assertSame(\PHP_SESSION_ACTIVE, session_status());
        // PHP session might have started, but the storage driver has not, so false is correct here
        $this->assertFalse($storage->isStarted());

        $key = $storage->getMetadataBag()->getStorageKey();
        $this->assertArrayNotHasKey($key, $_SESSION);
        $storage->start();
        $this->assertArrayHasKey($key, $_SESSION);
    }

    public function testClear()
    {
        $storage = $this->getStorage();
        session_start();
        $_SESSION['drak'] = 'loves symfony';
        $storage->getBag('attributes')->set('symfony', 'greatness');
        $key = $storage->getBag('attributes')->getStorageKey();
        $this->assertEquals($_SESSION[$key], array('symfony' => 'greatness'));
        $this->assertEquals($_SESSION['drak'], 'loves symfony');
        $storage->clear();
        $this->assertEquals($_SESSION[$key], array());
        $this->assertEquals($_SESSION['drak'], 'loves symfony');
    }
}
