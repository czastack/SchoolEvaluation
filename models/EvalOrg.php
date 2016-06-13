<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eval_org".
 *
 * @property integer $id
 * @property string $text
 * @property string $org_ids
 */
class EvalOrg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eval_org';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'text', 'org_ids'], 'required'],
            [['id'], 'integer'],
            [['text'], 'string', 'max' => 200],
            [['org_ids'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户id',
            'text' => '部门评价',
            'org_ids' => '收到该评价的部门id列表',
        ];
    }
}
