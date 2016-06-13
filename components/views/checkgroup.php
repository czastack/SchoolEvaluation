<?php 
use yii\helpers\Html;
?>
<div class="checkgroup">
	<p><?=$title?></p>
	<?php foreach ($items as $r) {
		echo Html::checkbox($r['name'], isset($r['checked']) && $r['checked'], ['label' => $r['label']]);
	} ?>
</div>