<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "studentmark1".
 *
 * @property string $student_id
 * @property integer $zt
 * @property integer $jxhj
 * @property integer $zshj
 * @property integer $yshj
 */
class StudentMark1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'studentmark1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id'], 'required'],
            [['student_id', 'zt', 'jxhj', 'zshj', 'yshj'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'student_id',
            'zt' => 'Zt',
            'jxhj' => 'Jxhj',
            'zshj' => 'Zshj',
            'yshj' => 'Yshj',
        ];
    }
}
