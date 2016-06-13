<?php 
namespace app\helpers;

class FormHelper {
	public $prefix;

	function __construct($prefix = null) {
		$this->prefix = $prefix;
	}

	public function name($name)
	{
		if($this->prefix != null)
			return $this->prefix . "[$name]";
		else
			return $name;
	}

	public static function csrfField()
	{
		return '<input name="_csrf" type="hidden" value="' . \Yii::$app->request->csrfToken . '"/>';
	}
}
?>