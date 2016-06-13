<?php 
namespace app\assets;

class BaseAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
?>