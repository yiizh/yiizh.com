<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;


use common\components\UrlManagerBootstrap;
use common\models\News;
use common\models\Project;
use console\components\BaseConsoleController;
use yii2tech\sitemap\File;
use yii2tech\sitemap\IndexFile;

class SitemapController extends BaseConsoleController
{
    public $defaultAction = 'generate';
    public $generatePath = '@frontend/web/sitemaps';

    protected $urls = [];

    public function init()
    {
        parent::init();
        require(__DIR__ . '/../../frontend/config/bootstrap.php');

        $config = \yii\helpers\ArrayHelper::merge(
            require(__DIR__ . '/../../common/config/main.php'),
            require(__DIR__ . '/../../frontend/config/main.php')
        );

        $application = new \yii\web\Application($config);

        $urlBoot = new UrlManagerBootstrap();
        $urlBoot->bootstrap($application);
    }

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
        $this->addUrl(['/site/index'], ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);
        $this->addUrl(['/site/register'], ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);
        $this->addUrl(['/site/login'], ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);

        // 新闻
        $this->addNews();

        // 开源项目
        $this->addProjects();

        $this->writeFile();
    }

    protected function addNews()
    {
        $models = News::find()
            ->published()
            ->all();

        $this->addUrl(['/news/news/index'], ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);
        foreach ($models as $model) {
            $this->addUrl($model->getUrl(true), ['priority' => '0.2']);
        }
    }

    protected function addProjects(){
        $models = Project::find()
            ->active()
            ->all();

        $this->addUrl(['/project/project/index'], ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_DAILY]);
        foreach ($models as $model) {
            $this->addUrl($model->getUrl(true), ['priority' => '0.2']);
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
        if(is_string($params)){
            return $params;
        }
        return \Yii::$app->urlManager->createAbsoluteUrl($params);
    }
}