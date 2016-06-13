<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $user_id
 * @property integer $student_id
 * @property string $name
 * @property string $sex
 * @property string $dept
 * @property string $class
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'student_id', 'name', 'sex', 'dept', 'class'], 'required'],
            [['user_id', 'student_id'], 'integer'],
            [['name'], 'string', 'max' => 10],
            [['sex'], 'string', 'max' => 2],
            [['dept', 'class'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'student_id' => '学号',
            'name' => '姓名',
            'sex' => '性别',
            'dept' => '学院',
            'class' => '班级',
        ];
    }
}
