<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Test\Matrix;

/**
 * Test the Simple Matrix.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class SimpleTest extends \WyriHaximus\HotSpots\Test\AbstractMatrixTest {
    
    public function setUp() {
        $this->Matrix = new \WyriHaximus\HotSpots\Matrix\Simple(new \WyriHaximus\HotSpots\Cacher\Memory(), array(
            'height' => 256,
            'width' => 256,
        ));
    }
    
    public function tearDown() {
        unset($this->Matrix);
    }

}