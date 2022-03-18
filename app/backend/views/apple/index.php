<?php

use backend\models\BackendApple;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BackendAppleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Яблоки';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
    'model' => $model,
]);
?>
<div class="backend-apple-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Сгенерировать яблоки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'color',
                'value' => function ($model) {
                    return '<div style="background: ' . $model->color .'; wodth: 100ps; height: 45px;"></div>';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'on_tree',
                'label' => 'Статус',
                'value' => function ($model) {
                    return $model->getOnTreeStatusText();
                },
            ],
            [
                'attribute' => 'is_rotten',
                'label' => 'Сгнило',
                'value' => function ($model) {
                    return $model->getIsRotten();
                },
                'format' => 'boolean',
            ],
            'percent',
            [
                'attribute' => 'create_at',
                'format' => [
                    'date',
                    'php:d.m.Y H:i:s',
                ],
            ],
            [
                'attribute' => 'drop_at',
                'format' => [
                    'date',
                    'php:d.m.Y H:i:s',
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{drop} {eat} {delete}',
                'buttons' => [
                    'drop' => function ($url, $model, $key) {
                        return $model->canDrop() ? Html::a('Упасть', $url) : '';
                    },
                    'eat' => function ($url, $model, $key) {
                        return $model->canEat() ? Html::a('Съесть', $url, [
                            'class' => 'eat-link',
                            'data-id' => $model->id,
                        ]) : '';
                    },
                    'delete' => function ($url, $model, $key) {
                        return $model->canDelete() ? Html::a('Удалить', $url, [
                            'data-confirm' => 'Удалить яблоко?',
                            'data-method' => 'post',
                        ]) : '';
                    },
                ]
            ],
        ],
    ]); ?>

</div>

<?php $js = <<<JS
    $(document).ready(function () {
        $('.eat-link').on('click', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let href = $(this).attr('href');

            let form = $('#apple-form');
            form.attr('action', href);

            $('#percent-modal').modal('show');
        });
    });
JS;

$this->registerJs($js, 3);
