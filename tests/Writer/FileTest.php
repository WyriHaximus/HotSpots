<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Test\Writer;

/**
 * Tests the file writer.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class FileTest extends \WyriHaximus\HotSpots\Test\AbstractWriterTest {

    public function setUp() {
        $this->tmpDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'HotSpotsTests';
        if (!file_exists($this->tmpDir)) {
            @mkdir($this->tmpDir, 0777, true);
        }

        if (!is_writable($this->tmpDir)) {
            $this->markTestSkipped(sprintf('Unable to run the tests as "%s" is not writable.', $this->tmpDir));
        }
        
        $this->fileName = $this->tmpDir . DIRECTORY_SEPARATOR . 'fileWriter.ext';
        
        $this->Writer = new \WyriHaximus\HotSpots\Writer\File($this->fileName);
    }

    public function tearDown() {
        if ($this->fileName && file_exists($this->fileName)) {
            unlink($this->fileName);
        }

        $this->removeDir($this->tmpDir);
    }

    public function testWrite() {
        $writeResult = $this->Writer->write('a');
        $this->assertSame(1, $writeResult);
        $this->assertSame('a', file_get_contents($this->fileName));
    }

    private function removeDir($target) {
        $fp = opendir($target);
        while (false !== $file = readdir($fp)) {
            if (in_array($file, array('.', '..'))) {
                continue;
            }

            if (is_dir($target . DIRECTORY_SEPARATOR . $file)) {
                self::removeDir($target . DIRECTORY_SEPARATOR . $file);
            } else {
                unlink($target . DIRECTORY_SEPARATOR . $file);
            }
        }
        closedir($fp);
        rmdir($target);
    }

}