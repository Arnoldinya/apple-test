<?php

namespace backend\models;

use common\models\Apple;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class BackendApple extends Apple
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at'],
                ],
            ],
        ];
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['percent'], 'number', 'min' => 0, 'max' => 100],
        ]);
    }

    public function generateAppleColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function generateApples(int $cnt)
    {
        $rows = [];
        for ($i = 0; $i < $cnt; $i++) { 
            $rows[] = [
                'color' => $this->generateAppleColor(),
                'percent' => 0,
                'create_at' => time(),
            ];
        }
        Yii::$app->db->createCommand()->batchInsert(self::tableName(), ['color', 'percent', 'create_at'], $rows)->execute();
    }
}
