<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\components\EvaluationWidget;
use app\helpers\FormHelper;

class EvaluationViewAsset extends app\assets\BaseAsset {
	public $css = ['teacher/evaluation.css'];
	public $js  = ['teacher/evaluation.js'];
}

$this->title = "2015-2016学年 上学期总评";
$this->params['breadcrumbs'][] = $this->title;

EvaluationViewAsset::register($this);
?>

<h1>2015-2016学年 上学期总评</h1>
<?php echo Html::beginForm(['teacher/save-evaluation']) ?>

	<!-- 班级评价 -->
	<h2 class="group_title"><span>班级评价</span></h2>
	<ul class="class-list list-unstyled">
	<!-- 班级列表开始 -->
	<?php foreach ($classInfos as $data) { 
		$ext_class = null;
		if(in_array($data['class_id'], $finished_class_ids))
			$ext_class = ' finished';
		?>
		<li class="col-lg-3 col-md-4 col-sm-6">
			<div class="class-item<?=$ext_class?>" class_id="<?=$data['class_id']?>">
				<img src="teacher/testClass.jpg" alt="" />
				<span class="course_name"><?=$data['course_name']?></span>
				<span class="class_name"><?=$data['class_name']?></span>
			</div>
		</li>
		<?php } /* 班级列表结束 */ ?>
	</ul>
	<div class="separator"></div>

	<?php $formHelper = new FormHelper('EvalTeachingProg'); ?>

	<h2 class="group_title"><span>教学计划评价</span></h2>
	<?=Html::hiddenInput($formHelper->name('course_id'), 1)?>

	<?=EvaluationWidget::widget([
		'type'=>'longtext',
		'name'=>$formHelper->name('text'),
		'imgname'=>$formHelper->name('img'),
		'textarea' =>[
			'rows'=>15,
			'required'=>'required',
			'disabled'=>$eval_teach_prog != null
		],
		'value'=>$eval_teach_prog ? $eval_teach_prog->text : null
		])?>

	<h2 class="group_title"><span>部门评价</span></h2>

	<?php
	/* 部门评价开始 */
	$formHelper->prefix = 'EvalOrg';

	echo EvaluationWidget::widget([
		'type'=>'longtext',
		'name'=>$formHelper->name('text'),
		'textarea' =>[
			'rows'=>15,
			'placeholder'=>'可选文字评价，相应职能部门将收到您的文字评价并可对您回复'
		]
	]);

	// 读取机构列表
	$data = [];
	foreach (app\models\Organization::find()->each(10) as $org) {
		$data[] = ['name' => $formHelper->name('org_' . $org->org_id), 'label' => $org->name];
	}

	echo EvaluationWidget::widget([
		'type'=>'checkgroup',
		'params' => [
			'title'=>'以下勾选的职能部门将收到我的补充评价：',
			'items' => $data,
		]
	])
	/* 部门评价结束 */
	?>

	<div class="separator"></div>
	<div class="text-center">
		<input type="submit" id="submit" value="评价完成，提交" />
	</div>


<?php 
echo Html::endForm();

// 模态框
Modal::begin([
	'header' => '<h2></h2>',
	'id' => 'evalClassDialog',
	'size' => Modal::SIZE_LARGE ,
	'footer' => '
		<button class="btn btn-default" data-dismiss="modal">关闭</button>
		<button class="btn btn-primary" id="ajaxSubmit">提交</button>']);

	echo Html::beginForm(['teacher/save-eval-class'], 'post', ['id'=>'ajaxForm'])
	?>
		<input name="class_id" type="hidden" value="2" />

		<div class="row">
			<div class="col-lg-5">
				<img class="classImg" src="" alt="" />
			</div>
			<div class="col-lg-7">
				<!-- 打分项 -->
				<div class="starsRow">
					<span>课堂纪律</span>
					<?=EvaluationWidget::widget(['type'=>'star', 'name'=>'classroom_discipline'])?>
				</div>
				<div class="starsRow">
					<span>作业情况</span>
					<?=EvaluationWidget::widget(['type'=>'star', 'name'=>'homework_quality'])?>
				</div>
				<div class="starsRow">
					<span>学习氛围</span>
					<?=EvaluationWidget::widget(['type'=>'star', 'name'=>'study_atmosphere'])?>
				</div>
				<div class="starsRow">
					<span>学生潜力</span>
					<?=EvaluationWidget::widget(['type'=>'star', 'name'=>'student_potential'])?>
				</div>

				<textarea name="text_eval" id="class_text_eval" rows="5" placeholder="可选文字评价"></textarea>
			</div>
		</div>
		<div class="result-container">
			<div class="separator"></div>
			<div class="result"></div>
		</div>
<?php 
	echo Html::endForm();
Modal::end();
?>