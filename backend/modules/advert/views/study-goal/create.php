<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\advert\models\StudyGoal */

$this->title = 'Create Study Goal';
$this->params['breadcrumbs'][] = ['label' => 'Study Goals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="study-goal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
