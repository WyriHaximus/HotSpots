[![Build Status](https://secure.travis-ci.org/WyriHaximus/HotSpots.png)](http://travis-ci.org/WyriHaximus/HotSpots)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/HotSpots/v/stable.png)](https://packagist.org/packages/WyriHaximus/HotSpots)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/HotSpots/downloads.png)](https://packagist.org/packages/WyriHaximus/HotSpots)
[![Coverage Status](https://coveralls.io/repos/WyriHaximus/HotSpots/badge.png)](https://coveralls.io/r/WyriHaximus/HotSpots)
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/WyriHaximus/HotSpots/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

HotSpots is a heatmap image generation library.

## Installation ##

Installation is easy with composer just add HotSpots to your composer.json.

```json
{
	"require": {
		"wyrihaximus/hotspots": "dev-master"
	}
}
```

## Basic usage ##

```php
<?php

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
```

Resulting image:

![Basic example result](https://raw.github.com/WyriHaximus/HotSpots/master/example/basic.png)

## License ##

Copyright 2012 - 2014 [Cees-Jan Kiewiet](http://wyrihaximus.net/)

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

