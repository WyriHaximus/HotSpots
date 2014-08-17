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
 * RendererInterface.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
interface RendererInterface {

    /**
     * Setup the renderer
     * 
     * @param array $size Image size
     * @param ColorsInterface $Colors Image size
     * @param int $radius Cell radius
     * @return void
     */
    public function __construct($size, \WyriHaximus\HotSpots\Interfaces\ColorsInterface $Colors, $radius);

    /**
     * Push a cell into the matrix.
     * 
     * @param MatrixInterface $Matrix The Matrix contianing the data
     * @param WriterInterface $Writer Writer to store the result
     * @return void
     */
    public function render(\WyriHaximus\HotSpots\Interfaces\MatrixInterface $Matrix, \WyriHaximus\HotSpots\Interfaces\WriterInterface $Writer);
}