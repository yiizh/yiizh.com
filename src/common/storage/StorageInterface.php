<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\storage;

interface StorageInterface
{
    /**
     * @param string $filename
     * @param string $contents
     * @return boolean 是否写入成功
     */
    public function write($filename, $contents);

    /**
     * @param string $filename 文件名
     * @return string|false
     */
    public function read($filename);

    /**
     * @param string $filename 需要删除的文件名
     * @return boolean 是否删除成功
     */
    public function delete($filename);
}