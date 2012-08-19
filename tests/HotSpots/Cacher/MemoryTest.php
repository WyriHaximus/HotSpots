<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots\Cacher;

/**
 * Tests the memory cacher.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class MemoryTest extends \HotSpots\AbstractCacherTest {
    
    public function setUp() {
        $this->Cacher = new \HotSpots\Cacher\Memory();
    }
    
    public function tearDown() {
        unset($this->Cacher);
    }
    
}