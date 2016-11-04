<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\helper;


class StringHelper extends \yii\helpers\StringHelper
{
    /**
     * 标准化文件名
     *
     * @param string $filename
     * @return string
     */
    public static function normalizeFilename($filename)
    {
        $filename = str_replace("\\", '/', $filename);
        $sections = preg_split('/\//', $filename, -1, PREG_SPLIT_NO_EMPTY);
        return implode('/', $sections);
    }
}