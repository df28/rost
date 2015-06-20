<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\advert\models\City;

/* @var $this yii\web\View */
/* @var $model \common\models\User */

$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'] // important
]);
?>

<?= $form->field($model, 'first_name')->textInput() ?>

<?= $form->field($model, 'middle_name')->textInput() ?>

<?= $form->field($model, 'last_name')->textInput() ?>

<?= $form->field($model, 'experience')->textInput() ?>

<?= $form->field($model, 'cityid')->dropDownList(City::getCitiesList()) ?>

<?= $form->field($model, 'address')->textInput() ?>

<?= $form->field($model, 'phone1')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '+999(99)999-99-99',
]) ?>

<?= $form->field($model, 'phone2')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '+999(99)999-99-99',
]) ?>

<?= $form->field($model, 'phone3')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '+999(99)999-99-99',
]) ?>

<?= Html::img($model->getImageUrl(), [
    'class' => 'img-thumbnail',
    'alt' => 'Avatar',
    'title' => 'Avatar'
]) ?>

<?= $form->field($model, 'image')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    'pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png']]
]) ?>

<?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
&nbsp;&nbsp;
<?= Html::a(Yii::t('app', 'Cancel'), ['/user/index'], ['class' => 'btn btn-danger']) ?>

<?php ActiveForm::end(); ?>
