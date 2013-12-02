<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Colors;

/**
 * Grayscale Colorer.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class Grayscale implements \WyriHaximus\HotSpots\Interfaces\ColorsInterface {

    /**
     * Get the color by the channel (0 - 255).
     * 
     * @param int $channel Color channel
     * @return mixed Returns a \WyriHaximus\HotSpots\Color $value value for the cell if it is in range otherwise it returns false
     */
    public function getColor($channel) {
        $channel = (int) $channel;
        
        if ($channel > 255 || $channel < 0) {
            return false;
        }
        
        if (!isset($this->colors[$channel])) {
            $this->colors[$channel] = new \WyriHaximus\HotSpots\Color($channel, $channel, $channel, 0);
        }

        return $this->colors[$channel];
    }

}