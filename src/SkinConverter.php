<?php

declare(strict_types=1);

namespace matsuyuki\SkinDump;

use GdImage;

class SkinConverter {
    public const CAPACITY_PER_DOT = 4; /* 4byte */

    public static function convert(string $skinData):GdImage {
        $length = (int) floor(sqrt(strlen($skinData) / self::CAPACITY_PER_DOT));
        $image = imagecreatetruecolor($length, $length);
        imagealphablending($image, false);
        imagesavealpha($image, true);
        imagefill($image, 0, 0, imagecolorallocatealpha($image, 0, 0, 0, 127));
        $index = 0;
        for ($y = 0; $y < $length; $y++) {
            for ($x = 0; $x < $length; $x++) {
                $red = ord(substr($skinData, $index * self::CAPACITY_PER_DOT, 1));
                $green = ord(substr($skinData, $index * self::CAPACITY_PER_DOT + 1, 1));
                $blue = ord(substr($skinData, $index * self::CAPACITY_PER_DOT + 2, 1));
                $alpha = 127 - (int) floor(ord(substr($skinData, $index * self::CAPACITY_PER_DOT + 3, 1)) / 2);
                $colorID = imagecolorallocatealpha($image, $red, $green, $blue, $alpha);
                imagesetpixel($image, $x, $y, $colorID);
                $index++;
            }
        }
        return $image;
    }

}