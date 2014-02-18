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
 * CacherInterface.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
interface CacherInterface {

    /**
     * Store $value for cell $x,$y in the cacher.
     * 
     * @param int $x x coordinate
     * @param int $y y coordinate
     * @param int $value value for the cell
     */
    public function push($x, $y, $value);

    /**
     * Get the data for the next cell
     * 
     * @return mixed Cell coordinates & value
     */
    public function next();

    /**
     * Get the cell count
     * 
     * @return int The number of cells in the cacher
     */
    public function count();

    /**
     * Get the current position in the dataset
     * 
     * @return int The current index within the dataset
     */
    public function position();

    /**
     * Reset the cacher.
     */
    public function reset();
}