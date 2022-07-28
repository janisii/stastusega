<?php

/**
 * Calculate average color from the image
 * http://php.net/manual/en/function.imagecolorat.php
 * @param $img
 * @return string
 */
function averageImageHexColor($pathToImage) {
    $img = imagecreatefromjpeg($pathToImage);
    $w = imagesx($img);
    $h = imagesy($img);
    $r = $g = $b = 0;
    for($y = 0; $y < $h; $y++) {
        for($x = 0; $x < $w; $x++) {
            $rgb = imagecolorat($img, $x, $y);
            $r += $rgb >> 16;
            $g += $rgb >> 8 & 255;
            $b += $rgb & 255;
        }
    }
    $pxls = $w * $h;
    $r = dechex(round($r / $pxls));
    $g = dechex(round($g / $pxls));
    $b = dechex(round($b / $pxls));
    if(strlen($r) < 2) {
        $r = 0 . $r;
    }
    if(strlen($g) < 2) {
        $g = 0 . $g;
    }
    if(strlen($b) < 2) {
        $b = 0 . $b;
    }
    return "#" . $r . $g . $b;
}

/**
 * Output Image with Glide
 * @param $imageFile
 * @param $params
 */
function outputImage($imageFile, $params) {
        $server = \League\Glide\ServerFactory::create([
            'source' => public_path('/uploads/images/'),
            'cache' => public_path('/uploads/images/cache'),
        ]);
        return $server->outputImage($imageFile, $params);
}

/**
 * Get author name from filename
 * @param $filename
 * @return mixed
 */
function getNameFromFileName($filename) {

    // remove extension
    $extension = strrchr($filename, '.');
    $name = str_replace($extension, '', $filename);

    // remove underscores
    $name = str_replace(array('_', '.', ','), array(' ', '', ''), $name);

    // remove starting num
    $name = preg_replace('/^[0-9]+\s/', '', $name);

    // lv chars removed
    $name = replaceLVChars($name);

    return $name;
}

/**
 * Replace LV chars with latin
 * @param $string
 * @return null|string|string[]
 */
function replaceLVChars($string) {
    $maLetters = ['ā','č','ē', 'ģ','ī', 'ķ', 'ļ', 'ņ', 'š', 'ū', 'ž', 'Ā','Č','Ē', 'Ģ','Ī', 'Ķ', 'Ļ', 'Ņ', 'Š', 'Ū', 'Ž'];
    $reLetters = ['a','c','e', 'g','i', 'k', 'l', 'n', 's', 'u', 'z', 'A','C','E', 'G','I', 'K', 'L', 'N', 'S', 'U', 'Z'];
    return str_replace($maLetters, $reLetters, $string);
}

/**
 * Helper function to pass content to Javascript components
 */
function script_json_import() {
    $frames = \App\Frame::orderBy('id', 'asc')->get()->toJson();
    $imageItems = \App\Image::allImageItemsJson();

    $html = "<script type='text/javascript'>
/* <![CDATA[ */
var frames = " . $frames . ";
var imageItems = " . $imageItems . ";
/* ]]> */
</script>";

    echo $html;
}