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
 * Base ColorsTest with some basic test all Colors should be able to perform
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
abstract class AbstractCacherTest extends \PHPUnit_Framework_TestCase {
    
    public function testInheritance() {
        $classImplements = class_implements($this->Cacher);
        $this->assertTrue(isset($classImplements['HotSpots\CacherInterface']));
    }
    
    public function testInsert() {
        $i = 1;
        for ($x = 0; $x < 10; $x++) {
            for ($y = 0; $y < 10; $y++) {
                $this->Cacher->push($x, $y, (($i * 27) / 13));
                
                $this->assertSame($i, $this->Cacher->count());
                
                $data = $this->Cacher->next();
                $this->assertSame($x, $data['x']);
                $this->assertSame($y, $data['y']);
                $this->assertSame((($i * 27) / 13), $data['value']);
                
                $this->assertSame($i, $this->Cacher->position());
                
                $i++;
            }
        }
    }
    
    public function testReset() {
        $this->assertSame(0, $this->Cacher->count());
        
        $this->Cacher->push(0, 1, 2);
        $this->assertSame(1, $this->Cacher->count());
        
        $this->Cacher->push(0, 1, 2);
        $this->assertSame(2, $this->Cacher->count());
        
        $this->Cacher->reset();
        $this->assertSame(0, $this->Cacher->count());
    }
}