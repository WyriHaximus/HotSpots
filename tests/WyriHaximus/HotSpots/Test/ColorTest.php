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
 * Test the Color object.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class ColorTest extends \PHPUnit_Framework_TestCase {
    
    public function testSetGet() {
        $color = new \WyriHaximus\HotSpots\Color(1, 2, 3, 4);
        
        $this->assertSame(1, $color->getRed());
        $this->assertSame(2, $color->getGreen());
        $this->assertSame(3, $color->getBlue());
        $this->assertSame(4, $color->getAlpha());
        
        $this->assertSame(5, $color->setRed(5));
        $this->assertSame(6, $color->setGreen(6));
        $this->assertSame(7, $color->setBlue(7));
        $this->assertSame(8, $color->setAlpha(8));
        
        $this->assertSame(5, $color->getRed());
        $this->assertSame(6, $color->getGreen());
        $this->assertSame(7, $color->getBlue());
        $this->assertSame(8, $color->getAlpha());
    }
    
    public function testMin() {
        $color = new \WyriHaximus\HotSpots\Color(0, 0, 0, 0);
        
        $this->assertSame(0, $color->getRed());
        $this->assertSame(0, $color->getGreen());
        $this->assertSame(0, $color->getBlue());
        $this->assertSame(0, $color->getAlpha());
        
        $this->assertSame(0, $color->setRed(0));
        $this->assertSame(0, $color->setGreen(0));
        $this->assertSame(0, $color->setBlue(0));
        $this->assertSame(0, $color->setAlpha(0));
        
        $this->assertSame(0, $color->getRed());
        $this->assertSame(0, $color->getGreen());
        $this->assertSame(0, $color->getBlue());
        $this->assertSame(0, $color->getAlpha());
    }
    
    public function testMax() {
        $color = new \WyriHaximus\HotSpots\Color(255, 255, 255, 127);
        
        $this->assertSame(255, $color->getRed());
        $this->assertSame(255, $color->getGreen());
        $this->assertSame(255, $color->getBlue());
        $this->assertSame(127, $color->getAlpha());
        
        $this->assertSame(255, $color->setRed(255));
        $this->assertSame(255, $color->setGreen(255));
        $this->assertSame(255, $color->setBlue(255));
        $this->assertSame(127, $color->setAlpha(127));
        
        $this->assertSame(255, $color->getRed());
        $this->assertSame(255, $color->getGreen());
        $this->assertSame(255, $color->getBlue());
        $this->assertSame(127, $color->getAlpha());
    }
    
    public function testUnderMin() {
        $color = new \WyriHaximus\HotSpots\Color(-1, -2, -3, -1);
        
        $this->assertSame(0, $color->getRed());
        $this->assertSame(0, $color->getGreen());
        $this->assertSame(0, $color->getBlue());
        $this->assertSame(0, $color->getAlpha());
        
        $this->assertSame(0, $color->setRed(-5));
        $this->assertSame(0, $color->setGreen(-6));
        $this->assertSame(0, $color->setBlue(-7));
        $this->assertSame(0, $color->setAlpha(-2));
        
        $this->assertSame(0, $color->getRed());
        $this->assertSame(0, $color->getGreen());
        $this->assertSame(0, $color->getBlue());
        $this->assertSame(0, $color->getAlpha());
    }
    
    public function tesOverMax() {
        $color = new \WyriHaximus\HotSpots\Color(256, 257, 258, 128);
        
        $this->assertSame(255, $color->getRed());
        $this->assertSame(255, $color->getGreen());
        $this->assertSame(255, $color->getBlue());
        $this->assertSame(127, $color->getAlpha());
        
        $this->assertSame(255, $color->setRed(260));
        $this->assertSame(255, $color->setGreen(261));
        $this->assertSame(255, $color->setBlue(262));
        $this->assertSame(127, $color->setAlpha(129));
        
        $this->assertSame(255, $color->getRed());
        $this->assertSame(255, $color->getGreen());
        $this->assertSame(255, $color->getBlue());
        $this->assertSame(127, $color->getAlpha());
    }
    
    public function testNonIntString() {
        $color = new \WyriHaximus\HotSpots\Color('a', 'b', 'c', 'd');
        
        $this->assertSame(0, $color->getRed());
        $this->assertSame(0, $color->getGreen());
        $this->assertSame(0, $color->getBlue());
        $this->assertSame(0, $color->getAlpha());
        
        $this->assertSame(0, $color->setRed('e'));
        $this->assertSame(0, $color->setGreen('f'));
        $this->assertSame(0, $color->setBlue('g'));
        $this->assertSame(0, $color->setAlpha('h'));
        
        $this->assertSame(0, $color->getRed());
        $this->assertSame(0, $color->getGreen());
        $this->assertSame(0, $color->getBlue());
        $this->assertSame(0, $color->getAlpha());
    }

}