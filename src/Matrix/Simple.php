<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Matrix;

/**
 * Manages the Matrix and uses the Cacher to store data.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class Simple implements \WyriHaximus\HotSpots\Interfaces\MatrixInterface {

    /**
     * @var \WyriHaximus\HotSpots\Interfaces\CacherInterface
     */
    private $Cacher;

    /**
     * @var array
     */
    private $size;

    /**
     * Setup Matrix
     * 
     * @param \WyriHaximus\HotSpots\Interfaces\CacherInterface $Cacher Image resource
     * @param array $size Matrix size
     */
    public function __construct(\WyriHaximus\HotSpots\Interfaces\CacherInterface $Cacher, $size) {
        $this->Cacher = $Cacher;
        $this->size = $size;
    }

    /**
     * Push a cell into the matrix.
     * 
     * @param int $x x coordinate
     * @param int $y y coordinate
     * @param int $value cell value
     * @return void
     */
    public function push($x, $y, $value) {
        $this->Cacher->push($x, $y, $value);
    }

    /**
     * Get the data for the next cell from the cacher
     * 
     * @return mixed Cell data from cacher
     */
    public function next() {
        return $this->Cacher->next();
    }

    /**
     * @param null $type
     *
     * @return array|mixed
     */
    public function getSize($type = null) {
        if (is_null($type)) {
            return $this->size;
        } else {
            return $this->size[$type];
        }
    }

}