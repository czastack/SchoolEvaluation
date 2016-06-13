<?php 
namespace app\controllers;
use yii\web\Controller;

class UserCenterController extends Controller
{
	/* 用户区分 */
	public function actionIndex()
	{
		if (!\Yii::$app->user->isGuest) {
			$userid = \Yii::$app->user->getid();
			if(($data = \app\models\Student::findOne($userid))){
				// 是学生
				\Yii::$app->session['number'] = $data->student_id;
				\Yii::$app->session['isTeacher'] = false;
				return $this->redirect(['student-basic/index']);
			} else if(($data = \app\models\Teacher::findOne($userid))) {
				// 是教师
				\Yii::$app->session['number'] = $data->teacher_id;
				\Yii::$app->session['isTeacher'] = true;
				return $this->redirect(['teacher/evaluation']);
			}
		}
		else
			$this->redirect(['user/security/login']);
	}
}
 ?>