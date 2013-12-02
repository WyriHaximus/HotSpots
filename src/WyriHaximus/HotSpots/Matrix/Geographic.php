<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Matrix;

use Geokit\Clustering\GoogleMapsClusterer;

/**
 * Manages the Matrix and uses the Cacher to store data.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class Geographic implements \WyriHaximus\HotSpots\Interfaces\MatrixInterface {
    
    const OFFSET_2 = 536870912;
    
    private $boundsConversion = array();
    
    /**
     * Setup Matrix
     * 
     * @param \WyriHaximus\HotSpots\Interfaces\CacherInterface $Cacher Image resource
     * @param array $size Matrix size
     * @return void
     */
    public function __construct(\WyriHaximus\HotSpots\Interfaces\CacherInterface $Cacher, $size) {
        $this->Cacher = $Cacher;
        $this->size = $size;
        
        print_r($this->size);
        
        $this->boundsConversion['steps'] = array(
            'height' => self::OFFSET_2 / $this->size['height'],
            'width' => self::OFFSET_2 / $this->size['width'],
        );
        
        $this->boundsConversion['pixels'] = array(
            'test1' => array(
                'lat' => $this->latToY(179),
                'lng' => $this->lonToX(89),
            ),
            'test2' => array(
                'lat' => $this->latToY(0),
                'lng' => $this->lonToX(0),
            ),
            'test3' => array(
                'lat' => $this->latToY(-179),
                'lng' => $this->lonToX(-89),
            ),
            'sw' => array(
                'lat' => (GoogleMapsClusterer::OFFSET + $this->latToY($this->size['bounds']->getSouthWest()->getLatitude())),
                'lng' => (GoogleMapsClusterer::OFFSET + $this->lonToX($this->size['bounds']->getSouthWest()->getLongitude())),
            ),
            'ne' => array(
                'lat' => (GoogleMapsClusterer::OFFSET + $this->latToY($this->size['bounds']->getNorthEast()->getLatitude())),
                'lng' => (GoogleMapsClusterer::OFFSET + $this->lonToX($this->size['bounds']->getNorthEast()->getLongitude())),
            ),
        );
        
        $this->boundsConversion['pixels_2'] = array(
            'sw' => array(
                'lat' => (self::OFFSET_2 - $this->boundsConversion['pixels']['sw']['lat']),
                'lng' => (self::OFFSET_2 - $this->boundsConversion['pixels']['sw']['lng']),
            ),
            'ne' => array(
                'lat' => (self::OFFSET_2 - $this->boundsConversion['pixels']['ne']['lat']),
                'lng' => (self::OFFSET_2 - $this->boundsConversion['pixels']['ne']['lng']), 
           ),
        );
        
        $this->boundsConversion['tl'] = array(
            'x' => self::OFFSET_2 - $this->lonToX($this->size['bounds']->getSouthWest()->getLongitude()),
            'y' => (self::OFFSET_2 - (self::OFFSET_2 - $this->latToY($this->size['bounds']->getNorthEast()->getLatitude()))),
        );
        
        /*$this->boundsConversion['tl'] = array(
            'x' => self::OFFSET_2 - $this->lonToX($this->size['bounds']->getSouthWest()->getLongitude()),
            'y' => (self::OFFSET_2 - (self::OFFSET_2 - $this->latToY($this->size['bounds']->getNorthEast()->getLatitude()))),
        );*/
        
        /*$this->boundsConversion['br'] = array(
            'x' => self::OFFSET_2 - (self::OFFSET_2 - $this->lonToX($this->size['bounds']->getNorthEast()->getLongitude())),
            'y' => self::OFFSET_2 - (self::OFFSET_2 - $this->latToY($this->size['bounds']->getSouthWest()->getLatitude())),
        );*/
        
        /*$this->boundsConversion['tl'] = array(
            'x' => self::OFFSET_2 - $this->lonToX($this->size['bounds']->getSouthWest()->getLongitude()),
            'y' => self::OFFSET_2 - $this->latToY($this->size['bounds']->getNorthEast()->getLatitude()),
        );
        
        $this->boundsConversion['br'] = array(
            'x' => self::OFFSET_2 - $this->lonToX($this->size['bounds']->getNorthEast()->getLongitude()),
            'y' => self::OFFSET_2 - $this->latToY($this->size['bounds']->getSouthWest()->getLatitude()),
        );*/
        
        /*if ($size['bounds']['nw']->getLng() > $size['bounds']['se']->getLng()) {
            $lng = (360 - ($size['bounds']['nw']->getLng() - $size['bounds']['se']->getLng()));
        } else {
            $lng = ($size['bounds']['se']->getLng() - $size['bounds']['nw']->getLng());
        }
        
        $boundsSpan = array(
            'lat' => ($size['bounds']['nw']->getLat() - $size['bounds']['se']->getLat()),
            'lng' => $lng
        );
        $boundsSpan['lat_step'] = ($boundsSpan['lat'] / $this->size['height']);
        $boundsSpan['lng_step'] = ($boundsSpan['lng'] / $this->size['width']);
        print_r($boundsSpan);
        $this->boundsSpan = $boundsSpan;*/
        //$this->size['pixel_bounds']
        
        /*echo "\r\n";
        print_r(self::OFFSET_2 / $this->size['width']);
        echo "\r\n";
        print_r(self::OFFSET_2 / $this->size['height']);
        echo "\r\n";
        print_r($this->size);
        echo "\r\n";
        $base = self::OFFSET_2 - $this->latToY($this->size['bounds']->getSouthWest()->getLatitude());
        print_r($base);
        echo "\r\n";
        for ($i = 0; $i < 21; $i++) {
            $base /= 2;
        }
        print_r($base);
        echo "\r\n";
        $base = self::OFFSET_2 - $this->lonToX($this->size['bounds']->getSouthWest()->getLongitude());
        print_r($base);
        echo "\r\n";
        for ($i = 0; $i < 21; $i++) {
            $base /= 2;
        }
        print_r($base);
        echo "\r\n";
        $base = self::OFFSET_2 - $this->latToY($this->size['bounds']->getNorthEast()->getLatitude());
        print_r($base);
        echo "\r\n";
        for ($i = 0; $i < 21; $i++) {
            $base /= 2;
        }
        print_r($base);
        echo "\r\n";
        $base = self::OFFSET_2 - $this->lonToX($this->size['bounds']->getNorthEast()->getLongitude());
        print_r($base);
        echo "\r\n";
        for ($i = 0; $i < 21; $i++) {
            $base /= 2;
        }
        print_r($base);
        echo "\r\n";
        $base = 256;
        for ($i = 0; $i < 21; $i++) {
            $base *= 2;
        }
        print_r($base);
        echo "\r\n";
        for ($i = 0; $i < 21; $i++) {
            $base /= 2;
        }
        print_r($base);
        echo "\r\n";*/
        print_r($this->boundsConversion);
        //die();
        
        /*ke(a)
        {
            return a[dc]() ? 0 : ie(a) ? 360 - (a.b - a.f) : a.f - a.b;
        }*/
    }

    /**
     * Push a cell into the matrix.
     * 
     * @param int $x Longtitude
     * @param int $y Latitude
     * @param int $value cell value
     * @return void
     */
    public function push($x, $y, $value) {
        
        /*
         * Calculate bounds in pixels at zoom level 21 
         * Stretch the size of the matrix untill it meets up with those bounds and calculate the difference
         */
        
        /*$x = (((abs($this->size['bounds']['nw']->getLng()) + abs($this->size['bounds']['se']->getLng()) / $this->size['width'])) * $x);
        $y = (((abs($this->size['bounds']['nw']->getLat()) + abs($this->size['bounds']['se']->getLat()) / $this->size['height'])) * $y);*/
        /*$x = $this->boundsSpan['lat_step'] * ($x + 180);
        $y = $this->boundsSpan['lng_step'] * abs(90 - $y);*/
        /*$x = ($this->size['width'] / 360) * ($x + 180);
        $y = ($this->size['height'] / 180) * abs(90 - $y);*/
        
        $x = (((self::OFFSET_2 - $this->lonToX($x)) - $this->boundsConversion['tl']['x']) / $this->boundsConversion['steps']['width']);
        $y = (((self::OFFSET_2 - $this->latToY($y)) - $this->boundsConversion['tl']['y']) / $this->boundsConversion['steps']['height']);
        
        //print_r(array($x, $y));
        
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
     * Get the Matrix's size
     * 
     * @return mixed Matrix size
     */
    public function getSize($type = null) {
        if (is_null($type)) {
            return $this->size;
        } else {
            return $this->size[$type];
        }
    }
    
    /**
     * Convert longitude to x.
     *
     * @param float $lon
     * @return float
     */
    protected function lonToX($lon)
    {
        return round(GoogleMapsClusterer::OFFSET + GoogleMapsClusterer::RADIUS * $lon * M_PI / 180);
    }

    /**
     * Convert latitude to y.
     *
     * @param float $lat
     * @return float
     */
    protected function latToY($lat)
    {
        return round(GoogleMapsClusterer::OFFSET - GoogleMapsClusterer::RADIUS *
                log((1 + sin($lat * M_PI / 180)) /
                (1 - sin($lat * M_PI / 180))) / 2);
    }

}