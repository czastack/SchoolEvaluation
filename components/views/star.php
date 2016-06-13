<div class="starWidget<?php if(isset($disabled))echo ' disabled'?>">
<?php 
if(!isset($value))
	$value = null;
for($i = $level; $i > 0; --$i) {
	$c = ($i == $value) ? 'class="active"': '';
	echo "<span $c></span>";
}
echo \yii\helpers\Html::hiddenInput($name, $value);
?>
</div>