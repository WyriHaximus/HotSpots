<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots;

/**
 * Base Matrix tests all matrixes have to pass
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
abstract class AbstractMatrixTest extends \PHPUnit_Framework_TestCase {
    
    public function testInheritance() {
        $classImplements = class_implements($this->Matrix);
        $this->assertTrue(isset($classImplements['HotSpots\Interfaces\MatrixInterface']));
    }
    
    public function testStoreAndRetrieve() {
        $data = array(
            1,
            2,
            4,
            8,
            16,
            32,
            64,
            128,
            256,
            512,
            1024,
            2048,
            4096,
        );
        
        foreach ($data as $value) {
            $this->Matrix->push($value, $value, 0);
        }
        
        $i = 0;
        while (($storedValue = $this->Matrix->next()) !== false) {
            $this->assertEquals(array(
                'x' => $data[$i],
                'y' => $data[$i],
                'value' => 0,
            ), $storedValue);
            $i++;
        }
        
        $this->assertEquals(count($data), $i);
        $this->assertEquals(false, $this->Matrix->next());
    }
    
    public function testGetSize() {
        $this->assertEquals(256, $this->Matrix->getSize('width'));
        $this->assertEquals(256, $this->Matrix->getSize('height'));
        
        $this->assertEquals(array(
            'height' => 256,
            'width' => 256,
        ), $this->Matrix->getSize());
    }
    
}