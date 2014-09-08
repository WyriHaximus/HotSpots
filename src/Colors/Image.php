<?php

/*
 * This file is part of HotSpots.
 *
 * (c) 2012 - 2013 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\HotSpots\Colors;

/**
 * Simple colorer returning color based on color in image.
 *
 * @package HotSpots
 * @author  Cees-Jan Kiewiet <ceesjank@gmail.com>
 */
class Image implements \WyriHaximus\HotSpots\Interfaces\ColorsInterface
{
    /**
     * @var resource
     */
    private $image;

    /**
     * @var array
     */
    private $colors = array();

    /**
     * Store $fileName internaly.
     *
     * @param string $gradient Gradient filename in SimpleImages
     * @throws \WyriHaximus\HotSpots\Exceptions\FileNotFoundException
     */
    public function __construct($gradient)
    {
        $fileName = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Images' . DIRECTORY_SEPARATOR . $gradient . '.png';
        if (!file_exists($fileName)) {
            throw new \WyriHaximus\HotSpots\Exceptions\FileNotFoundException('File not found: ' . $fileName);
        }
        $this->image = imagecreatefrompng($fileName);
        $this->colors = array();
    }

    /**
     * Get the color by the channel (0 - 255).
     *
     * @param int $channel Color channel
     * @return \WyriHaximus\HotSpots\Color $value value for the cell
     */
    public function getColor($channel)
    {
        $channel = (int) $channel;

        if ($channel > 255 || $channel < 0) {
            return false;
        }

        if (!isset($this->colors[$channel])) {
            $rgb = @imagecolorat($this->image, 255 - $channel, 0);
            $colors = imagecolorsforindex($this->image, $rgb);

            $this->colors[$channel] = new \WyriHaximus\HotSpots\Color($colors['red'], $colors['green'], $colors['blue'], $colors['alpha']);
        }

        return $this->colors[$channel];
    }

}
