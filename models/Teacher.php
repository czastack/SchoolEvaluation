<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property integer $user_id
 * @property integer $teacher_id
 * @property string $name
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'teacher_id', 'name'], 'required'],
            [['user_id', 'teacher_id'], 'integer'],
            [['name'], 'string', 'max' => 10],
            [['teacher_id'], 'unique'],
            [['user_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'teacher_id' => '教师工号',
            'name' => '姓名',
        ];
    }
}
