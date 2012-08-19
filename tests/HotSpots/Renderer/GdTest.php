<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots\Renderer;

/**
 * Tests the file writer.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class Gdtest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->tmpDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'HotSpotsTests';
        if (!file_exists($this->tmpDir)) {
            @mkdir($this->tmpDir, 0777, true);
        }

        if (!is_writable($this->tmpDir)) {
            $this->markTestSkipped(sprintf('Unable to run the tests as "%s" is not writable.', $this->tmpDir));
        }
    }

    public function tearDown() {
        $this->removeDir($this->tmpDir);
    }
    
    public function testSimpleRender() {
        
        $Matrix = new \HotSpots\Matrix\Simple(new \HotSpots\Cacher\Memory(), array(
            'height' => 256,
            'width' => 256,
        ));
        $Renderer = new \HotSpots\Renderer\Gd(array(
            'height' => 256,
            'width' => 256,
        ), new \HotSpots\Colors\Simple('Classic'), 50);
        
        $Matrix->push(0, 0, 0);
        $Matrix->push(1, 1, 0);
        $Matrix->push(2, 2, 0);
        $Matrix->push(4, 4, 0);
        $Matrix->push(8, 8, 0);
        $Matrix->push(16, 16, 0);
        $Matrix->push(32, 32, 0);
        $Matrix->push(64, 64, 0);
        $Matrix->push(128, 128, 0);
        $Matrix->push(256, 256, 0);

        $Renderer->render($Matrix, new \HotSpots\Writer\File($this->tmpDir . DIRECTORY_SEPARATOR . 'GdTest.png'));
        
        $imGood = imagecreatefrompng(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'GdTest.png');
        $imResult = imagecreatefrompng($this->tmpDir . DIRECTORY_SEPARATOR . 'GdTest.png');
        
        for ($i = 0; $i < 255; $i++) {
            for ($j = 0; $j < 255; $j++) {
                $rgbGood = @imagecolorat($imGood, $i, $j);
                $colorsGood = imagecolorsforindex($imGood, $rgbGood);
                
                $rgbResult = @imagecolorat($imResult, $i, $j);
                $colorsResult = imagecolorsforindex($imResult, $rgbResult);
                
                $this->assertSame($colorsGood['red'], $colorsResult['red']);
                $this->assertSame($colorsGood['green'], $colorsResult['green']);
                $this->assertSame($colorsGood['blue'], $colorsResult['blue']);
                $this->assertSame($colorsGood['alpha'], $colorsResult['alpha']);
            }
        }
        
        imagedestroy($imGood);
        imagedestroy($imResult);
    }
    
    public function testSimpleRenderAlpha() {
        
        $Matrix = new \HotSpots\Matrix\Simple(new \HotSpots\Cacher\Memory(), array(
            'height' => 256,
            'width' => 256,
        ));
        $Renderer = new \HotSpots\Renderer\Gd(array(
            'height' => 256,
            'width' => 256,
        ), new \HotSpots\Colors\Simple('ClassicAlpha'), 50);
        
        $Matrix->push(0, 0, 0);
        $Matrix->push(1, 1, 0);
        $Matrix->push(2, 2, 0);
        $Matrix->push(4, 4, 0);
        $Matrix->push(8, 8, 0);
        $Matrix->push(16, 16, 0);
        $Matrix->push(32, 32, 0);
        $Matrix->push(64, 64, 0);
        $Matrix->push(128, 128, 0);
        $Matrix->push(256, 256, 0);

        $Renderer->render($Matrix, new \HotSpots\Writer\File($this->tmpDir . DIRECTORY_SEPARATOR . 'GdTestAlpha.png'));
        
        $imGood = imagecreatefrompng(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'GdTestAlpha.png');
        $imResult = imagecreatefrompng($this->tmpDir . DIRECTORY_SEPARATOR . 'GdTestAlpha.png');
        
        for ($i = 0; $i < 255; $i++) {
            for ($j = 0; $j < 255; $j++) {
                $rgbGood = @imagecolorat($imGood, $i, $j);
                $colorsGood = imagecolorsforindex($imGood, $rgbGood);
                
                $rgbResult = @imagecolorat($imResult, $i, $j);
                $colorsResult = imagecolorsforindex($imResult, $rgbResult);
                
                $this->assertSame($colorsGood['red'], $colorsResult['red']);
                $this->assertSame($colorsGood['green'], $colorsResult['green']);
                $this->assertSame($colorsGood['blue'], $colorsResult['blue']);
                $this->assertSame($colorsGood['alpha'], $colorsResult['alpha']);
            }
        }
        
        imagedestroy($imGood);
        imagedestroy($imResult);
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