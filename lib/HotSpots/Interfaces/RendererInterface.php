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
     * @param \HotSpots\ColorsInterface $Colors Image size
     * @param int $radius Cell radius
     * @return void
     */
    public function __construct($size, \HotSpots\Interfaces\ColorsInterface $Colors, $radius);

    /**
     * Push a cell into the matrix.
     * 
     * @param \HotSpots\MatrixInterface $Matrix The Matrix contianing the data
     * @param \HotSpots\WriterInterface $Writer Writer to store the result
     * @return void
     */
    public function render(\HotSpots\Interfaces\MatrixInterface $Matrix, \HotSpots\Interfaces\WriterInterface $Writer);
}