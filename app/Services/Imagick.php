<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class Imagick
{

    /**
     * Exif情報正常化
     * @param string $filepath
     */
    public static function autoOrient($filepath)
    {
        // 画像をimagickのインスタンスを作成
        $imagick_photo = Image::make($filepath)->getCore();

        // 画像のプロパティ
        $properties = $imagick_photo->getImageProperties();

        // autoOrient()もgetImageOrientation()も思ったとおりに動かないため、プロパティを見て自分でrotateする処理
        if (isset($properties['exif:Orientation'])) {
            $orientation = $imagick_photo->getImageProperties()['exif:Orientation'];
            switch ($orientation) {
                case 2:
                    $imagick_photo->flopImage();
                    break;
                case 3:
                    $imagick_photo->rotateImage('#000000', 180);
                    break;
                case 4:
                    $imagick_photo->flipImage();
                    break;
                case 5:
                    $imagick_photo->flopImage();
                    $imagick_photo->rotateImage('#000000', 270);
                    break;
                case 6:
                    $imagick_photo->rotateImage('#000000', 90);
                    break;
                case 7:
                    $imagick_photo->flopImage();
                    $imagick_photo->rotateImage('#000000', 90);
                    break;
                case 8:
                    $imagick_photo->rotateImage('#000000', 270);
                    break;
            }
            //Exif情報を全削除
            $imagick_photo->stripImage();
            //回転させたあとにExifに無回転だと設定
            $imagick_photo->setImageOrientation(1);
            $imagick_photo->writeImage($filepath);
        }
    }

    /**
     * リサイズ
     * @param string $filepath
     * @param int $width
     * @param int $height
     */
    public static function resize($filepath, $width, $height)
    {
        // 画像をimagickのインスタンスを作成
        $imagick_photo = Image::make($filepath)->getCore();

        // リサイズ
        $imagick_photo->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1, true);
        $imagick_photo->writeImage($filepath);
    }

}
