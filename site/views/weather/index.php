<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Weather;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WeatherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weathers';
$this->params['breadcrumbs'][] = $this->title;

$searchModel = new \app\models\WeatherSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>
<div class="weather-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Weather', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'link',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Weather $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
