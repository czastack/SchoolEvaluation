<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class".
 *
 * @property integer $class_id
 * @property string $name
 */
class Clazz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'name'], 'required'],
            [['class_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['class_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'class_id' => 'Class ID',
            'name' => 'Name',
        ];
    }
}
