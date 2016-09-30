<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;


use common\helpers\UrlManagerHelper;
use common\models\News;
use console\components\BaseConsoleController;
use yii2tech\sitemap\File;
use yii2tech\sitemap\IndexFile;

class SitemapController extends BaseConsoleController
{
    public $defaultAction = 'generate';
    public $generatePath = '@frontend/web/sitemaps';

    protected $urls = [];

    /**
     * @param array|string $url
     * @param array $options
     */
    protected function addUrl($url, array $options)
    {
        $options['url'] = $this->createUrl($url);
        $this->urls[] = $options;
    }

    public function actionGenerate()
    {
        // 独立页面
        $this->addUrl($this->createUrl(['/site/index']), ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);
        $this->addUrl($this->createUrl(['/site/register']), ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);
        $this->addUrl($this->createUrl(['/site/login']), ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);

        // 新闻
        $this->addNews();

        $this->writeFile();
    }

    protected function addNews()
    {
        $models = News::find()
            ->published()
            ->all();

        $this->addUrl(['/news/index'], ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);
        foreach ($models as $model) {
            $this->addUrl(['/news/view', 'id' => $model->id], ['priority' => '0.2']);
        }
    }

    /**
     * 写入文件
     */
    protected function writeFile()
    {
        $urls = $this->urls;

        $siteMapFileCount = 0;
        while ($item = array_shift($urls)) {
            if (empty($siteMapFile)) {
                $siteMapFile = new File([
                    'fileBasePath' => $this->generatePath
                ]);
                $siteMapFileCount++;
                $siteMapFile->fileName = 'item_' . $siteMapFileCount . '.xml';
            }

            $url = $item['url'];
            unset($item['url']);
            $siteMapFile->writeUrl($url, $item);
            if ($siteMapFile->getIsEntriesLimitReached()) {
                unset($siteMapFile);
            }
        }

        $siteMapIndexFile = new IndexFile([
            'fileBasePath' => $this->generatePath,
            'fileBaseUrl' => $this->createUrl(['/']) . 'sitemaps'
        ]);

        $siteMapIndexFile->writeUp();
    }

    /**
     * @param array|string $params
     * @return string
     */
    public function createUrl($params)
    {
        return UrlManagerHelper::getFrontend()->createUrl($params);
    }
}