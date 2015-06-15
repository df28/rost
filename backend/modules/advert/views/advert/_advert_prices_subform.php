<?php
/**
 * Created by PhpStorm.
 * User: df28
 * Date: 21.3.15
 * Time: 14.19
 */

/*
    this view file created for rendering AdvertPrices into parent form and shouldn't be used separately
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $advertModel common\modules\advert\models\Advert */
/* @var $advertPriceModel common\modules\advert\models\AdvertPrice */
/* @var $form yii\widgets\ActiveForm */

?>
<?= Html::label('Prices'); ?>
<table class="adver_prices-table">
    <tr>
        <td>
            <?= Html::activeLabel($advertPriceModel, 'studentplace') ?>
        </td>
        <td>
            <?= Html::activeLabel($advertPriceModel, 'tutorplace') ?>
        </td>
        <td>
            <?= Html::activeLabel($advertPriceModel, 'remote') ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($advertPriceModel, 'studentplace')->textInput()->label(false); ?>
        </td>
        <td>
            <?= $form->field($advertPriceModel, 'tutorplace')->textInput()->label(false); ?>
        </td>
        <td>
            <?= $form->field($advertPriceModel, 'remote')->textInput()->label(false); ?>
        </td>
    </tr>
</table>