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
 * MatrixInterface.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
interface MatrixInterface
{
    /**
     * Setup Matrix
     *
     * @param \WyriHaximus\HotSpots\Interfaces\CacherInterface $Cacher Image resource
     * @param array $size Matrix size
     * @return void
     */
    public function __construct(\WyriHaximus\HotSpots\Interfaces\CacherInterface $Cacher, $size);

    /**
     * Push a cell into the matrix.
     *
     * @param int $x x coordinate
     * @param int $y y coordinate
     * @param int $value cell value
     * @return void
     */
    public function push($x, $y, $value);

    /**
     * Get the data for the next cell from the cacher
     *
     * @return mixed Cell data from cacher
     */
    public function next();

    /**
     * Get the Matrix's size
     *
     * @param string $type
     * @return integer Matrix size
     */
    public function getSize($type = null);
}
