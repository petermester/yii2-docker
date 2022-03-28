<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ApiData */

$this->title = 'Create Api Data';
$this->params['breadcrumbs'][] = ['label' => 'Api Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
