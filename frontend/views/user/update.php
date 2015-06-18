<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\User */


$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'] // important
]);

// display the image uploaded or show a placeholder
// you can also use this code below in your `view.php` file
echo Html::img($model->getImageUrl(), [
    'class' => 'img-thumbnail',
    'alt' => 'Avatar',
    'title' => 'Avatar'
]);

// your fileinput widget for single file upload
echo $form->field($model, 'image')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    'pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png']]
]);

// render the submit button
echo Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']);

ActiveForm::end();
