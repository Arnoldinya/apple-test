<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property int $on_tree
 * @property float|null $percent
 * @property int $create_at
 * @property int|null $drop_at
 */
class Apple extends \common\models\tables\Apple
{
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'percent' => 'Сколько съели (%)',
            'create_at' => 'Дата появления',
            'drop_at' => 'Дата падения',
        ];
    }

    public function getOnTreeStatusText()
    {
        return $this->drop_at == null ? 'На дереве' : 'Упало';
    }

    public function getIsRotten()
    {
        return $this->drop_at && (time() - $this->drop_at) / 3600 >= 5 ? true : false;
    }

    public function canDrop(): bool
    {
        return $this->drop_at == null ? true : false;
    }

    public function canEat(): bool
    {
        return $this->drop_at && $this->percent < 100 && !$this->getIsRotten() ? true : false;
    }

    public function canDelete(): bool
    {
        return $this->drop_at && ($this->percent == 100 || $this->getIsRotten()) ? true : false;
    }
}
