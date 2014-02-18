<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Test;

/**
 * Base ColorsTest with some basic test all Colors should be able to perform
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
abstract class AbtractColorsTest extends \PHPUnit_Framework_TestCase {
    
    public function testInheritance() {
        $classImplements = class_implements($this->Colors);
        $this->assertTrue(isset($classImplements['WyriHaximus\HotSpots\Interfaces\ColorsInterface']));
    }
    
    public function testInRangeOutput() {
        for ($channel = 0; $channel < 256; $channel++) {
            $color = $this->Colors->getColor($channel);
            
            $this->assertInstanceOf('WyriHaximus\HotSpots\Color', $color);
            
            $this->assertGreaterThanOrEqual(0, $color->getRed());
            $this->assertGreaterThanOrEqual(0, $color->getGreen());
            $this->assertGreaterThanOrEqual(0, $color->getBlue());
            $this->assertGreaterThanOrEqual(0, $color->getAlpha());
            
            $this->assertLessThanOrEqual(255, $color->getRed());
            $this->assertLessThanOrEqual(255, $color->getGreen());
            $this->assertLessThanOrEqual(255, $color->getBlue());
            $this->assertLessThanOrEqual(255, $color->getAlpha());
        }
    }
    
    public function testOutOfRange() {
        $color = $this->Colors->getColor(-1);
        $this->assertFalse($color);
        
        $color = $this->Colors->getColor(-256);
        $this->assertFalse($color);
    }
    
    public function testString() {
        $color = $this->Colors->getColor('a');
        
        $this->assertInstanceOf('WyriHaximus\HotSpots\Color', $color);

        $this->assertGreaterThanOrEqual(0, $color->getRed());
        $this->assertGreaterThanOrEqual(0, $color->getGreen());
        $this->assertGreaterThanOrEqual(0, $color->getBlue());
        $this->assertGreaterThanOrEqual(0, $color->getAlpha());

        $this->assertLessThanOrEqual(255, $color->getRed());
        $this->assertLessThanOrEqual(255, $color->getGreen());
        $this->assertLessThanOrEqual(255, $color->getBlue());
        $this->assertLessThanOrEqual(255, $color->getAlpha());
    }
    
}