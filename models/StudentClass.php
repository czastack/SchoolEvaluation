<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_class".
 *
 * @property integer $student_id
 * @property integer $class_id
 */
class StudentClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'class_id'], 'required'],
            [['student_id', 'class_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'class_id' => 'Class ID',
        ];
    }
}
