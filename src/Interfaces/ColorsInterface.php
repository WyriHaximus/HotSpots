<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Interfaces;

/**
 * ColorsInterface.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
interface ColorsInterface {

    /**
     * Get the color by the channel (0 - 255).
     * 
     * @param int $channel Color channel
     * @return \WyriHaximus\HotSpots\Color $value value for the cell
     */
    public function getColor($channel);
}