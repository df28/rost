<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\advert\models\City;
use common\modules\advert\models\StudyGoal;
use common\modules\advert\models\Subject;
use \common\modules\advert\models\TutorGrade;
/* @var $this yii\web\View */
/* @var $model common\modules\advert\models\Advert */
/* @var $advertPriceModel common\modules\advert\models\AdvertPrice */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
function setCoordinatesAndSubmit(form)
{
    var address = form['Advert[address]'].value;
    if(address == '')
    {
        form['AdvertAddress[latitude]'].value = '';
        form['AdvertAddress[longitude]'].value = '';
        form['hidden_submit_btn'].click();
        return;
    }

    var citySelector = form['Advert[cityid]'];
    var city = citySelector.options[ citySelector.selectedIndex].text;


    ymaps.geocode(city + ', ' + address, {
        results: 1
    }).then(function (res) {

        var resultObj = res.geoObjects.get(0);

        if(resultObj) {
            var coords = resultObj.geometry.getCoordinates();

            form['AdvertAddress[latitude]'].value = coords[0];
            form['AdvertAddress[longitude]'].value = coords[1];
        }

        form['hidden_submit_btn'].click();
    });


}
</script>

<?php

$advertAddressModel = new \common\modules\advert\models\AdvertAddress();

?>

<div class="advert-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tutorid')->dropDownList(\common\models\User::getUsersList()) ?>

    <?= $form->field($model, 'cityid')->dropDownList(City::getCitiesList()) ?>

    <?= $form->field($model, 'advertGoals')->checkBoxList(StudyGoal::getStudyGoalsList()) ?>

    <?= $form->field($model, 'advertSubjects')->dropDownList(Subject::getSubjectsList(), ['multiple'=>'multiple']) ?>

    <?= $this->render('_advert_prices_subform', [
            'form' => $form,
            'advertModel' => $model,
            'advertPriceModel' => $advertPriceModel
    ]) ?>

    <?= $form->field($model, 'experience')->textInput() ?>

    <?= $form->field($model, 'tutor_grade_id')->dropDownList(TutorGrade::getTutorGradesList()) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($advertAddressModel, 'longitude')->hiddenInput()->label(false) ?>

    <?= $form->field($advertAddressModel, 'latitude')->hiddenInput()->label(false) ?>

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
            ])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
