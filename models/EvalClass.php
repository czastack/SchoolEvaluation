<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eval_class".
 *
 * @property integer $teacher_id
 * @property integer $class_id
 * @property integer $classroom_discipline
 * @property integer $homework_quality
 * @property integer $study_atmosphere
 * @property integer $student_potential
 * @property string $text_eval
 */
class EvalClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eval_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'class_id', 'classroom_discipline', 'homework_quality', 'study_atmosphere', 'student_potential'], 'required'],
            [['teacher_id', 'class_id', 'classroom_discipline', 'homework_quality', 'study_atmosphere', 'student_potential'], 'integer'],
            [['text_eval'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => '教师工号',
            'class_id' => '班级号',
            'classroom_discipline' => '课堂纪律',
            'homework_quality' => '作业情况',
            'study_atmosphere' => '学习氛围',
            'student_potential' => '学生潜力',
            'text_eval' => '可选文字评价',
        ];
    }
}
