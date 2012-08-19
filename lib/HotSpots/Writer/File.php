<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots\Writer;

/**
 * Writes the result render of the HotSpots to a file.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class File implements \HotSpots\WriterInterface {

    /**
     * Name of the file to be writen
     * 
     * @var string 
     */
    private $fileName = '';

    /**
     * Store $fileName internaly.
     * 
     * @param string $fileName Name of the file to be writen
     */
    public function __construct($fileName) {
        $this->fileName = $fileName;
    }

    /**
     * Writes $data to datastorage.
     * 
     * @param string $data binairy data to be saved.
     * @return mixed Returns the number of written bytes on succes or false on failure.
     */
    public function write($data) {
        return file_put_contents($this->fileName, $data);
    }

}