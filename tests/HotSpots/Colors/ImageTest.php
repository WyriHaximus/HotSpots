<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots\Colors;

/**
 * Test the grayscale colorer.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class ImageTest extends \HotSpots\AbtractColorsTest {
    
    public function setUp() {
        $this->Colors = new \HotSpots\Colors\Image('Classic');
    }
    
    public function tearDown() {
        unset($this->Colors);
    }

    public function testGetColor() {
        $this->image = imagecreatefrompng(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Images' . DIRECTORY_SEPARATOR . 'Classic.png');
        
        for ($channel = 0; $channel < 256; $channel++) {
            $color = $this->Colors->getColor($channel);
            
            $rgb = imagecolorat($this->image, 255 - $channel, 0);
            $colors = imagecolorsforindex($this->image, $rgb);
            
            $this->assertSame($colors['red'], $color->getRed());
            $this->assertSame($colors['green'], $color->getGreen());
            $this->assertSame($colors['blue'], $color->getBlue());
            $this->assertSame(0, $color->getAlpha());
        }
        
        imagedestroy($this->image);
    }

    public function testGetColorAlpha() {
        // Overwriting default image used
        unset($this->Colors);
        $this->Colors = new \HotSpots\Colors\Image('ClassicAlpha');
        $this->image = imagecreatefrompng(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Images' . DIRECTORY_SEPARATOR . 'ClassicAlpha.png');
        
        for ($channel = 0; $channel < 256; $channel++) {
            $color = $this->Colors->getColor($channel);
            
            $rgb = imagecolorat($this->image, 255 - $channel, 0);
            $colors = imagecolorsforindex($this->image, $rgb);
            
            $this->assertSame($colors['red'], $color->getRed());
            $this->assertSame($colors['green'], $color->getGreen());
            $this->assertSame($colors['blue'], $color->getBlue());
            $this->assertSame($colors['alpha'], $color->getAlpha());
        }
        
        imagedestroy($this->image);
    }
    
    
    /**
     * @expectedException \HotSpots\Exceptions\FileNotFoundException
     */
    public function testNonexistingImage() {
        // Overwriting default image used
        unset($this->Colors);
        $this->Colors = new \HotSpots\Colors\Image('NonexistingImageFile');
    }

}