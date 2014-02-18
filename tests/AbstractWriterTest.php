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
 * Base WriterTest with some basic test all Writers should be able to perform
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
abstract class AbstractWriterTest extends \PHPUnit_Framework_TestCase {
    
    public function testInheritance() {
        $classImplements = class_implements($this->Writer);
        $this->assertTrue(isset($classImplements['WyriHaximus\HotSpots\Interfaces\WriterInterface']));
    }
}