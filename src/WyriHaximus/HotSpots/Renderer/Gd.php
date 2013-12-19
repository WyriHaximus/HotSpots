<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Renderer;

/**
 * Renders an image from the data using GD.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class Gd implements \WyriHaximus\HotSpots\Interfaces\RendererInterface {

    /**
     * Contains the size of the image.
     * 
     * @var array 
     */
    private $size = array();
    
    /**
     * List of all drawn pixels.
     * 
     * @var array 
     */
    private $pixels = array();

    /**
     * The radius of cells.
     * 
     * @var int
     */
    private $radius = 30;

    /**
     * The Colorer that is used to convert from grayscale.
     * 
     * @var int
     */
    private $Colors = null;

    /**
     * Setup the renderer
     * 
     * @param array $size Image size
     * @param \WyriHaximus\HotSpots\Interfaces\ColorsInterface $Colors Image size
     * @param int $radius Cell radius
     * @return void
     */
    public function __construct($size, \WyriHaximus\HotSpots\Interfaces\ColorsInterface $Colors, $radius) {
        $this->size = $size;
        $this->radius = $radius;
        $this->Colors = $Colors;
        $this->ColorsGrayscale = new \WyriHaximus\HotSpots\Colors\Grayscale();
    }

    /**
     * Push a cell into the matrix.
     * 
     * @param \WyriHaximus\HotSpots\MatrixInterface $Matrix The Matrix contianing the data
     * @param \WyriHaximus\HotSpots\WriterInterface $Writer Writer to store the result
     * @return void
     */
    public function render(\WyriHaximus\HotSpots\Interfaces\MatrixInterface $Matrix, \WyriHaximus\HotSpots\Interfaces\WriterInterface $Writer) {
        $this->imageRender = imagecreatetruecolor($Matrix->getSize('width'), $Matrix->getSize('height'));
        imagefilledrectangle($this->imageRender, 0, 0, ($Matrix->getSize('width') - 1), ($Matrix->getSize('height') - 1), $this->convertColor($this->imageRender, $this->ColorsGrayscale->getColor(255)));
        
        while (($data = $Matrix->next()) !== false) {
            $this->drawCircularGradient(array(
                'x' => $data['x'],
                'y' => $data['y'],
            ), $this->radius);
        }

        imagefilter($this->imageRender, IMG_FILTER_GAUSSIAN_BLUR);
        
        $this->imageRenderResult = imagecreatetruecolor($Matrix->getSize('width'), $Matrix->getSize('height'));
        imagesavealpha($this->imageRenderResult, true);
        imagealphablending($this->imageRenderResult, false);
        imagefilledrectangle($this->imageRenderResult, 0, 0, ($Matrix->getSize('width') - 1), ($Matrix->getSize('height') - 1), $this->convertColor($this->imageRenderResult, $this->Colors->getColor(255)));
        foreach ($this->pixels as $pixel) {
            list($i, $j) = explode('_', $pixel);
            if ($i >= 0 && $i < $Matrix->getSize('width') && $j >= 0 && $j < $Matrix->getSize('height')) {
                imagesetpixel($this->imageRenderResult, $i, $j, $this->convertColor($this->imageRenderResult, $this->Colors->getColor(imagecolorat($this->imageRender, $i, $j) & 0xFF)));
            }
        }

        ob_start();
        imagepng($this->imageRenderResult);
        $Writer->write(ob_get_clean());
        imagedestroy($this->imageRender);
        imagedestroy($this->imageRenderResult);
    }

    /**
     * Draw the gradient on the image in grascale.
     * 
     * @param resource $image The image we are editing
     * @param array $center Cell center
     * @param int $radius Gradient radius
     * @return void
     */
    private function drawCircularGradient($center, $radius) {
        $done = array();
        for ($r = $radius; $r <= $radius && $r > 0; $r--) {
            $channel = floor((255 / $radius) * $r);
            $angle_step = 0.45 / $r;
            for ($angle = 0; $angle <= M_PI * 2; $angle += $angle_step) {
                $x = floor($center['x'] + $r * cos($angle));
                $y = floor($center['y'] + $r * sin($angle));
                if ($x >= 0 && $x <= $this->size['width'] && $y >= 0 && $y <= $this->size['height'] && !isset($done[$x][$y])) {
                    $previous_channel = @imagecolorat($this->imageRender, $x, $y) & 0xFF;
                    $new_channel = max(0, min(255, ($previous_channel * $channel) / 255));
                    imagesetpixel($this->imageRender, $x, $y, $this->convertColor($this->imageRender, $this->ColorsGrayscale->getColor($new_channel)));
                    $done[$x][$y] = true;
                    $this->addPixelsCluster($x, $y);
                }
            }
        }
    }
    
    /*
     * Convert a color into a resource
     * 
     * @param resource $image The image we are creating the color  for
     * @param \WyriHaximus\HotSpots\Color $color The color to convert
     * @return resource
     */
    private function convertColor($imageResource, \WyriHaximus\HotSpots\Color $color) {
        return imagecolorallocatealpha($imageResource, $color->getRed(), $color->getGreen(), $color->getBlue(), $color->getAlpha());
    }
    
    /*
     * Don't just add the supplied pixel but also the ones around it due to the blur applied to the greyscale heatmap.
     * 
     * @param int $x X coordinate
     * @param int $y Y coordinate
     * @return void
     */
    private function addPixelsCluster($x, $y) {
        for ($i = ($x - 2); $i < ($x + 2); $i++) {
            for ($j = ($y - 2); $j < ($y + 2); $j++) {
                $this->pixels[$i . '_' . $j] = $i . '_' . $j;
            }
        }
    }

}