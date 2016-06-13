<?php 
use yii\helpers\Html;
if(!isset($textarea))
	$textarea = null;
if(!isset($value))
	$value = null;
?>
<div class="longtext">
	<?=Html::textarea($name, $value, $textarea)?>
</div>