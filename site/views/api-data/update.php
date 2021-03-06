<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ApiData */

$this->title = 'Update Api Data: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Api Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="api-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
