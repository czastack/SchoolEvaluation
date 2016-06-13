<?php

use yii\helpers\Html;
use app\assets\AppAsset;

class IndexAsset extends app\assets\BaseAsset {
	public $css = ['css/index.css'];
}

AppAsset::register($this);
IndexAsset::register($this);
$this->title = '师生综合评价互动系统';
$this->beginPage()
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<div class="container">
		<div class="site-index">
			<div class="jumbotron animated bounceInDown">   <!--bounceInDown-->
				<h1>师生互动评价系统</h1>
				<p class="lead">使用前请阅读下面的使用说明</p>
				<p>
					<?php
					if(Yii::$app->user->isGuest) 
						echo Html::a('登录评价系统', ['user/security/login'], ['class'=>'btn btn-lg btn-success']);
					else
						echo Html::a('已登录，去评价', ['user-center/index'], ['class'=>'btn btn-lg btn-success']);
					?>
				</p>
			</div>

			<div class="body-content">

				<div class="row">
					<div class="container shuom1 animated bounceInRight" >
						<h2>登录方式</h2>

						<p>默认登录账号为学生学号和教师工号，初始密码为学号后六位。<br />
							现阶段提供测试账号如下<br/>
							学生帐号：student 密码：123456<br/>
							教师帐号：teacher 密码：123456
						</p>			  
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
