<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher_course_class".
 *
 * @property integer $teacher_id
 * @property integer $course_id
 * @property integer $class_id
 */
class TeacherCourseClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_course_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'course_id', 'class_id'], 'required'],
            [['teacher_id', 'course_id', 'class_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => 'Teacher ID',
            'course_id' => 'Course ID',
            'class_id' => 'Class ID',
        ];
    }
}
