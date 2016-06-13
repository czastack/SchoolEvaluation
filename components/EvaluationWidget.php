<?php 
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use app\assets\BaseAsset;

class StarAsset extends BaseAsset {
	public $css = ['evaluationWidgets/css/star.css'];
	public $js  = ['evaluationWidgets/js/star.js'];
}

class EvaluationAsset extends BaseAsset {
	public $css = ['evaluationWidgets/css/evaluation.css'];
	public $js  = ['evaluationWidgets/js/evaluation.js'];
}

class EvaluationWidget extends Widget {
	public $type;
	public $params = [];

	public function __set($key, $value){
		if(isset($this->$key))
			parent::__set($key, $value);
		else
			$this->params[$key] = $value;
	}

	public function run()
	{
		EvaluationAsset::register($this->getView());
		
		switch ($this->type) {
		case 'star':
			StarAsset::register($this->getView());
            $this->checkParams(['level'=>5, 'name'=>'']);
			return $this->render('star', $this->params);

		case 'longtext':
			$this->checkSecParam('textarea', 'rows', 10);
			return $this->render('longtext', $this->params);

		case 'checkgroup':
			return $this->render('checkgroup', $this->params);
		}
	}

    private function checkParam($key, $default, &$root = null){
    	if($root === null)
    		$root = &$this->params;

        if (!isset($root[$key]))
            $root[$key] = $default;
    }

    private function checkParams($array, &$root = null){
        foreach ($array as $key => $default) {
	        $this->checkParam($key, $default, $root);
        }
    }

    /* 检查二级参数 */
    private function checkSecParam($node, $key, $default){
        $this->checkParam($node, []);
        $this->checkParam($key, $default, $this->params[$node]);
    }

    /* 检查多个二级参数 */
    private function checkSecParams($node, $array){
        $this->checkParam($node, []);
        $this->checkParams($array, $this->params[$node]);
    }
}
?>