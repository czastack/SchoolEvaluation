<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eval_teaching_prog".
 *
 * @property integer $teacher_id
 * @property integer $course_id
 * @property string $text
 */
class EvalTeachingProg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eval_teaching_prog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'course_id', 'text'], 'required'],
            [['teacher_id', 'course_id'], 'integer'],
            [['text'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => '教师工号',
            'course_id' => '课程号',
            'text' => '文字评价',
        ];
    }
}
