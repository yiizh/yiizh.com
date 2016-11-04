<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\helper;


class FileHelper extends \yii\helpers\FileHelper
{
    public static $inlineMimeTypes = [
        'text/plain',
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/gif',
        'image/bmp'
    ];

    public static $inlineExtensions = [
        'txt',
        'text',
        'png',
        'jpg',
        'jpeg',
        'gif',
        'bmp'
    ];

    public static $imageMimeTypes = [
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/gif',
        'image/bmp'
    ];

    public static $imageExtensions = [
        'png',
        'jpg',
        'jpeg',
        'gif',
        'bmp'
    ];

    /**
     * @param string $mimeType
     * @return bool
     */
    public static function getIsInlineByMimeType($mimeType)
    {
        return in_array($mimeType, self::$inlineMimeTypes);

    }

    /**
     * @param string $extension
     * @return bool
     */
    public static function getIsInlineByExtension($extension)
    {
        return in_array($extension, self::$inlineExtensions);
    }

    /**
     * @param string $mimeType
     * @return bool
     */
    public static function getIsImageByMimeType($mimeType)
    {
        return in_array($mimeType, self::$imageMimeTypes);

    }

    /**
     * @param string $extension
     * @return bool
     */
    public static function getIsImageByExtension($extension)
    {
        return in_array($extension, self::$imageExtensions);
    }
}