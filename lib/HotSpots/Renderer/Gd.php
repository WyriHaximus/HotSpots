<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotSpots\Renderer;

/**
 * Renders an image from the data using GD.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class Gd implements \HotSpots\RendererInterface {

    /**
     * Contains the size of the image.
     * 
     * @var array 
     */
    private $size = array();

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
     * @param \HotSpots\ColorsInterface $Colors Image size
     * @param int $radius Cell radius
     * @return void
     */
    public function __construct($size, \HotSpots\ColorsInterface $Colors, $radius) {
        $this->size = $size;
        $this->radius = $radius;
        $this->Colors = $Colors;
        $this->ColorsGrayscale = new \HotSpots\Colors\Grayscale();
    }

    /**
     * Push a cell into the matrix.
     * 
     * @param \HotSpots\MatrixInterface $Matrix The Matrix contianing the data
     * @param \HotSpots\WriterInterface $Writer Writer to store the result
     * @return void
     */
    public function render(\HotSpots\MatrixInterface $Matrix, \HotSpots\WriterInterface $Writer) {
        $this->imageRender = imagecreatetruecolor($Matrix->getSize('width'), $Matrix->getSize('height'));
        imagesavealpha($this->imageRender, true);
        imagealphablending($this->imageRender, false);
        $colorWhite = imagecolorallocate($this->imageRender, 255, 255, 255);
        imagefill($this->imageRender, 0, 0, $colorWhite);

        while (($data = $Matrix->next()) !== false) {
            $this->drawCircularGradient($this->imageRender, array(
                'x' => $data['x'],
                'y' => $data['y'],
            ), $this->radius);
        }

        imagefilter($this->imageRender, IMG_FILTER_GAUSSIAN_BLUR);

        for ($i = 0; $i < $Matrix->getSize('width'); $i++) {
            for ($j = 0; $j < $Matrix->getSize('height'); $j++) {
                imagesetpixel($this->imageRender, $i, $j, $this->convertColor($this->imageRender, $this->Colors->getColor(imagecolorat($this->imageRender, $i, $j) & 0xFF)));
            }
        }

        ob_start();
        imagepng($this->imageRender);
        $Writer->write(ob_get_clean());
        imagedestroy($this->imageRender);
    }

    /**
     * Draw the gradient on the image in grascale.
     * 
     * @param resource $image The image we are editing
     * @param array $center Cell center
     * @param int $radius Gradient radius
     * @return void
     */
    private function drawCircularGradient($image, $center, $radius) {
        $done = array();
        for ($r = $radius; $r <= $radius && $r > 0; $r--) {
            $channel = floor((255 / $radius) * $r);
            $angle_step = 0.45 / $r;
            for ($angle = 0; $angle <= M_PI * 2; $angle += $angle_step) {
                $x = floor($center['x'] + $r * cos($angle));
                $y = floor($center['y'] + $r * sin($angle));
                if (!isset($done[$x][$y])) {
                    $previous_channel = @imagecolorat($image, $x, $y) & 0xFF;
                    $new_channel = max(0, min(255, ($previous_channel * $channel) / 255));
                    imagesetpixel($image, $x, $y, $this->convertColor($this->imageRender, $this->ColorsGrayscale->getColor($new_channel)));
                    $done[$x][$y] = true;
                }
            }
        }
    }
    
    private function convertColor($imageResource, \HotSpots\Color $color) {
        return imagecolorallocatealpha($imageResource, $color->getRed(), $color->getGreen(), $color->getBlue(), $color->getAlpha());
    }

}