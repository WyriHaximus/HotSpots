<?php
/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots\Cacher;

/**
 * Caches HotSpotss state in memory.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class Memory implements \HotSpots\CacherInterface
{
    
    /**
     * Cacher data storage
     * 
     * @var array
     */
    private $data = array();
    
    /**
     * Iterator for next
     * 
     * @var int 
     */
    private $i = 0;
    
    /**
     * Store $value for cell $x,$y in the cacher.
     * 
     * @param int $x x coordinate
     * @param int $y y coordinate
     * @param int $value value for the cell
     * @return void
     */
    public function push($x, $y, $value) {
        $this->data[] = array(
            'x' => $x,
            'y' => $y,
            'value' => $value,
        );
    }
    
    /**
     * Get the data for the next cell
     * 
     * @return mixed Cell coordinates & value
     */
    public function next() {
        if (isset($this->data[$this->i])) {
            $data = $this->data[$this->i];
            $this->i++;
            return $data;
        } else {
            return false;
        }
    }
    
    /**
     * Return the number of cells in the cacher.
     * 
     * @return int
     */
    public function count() {
        return count($this->data);
    }
    
    /**
     * Get the current position in the dataset
     * 
     * @return int The current index within the dataset
     */
    public function position() {
        return $this->i;
    }
    
    /**
     * Clear the cacher.
     * 
     * @return void
     */
    public function reset() {
        $this->data = array();
        $this->i = 0;
    }
}