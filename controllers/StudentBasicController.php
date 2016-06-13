<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Html;
use app\models\Student;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\StudentClass;
use app\models\TeacherCourseClass;

/**
 * StudentBasicController implements the CRUD actions for Student model.
 */
class StudentBasicController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index',],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex() {
        if (($studentmark1 = \app\models\StudentMark1::find()->where(['student_id' => \Yii::$app->session['number']])->one()) || (\app\models\StudentMarkt::find()->where(['student_id' => \Yii::$app->session['number']])->all())) {//对教师或教师已填写
            \Yii::$app->session['studentmark1'] = $studentmark1;   //学生对学校的必填项
            $datas = $this->actionAssociated();
            $studentmarkt = [];
            foreach ($datas['courses'] as $data) {
                $data1 = \app\models\StudentMarkt::find()->where(['teacher_id' => $data['teacher_id']])->one();
                if ($data1) {            //已评价该教师
                    $studentmarkt[] = [
                        'teacher_id' => $data1->teacher_id,
                    ];
                } else {
                    $studentmarkt[] = [
                        'teacher_id' => 0,
                    ];
                }
            }
            $ok = true;
            foreach ($studentmarkt as $data) {
                if ($data['teacher_id'] === 0) {
                    $ok = false;
                    break;
                }
            }
            if ($studentmark1)
                foreach ($studentmark1 as $data) {
                    if ($data == null) {
                        $ok = false;
                        break;
                    }
                } else
                $ok = false;
            if ($ok)
                return $this->render('done', ['difference' => 1]);
            else
                return $this->updateStudent($studentmark1, $studentmarkt);
        }
        /* 首次登入评价 */
        else {
            return $this->newStudent($studentmark1, ['teacher_id' => 0]);
        }
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     */
    //学生追加完成评价
    private function updateStudent($studentmark1, $studentmarkt) {
        $data = $this->actionAssociated();
        return $this->render('index', [
                    'dataProvider' => $data['dataProvider'],
                    'courses' => $data['courses'],
                    'studentmark1' => $studentmark1,
                    'studentmarkt' => $studentmarkt,
        ]);
    }

    /* 学生初次登陆 */

    private function newStudent($studentmark1, $studentmarkt) {
        $data = $this->actionAssociated();
        return $this->render('index', [
                    'dataProvider' => $data['dataProvider'],
                    'courses' => $data['courses'],
                    'studentmark1' => $studentmark1,
                    'studentmarkt' => $studentmarkt,
        ]);
    }

    /* 获取学生关联的课程与教师 */

    private function actionAssociated() {
        $query = Student::find()->where(['student_id' => \Yii::$app->session['number']]);  //查找db对象，供GridView输出数据
        $datas = StudentClass::find()->where(['student_id' => \Yii::$app->session['number']])->all();
        $courses = [];
        foreach ($datas as $key => $data) {
            $relation = TeacherCourseClass::find()->where(['class_id' => $data->class_id])->one();
            $course = \app\models\Course::find()->where(['course_id' => $relation->course_id])->one();
            $teacher = \app\models\Teacher::find()->where(['teacher_id' => $relation->teacher_id])->one();
            $courses[] = [
                'course_name' => $course->name,
                'teacher_name' => $teacher->name,
                'teacher_id' => $teacher->teacher_id];
        }
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        return ['courses' => $courses, 'dataProvider' => $dataProvider];
    }

    /* 提示是否完成评价 */

    public function actionSetMessage() {
        if (($studentmark1 = \app\models\StudentMark1::find()->where(['student_id' => \Yii::$app->session['number']])->one()) || (\app\models\StudentMarkt::find()->where(['student_id' => \Yii::$app->session['number']])->all())) {//对教师或教师已填写
            $datas = $this->actionAssociated();
            foreach ($datas['courses'] as $data) {
                $data1 = \app\models\StudentMarkt::find()->where(['teacher_id' => $data['teacher_id']])->one();
                if (!$data1) {            //已评价该教师
                    return $this->render('done', ['difference' => 0]); //未全部填写评价
                }
            }
            foreach ($studentmark1 as $data) {
                if ($data == null) {
                    return $this->render('done', ['difference' => 0]); //未全部填写评价
                }
            }
            return $this->render('done', ['difference' => 1]);  //已完成评价     
        }
        /* 未完成评价 */ else {
            $this->render('done', ['difference' => 0]); //未全部填写评价
        }
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $StudentMark2 = new \app\models\StudentMark2();
        $id = \Yii::$app->user->getId();
        $student = Student::findOne($id);
        $StudentMark2->student_id = $student->student_id;
        $studentmark11 = new \app\models\StudentMark1();
        $studentmark11->load(Yii::$app->request->post(), "");
        $StudentMark1 = \app\models\StudentMark1::find()->where(['student_id' => $student->student_id])->one();

        // 旧的
        $studentmark1 = \app\models\StudentMark1::find()->where(['student_id' => \Yii::$app->session['number']])->one();
        if ($studentmark1) {
            if ($studentmark1->zt == null)
                $StudentMark1->zt = $studentmark11->zt;
            if ($studentmark1->jxhj == null)
                $StudentMark1->jxhj = $studentmark11->jxhj;
            if ($studentmark1->zshj == null)
                $StudentMark1->zshj = $studentmark11->zshj;
            if ($studentmark1->yshj == null)
                $StudentMark1->yshj = $studentmark11->yshj;
        } else
            $studentmark11->student_id = $student->student_id;
        if ($StudentMark1 && $StudentMark1->save() || $studentmark11->save()) {
            $StudentMark2->load(Yii::$app->request->post(), "");
            if ($StudentMark2->save())
                return $this->redirect(['set-message']);
        }
        return Html::errorSummary($studentmark11);
    }

    public function actionTeacher() {
        $model = new \app\models\StudentMarkt();
        if ($model->load(Yii::$app->request->post(), "")) {
            $id = Yii::$app->user->getId();
            $student = Student::findOne($id);
            $model->student_id = $student->student_id;
            if ($model->save())
                echo '提交成功';
            else
                echo \yii\helpers\Html::errorSummary($model);
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
