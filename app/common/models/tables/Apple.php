<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property float|null $percent
 * @property int $create_at
 * @property int|null $drop_at
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'create_at'], 'required'],
            [['create_at', 'drop_at'], 'integer'],
            [['percent'], 'number'],
            [['color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'percent' => 'Percent',
            'create_at' => 'Create At',
            'drop_at' => 'Drop At',
        ];
    }
}
