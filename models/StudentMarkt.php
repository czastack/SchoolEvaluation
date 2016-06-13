<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "studentmarkt".
 *
 * @property integer $student_id
 * @property integer $teacher_id
 * @property integer $ktfc
 * @property integer $khfd
 * @property integer $rwml
 * @property string $totw
 * @property string $ottr
 */
class StudentMarkt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'studentmarkt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'teacher_id', 'ktfc', 'khfd', 'rwml'], 'required'],
            [['ktfc', 'khfd', 'rwml'], 'integer'],
            [['student_id', 'teacher_id'], 'integer'],
            [['totw', 'ottr'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => '学号',
            'ktfc' => '课堂风采',
            'khfd' => '课后辅导',
            'rwml' => '人物魅力',
            'totw' => '文字评价',
            'ottr' => '热词',
            'teacher_id' => '教师工号',
        ];
    }
}
