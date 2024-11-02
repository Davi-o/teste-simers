<?php

use yii\bootstrap5\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
$form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]);
?>

<div class="employees-index">

    <h1>Employees List
        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success']) ?>
    </h1>


    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="input-group mb-3">
        <?= Html::activeTextInput($model, 'department', ['name' => 'department', 'class' => 'form-control', 'placeholder' => 'Search by department']) ?>
        <div class="input-group-append">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::beginForm(['increase-salary'], 'post') ?>
            <?= Html::hiddenInput("_csrf", Yii::$app->request->getCsrfToken()) ?>
            <?= Html::hiddenInput('department', Yii::$app->request->get('department')) ?>
                <?= Html::submitButton('Increase Salary by 5%', ['class' => 'btn btn-warning']) ?>
            <?= Html::endForm() ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'email:email',
            [
                'attribute' => 'salary',
                'format' => 'currency',
            ],
            'department',
            'hire_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>