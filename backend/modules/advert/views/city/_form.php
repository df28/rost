<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\advert\models\City */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    function setCoordinatesAndSubmit(form)
    {
        var city = form['City[name]'].value;
        if(city == '')
        {
            form['City[latitude]'].value = '';
            form['City[longitude]'].value = '';
            form['hidden_submit_btn'].click();
            return;
        }

        ymaps.geocode(city, {
            results: 1
        }).then(function (res) {

            var resultObj = res.geoObjects.get(0);

            if(resultObj) {
                var coords = resultObj.geometry.getCoordinates();

                form['City[latitude]'].value = coords[0];
                form['City[longitude]'].value = coords[1];
            }

            form['hidden_submit_btn'].click();
        });


    }
</script>
<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'longitude')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'latitude')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            [
                'class' => 'hidden',
                'name' => 'hidden_submit_btn'
            ])
        ?>

        <?= Html::Button($model->isNewRecord ? 'Create' : 'Update',
            [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                'onClick' => 'setCoordinatesAndSubmit(this.form);'
            ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
