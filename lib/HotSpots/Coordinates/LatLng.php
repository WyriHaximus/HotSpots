<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots\Coordinates;

/**
 * Storage for lat, lng pair values.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
final class LatLng {
    
    /**
     * Value for the lat
     * @var int
     */
    private $lat;
    
    /**
     * Value for the lng
     * @var int
     */
    private $lng;
    
    /**
     * Store Size value's.
     * 
     * All value's will be sanitized and forced in a certain range.
     * 
     * @param int $lat lat
     * @param int $lng lng
     */
    public function __construct($lat, $lng) {
        $this->setLat($lat);
        $this->setLng($lng);
    }
    
    /**
     * Set the value for the lat and returns the stored value
     * @param type $lat 
     * @return int 
     */
    public function setLat($lat) {
        $this->lat = $this->sanitized($lat, -90, 90);
        return $this->lat;
    }
    
    /**
     * Returns the value for the lat
     * @return int 
     */
    public function getLat() {
        return $this->lat;
    }
    
    /**
     * Set the value for the lng and returns the stored value
     * @param type $lng 
     * @return int 
     */
    public function setLng($lng) {
        $this->lng = $this->sanitized($lng, -180, 180);
        return $this->lng;
    }
    
    /**
     * Returns the value for the lng
     * @return int 
     */
    public function getLng() {
        return $this->lng;
    }
    
    /**
     * Sanitize value to be int and between $rangeBegin and $rangeend.
     * 
     * @param int $value Value to be sanitized
     * @param int $rangeBegin Begin of the range
     * @param int $rangeEnd End of the range
     * @return int Sanitized and correctly forced value 
     */
    private function sanitized($int, $rangeBegin, $rangeEnd) {
        $int = floatval($int);
        
        if ($int >= $rangeBegin && $rangeEnd >= $int) {
            return $int;
        } else {
            return false;
        }
    }

}