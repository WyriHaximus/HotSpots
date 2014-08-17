<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Writer;

/**
 * Writes the result render of the HotSpots to a file.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class Memory implements \WyriHaximus\HotSpots\Interfaces\WriterInterface {

	/**
	 * The data to be readed after the renderer has written to it
	 *
	 * @var string
	 */
	private $data;

	/**
	 * Writes $data to datastorage.
	 *
	 * @param string $data binairy data to be saved.
	 * @return mixed Returns true on succes or false on failure.
	 */
	public function write($data) {
		$this->data = $data;
		return true;
	}

	public function read() {
		return $this->data;
	}



}