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
class GrayscaleTest extends \HotSpots\AbtractColorsTest {

    public function setUp() {
        $this->Colors = new \HotSpots\Colors\Grayscale();
    }
    
    public function tearDown() {
        unset($this->Colors);
    }

    public function testGetColor() {
        for ($channel = 0; $channel < 256; $channel++) {
            $grey = $this->Colors->getColor($channel);
            
            $this->assertSame($channel, $grey->getRed());
            $this->assertSame($channel, $grey->getGreen());
            $this->assertSame($channel, $grey->getBlue());
            $this->assertSame(0, $grey->getAlpha());
        }
    }

}