<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots\Coordinates;

/**
 * Test the storage for lat, lng pair values.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class LatLngTest extends \PHPUnit_Framework_TestCase {
    
    public function testConstructor() {
        $LatLng = new \StaticMap\LatLng(35, 45);
        
        $this->assertEquals(35, $LatLng->getLat());
        $this->assertEquals(45, $LatLng->getLng());
    }
    
    public function testSetters() {
        $LatLng = new \StaticMap\LatLng(35, 45);
        
        $LatLng->setLat(55);
        $LatLng->setLng(65);
        
        $this->assertEquals(55, $LatLng->getLat());
        $this->assertEquals(65, $LatLng->getLng());
    }
    
    public function testInRange() {
        $LatLng = new \StaticMap\LatLng(35, 45);
        
        for ($i = -90; $i <= 90; $i++) {
            $LatLng->setLat($i);
            $this->assertEquals($i, $LatLng->getLat());
        }
        
        for ($i = -180; $i <= 180; $i++) {
            $LatLng->setLng($i);
            $this->assertEquals($i, $LatLng->getLng());
        }
    }
    
    public function testOutRange() {
        $LatLng = new \StaticMap\LatLng(35, 45);
        
        $LatLng->setLat(-90.1);
        $this->assertEquals(false, $LatLng->getLat());
        $LatLng->setLat(-91);
        $this->assertEquals(false, $LatLng->getLat());
        
        $LatLng->setLat(90.1);
        $this->assertEquals(false, $LatLng->getLat());
        $LatLng->setLat(91);
        $this->assertEquals(false, $LatLng->getLat());

        $LatLng->setLat(-180.1);
        $this->assertEquals(false, $LatLng->getLat());
        $LatLng->setLat(-181);
        $this->assertEquals(false, $LatLng->getLat());
        
        $LatLng->setLat(190.1);
        $this->assertEquals(false, $LatLng->getLat());
        $LatLng->setLat(181);
        $this->assertEquals(false, $LatLng->getLat());
    }
    
    public function testNonInt() {
        $LatLng = new \StaticMap\LatLng('a', 'b');
        
        $this->assertEquals(0, $LatLng->getLat());
        $this->assertEquals(0, $LatLng->getLng());
    }
    
    public function testNonIntGetter() {
        $LatLng = new \StaticMap\LatLng('a', 'b');
        
        $LatLng->setLat('c');
        $LatLng->setLng('d');
        
        $this->assertEquals(0, $LatLng->getLat());
        $this->assertEquals(0, $LatLng->getLng());
    }
    
}