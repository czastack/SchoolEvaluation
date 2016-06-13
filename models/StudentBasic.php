<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "studentbasic".
 *
 * @property integer $id
 * @property string $student_id
 * @property string $name
 * @property string $sex
 * @property string $dept
 * @property string $class
 */
class StudentBasic extends \yii\db\ActiveRecord
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
            [['student_id'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 15],
            [['sex'], 'string', 'max' => 2],
            [['dept', 'class'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => '学号',
            'name' => '姓名',
            'sex' => '性别',
            'dept' => '学院',
            'class' => '班级',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::clasname(),['id'=>'id']);
    }
}
