<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots;

/**
 * Simple colorer returning color based on color in image.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
final class Color {
    
    /**
     * Value for the color red
     * @var int
     */
    private $red = 0;
    
    /**
     * Value for the color green
     * @var int
     */
    private $green = 0;
    
    /**
     * Value for the color blue
     * @var int
     */
    private $blue = 0;
    
    /**
     * Value for the alpha channel
     * @var int
     */
    private $alpha = 0;
    
    /**
     * Store RGBa value's.
     * 
     * All value's will be sanitized and forced between 0 and 255 (alpha between 0 and 127).
     * 
     * @param int $red Red color value
     * @param int $green Green color value
     * @param int $blue Blue color value
     * @param int $alpha Alpha channel value
     */
    public function __construct($red, $green, $blue, $alpha) {
        $this->setRed($red);
        $this->setGreen($green);
        $this->setBlue($blue);
        $this->setAlpha($alpha);
    }
    
    /**
     * Set the value for the color red and returns the stored value
     * @param int $red
     * @return int 
     */
    public function setRed($red) {
        $this->red = $this->sanitizeColor($red);
        return $this->red;
    }
    
    /**
     * Returns the value for the color red
     * @return int 
     */
    public function getRed() {
        return $this->red;
    }
    
    /**
     * Set the value for the color green and returns the stored value
     * @param int $green
     * @return int 
     */
    public function setGreen($green) {
        $this->green = $this->sanitizeColor($green);
        return $this->green;
    }
    
    /**
     * Returns the value for the color green
     * @return int 
     */
    public function getGreen() {
        return $this->green;
    }
    
    /**
     * Set the value for the color blue and returns the stored value
     * @param int $blue
     * @return int 
     */
    public function setBlue($blue) {
        $this->blue = $this->sanitizeColor($blue);
        return $this->blue;
    }
    
    /**
     * Returns the value for the color blue
     * @return int 
     */
    public function getBlue() {
        return $this->blue;
    }
    
    /**
     * Set the value for the alpha channel and returns the stored value
     * @param int $alpha
     * @return int 
     */
    public function setAlpha($alpha) {
        $this->alpha = $this->sanitizeAlpha($alpha);
        return $this->alpha;
    }
    
    /**
     * Returns the value for the alpha channel
     * @return int 
     */
    public function getAlpha() {
        return $this->alpha;
    }
    
    /**
     * Sanitize value to be int and between 0 and 255.
     * 
     * @param int $value Value to be sanitized
     * @return int Sanitized and correctly forced color value 
     */
    private function sanitizeColor($value) {
        return $this->sanitize($value, 255);
    }
    
    /**
     * Sanitize value to be int and between 0 and 127.
     * 
     * @param int $value Value to be sanitized
     * @return int Sanitized and correctly forced alpha value 
     */
    private function sanitizeAlpha($value) {
        return $this->sanitize($value, 127);
    }

    /**
     * @param int $value
     * @param int $max
     *
     * @return int
     */
    private function sanitize($value, $max) {
        $value = (int) $value;

        if ($value < 0) {
            $value = 0;
        } else if ($value > $max) {
            $value = $max;
        }

        return $value;
    }

}