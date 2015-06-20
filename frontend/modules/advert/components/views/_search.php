<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\advert\models\City;
use common\modules\advert\models\AdvertPrice;
use common\modules\advert\models\StudyGoal;
use common\modules\advert\models\Subject;

/* @var $this yii\web\View */
/* @var $model frontend\modules\advert\models\AdvertSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $target_action string */
?>

<div class="advert-search" style="width:200px;">

    <?php $form = ActiveForm::begin([
        'action' => [$target_action],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cityid')->dropDownList(
        [0 => 'Не важно'] + City::getCitiesList()
    )->label('Город') ?>

    <?= $form->field($model, 'subjectId')->dropDownList(
        [0 => 'Не важно'] + Subject::getSubjectsList()
    )->label('Предмет') ?>

    <div class="form-group text-right">
        <a style="cursor:hand;cursor:pointer;" class="small text-muted"
           onClick="$('#advertsearch_details_subform').toggle();return false;">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            <?= Yii::t('app', 'Advanced Search') ?>
        </a>
    </div>

    <?php
    if (!empty($model->studyPlace) || $model->experience != 0 || $model->goalId != 0) {
        $advancedFormDisplay = "block";
    } else {
        $advancedFormDisplay = "none";
    }
    ?>

    <div id="advertsearch_details_subform" style="display: <?= $advancedFormDisplay ?>;">

        <?= $form->field($model, 'goalId')->dropDownList(
            [0 => 'Не важно'] + StudyGoal::getStudyGoalsList()
        )->label('Цель') ?>

        <?= $form->field($model, 'experience')->dropDownList(array('0' => 'Не важно', '3' => '> 3 лет', '5' => '> 5 лет'))->label('Опыт') ?>

        <?php
        $studyPlaces = AdvertPrice::getStudyPlaces();
        $studyPlaces = array_flip($studyPlaces);
        foreach ($studyPlaces as $k => $v) {
            $studyPlaces[$k] = Yii::t('app', $k);
        }

        $studyPlaces = ['0' => Yii::t('app', 'Any')] + $studyPlaces;
        ?>

        <?= $form->field($model, 'studyPlace')->dropDownList($studyPlaces)->label(Yii::t('app', 'Study Place')) ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="form-group">
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
