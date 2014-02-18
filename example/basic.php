<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$Matrix = new \WyriHaximus\HotSpots\Matrix\Simple(new \WyriHaximus\HotSpots\Cacher\Memory(), array(
  'height' => 256,
  'width' => 256,
));
$Renderer = new \WyriHaximus\HotSpots\Renderer\Gd(array(
  'height' => 256,
  'width' => 256,
), new \WyriHaximus\HotSpots\Colors\Image('ClassicAlpha'), 50);

$Matrix->push(0, 0, 0);
$Matrix->push(1, 1, 0);
$Matrix->push(2, 2, 0);
$Matrix->push(4, 4, 0);
$Matrix->push(8, 8, 0);
$Matrix->push(16, 16, 0);
$Matrix->push(32, 32, 0);
$Matrix->push(64, 64, 0);
$Matrix->push(128, 128, 0);
$Matrix->push(256, 256, 0);

$Renderer->render($Matrix, new \WyriHaximus\HotSpots\Writer\File('basic.png'));