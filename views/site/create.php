<?php

use app\models\Employees;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Employees $model */

if(!isset($model)){
    $model = new Employees();
}

$this->title = 'Create Employees';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
