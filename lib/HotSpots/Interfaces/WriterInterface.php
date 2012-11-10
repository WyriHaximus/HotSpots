<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots\Interfaces;

/**
 * Writes the result render of the HotSpots to a file.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
interface WriterInterface {
    
    /**
     * Writes $data to datastorage.
     * 
     * @param string $data binairy data to be saved.
     */
    public function write($data);
}