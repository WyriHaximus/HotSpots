<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Test\Cacher;

/**
 * Tests the memory cacher.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class MemoryTest extends \WyriHaximus\HotSpots\Test\AbstractCacherTest {
    
    public function setUp() {
        $this->Cacher = new \WyriHaximus\HotSpots\Cacher\Memory();
    }
    
    public function tearDown() {
        unset($this->Cacher);
    }
    
}