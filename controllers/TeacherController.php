<?php

namespace app\controllers;
use Yii;
use yii\helpers\Html;
use app\models\EvalTeachingProg;
use app\models\EvalOrg;

class TeacherController extends \yii\web\Controller
{
	public function actionIndex()
	{
		return $this->redirect(['evaluation']);
	}

	public function actionSetInfo()
	{
		return $this->render('set-info');
	}

	/**
	 * 显示评价页面
	 */
	public function actionEvaluation()
	{
		if(Yii::$app->user->isGuest)
			return $this->redirect(['user/security/login']);

		$teacher_id = static::getTeacherId();
		// 班级信息列表
		$classInfos = (new \yii\db\Query())
			->select('class.class_id, course.course_id, class.name class_name, course.name course_name')
			->from('teacher_course_class')
			->innerJoin('course', 'course.course_id=teacher_course_class.course_id')
			->innerJoin('class',  'class.class_id=teacher_course_class.class_id')
			->where(['teacher_id'=>$teacher_id])
			->all();

		$finished_class_datas = (new \yii\db\Query())
			->select('class_id')
			->from('eval_class')
			->where(['teacher_id'=>$teacher_id])
			->all();

		// 已填写的班级id列表
		$finished_class_ids = [];
		foreach ($finished_class_datas as $data) {
			$finished_class_ids[] = $data['class_id'];
		}

		$finished = count($classInfos) == count($finished_class_ids);
		$eval_teach_prog = EvalTeachingProg::find()->where(['teacher_id'=>$teacher_id])->one();
		
		if($finished)
			$finished = $eval_teach_prog != null;

		if($finished)
			return $this->render('done', ['finished'=>true]);
		return $this->render('evaluation', 
			[
				'classInfos'=>$classInfos,
				'finished_class_ids'=>$finished_class_ids,
				'eval_teach_prog'=>$eval_teach_prog
			]);
	}

	/**
	 * 保存评价数据
	 */
	public function actionSaveEvaluation()
	{
		$success = false;
		$finished = false;
		// 教学计划评价
		$teacher_id = static::getTeacherId();
		$model = EvalTeachingProg::find()->where(['teacher_id'=>$teacher_id])->one();
		if($model == null)
		{
			// 之前未填写
			$model = new EvalTeachingProg();
			if ($model->load(Yii::$app->request->post())){
				if(!empty($model->text))
				{
					$model->teacher_id = $teacher_id;
					$finished = $success = $model->save();
				}
				else
					$success = true;
			}
		}
		else 
			$finished = $success = true;

		if($success){
			// 职能部门评价
			$user_id = Yii::$app->user->getid();
			$model = EvalOrg::find()->where(['id'=>$user_id])->one();
			if($model == null)
			{
				$model = new EvalOrg();
				if ($model->load(Yii::$app->request->post())){
					if(!empty($model->text) && !empty($model->org_ids)){
						$model->id = $user_id;
						$success = $model->save();
					}
					else
						$success = true;
				}
			}
		}
		if ($success)
		{
			if($finished)
			{
				$all_class_count = (new \yii\db\Query())
					->select('COUNT(*) AS count')
					->from('teacher_course_class')
					->where(['teacher_id'=>$teacher_id])
					->one()['count'];
	
				$finished_class_count = (new \yii\db\Query())
					->select('COUNT(*) AS count')
					->from('eval_class')
					->where(['teacher_id'=>$teacher_id])
					->one()['count'];
	
				if($all_class_count == $finished_class_count)
					$finished = true;
			}

			return $this->render('done', ['finished'=>$finished]);
		}
		else
			return Html::errorSummary($model);
	}

	/**
	 * 保存班级评价数据
	 */
	public function actionSaveEvalClass(){
		$model = new \app\models\EvalClass();
		if ($model->load(Yii::$app->request->post(), "")){
			$model->teacher_id = static::getTeacherId();
			if($model->save())
				return "提交成功";
			else
				return Html::errorSummary($model);
		}
	}

	/**
	 * 获取教师工号
	 */
	public static function getTeacherId()
	{
		return Yii::$app->session['number'];
	}
}
