<?php
/**
 * Created by PhpStorm.
 * User: df28
 * Date: 11.4.15
 * Time: 22.06
 */

use yii\helpers\ArrayHelper;

/* @var $model common\modules\advert\models\Advert */
?>

<div class="row advert_search_result">
    <div class="col-lg-3">
        <div class="tutor_card">
            <img src="<?= $model->tutor->getImageUrl() ?>">
            <br />
            <?= $model->getTutorName() ?>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="advert_details">
            <div class="advert_details_entry">
                <label><?= $model->city->getAttributeLabel('name') ?></label>
                <value><?= $model->getCityName() ?>, <?= $model->address ?></value>
            </div>

            <?php if (!empty($model->advertPrice)): ?>
                <div class="advert_details_entry">
                    <?php
                    $prices = $model->advertPrice->getFilledPrices();
                    if (!empty($prices)):
                        ?>
                        <label><?= Yii::t('app', 'Place And Price') ?></label>
                        <table class="adver_prices_table">
                            <tr><!--
                                <th>
                                    <label><?= Yii::t('app', 'Lesson Place') ?></label>
                                </th>-->
                                <td>
                                    <?= implode('</td><td>', array_map(function ($place) use ($model) {
                                        return $model->advertPrice->getAttributeLabel($place);
                                    }, array_keys($prices))) ?>
                                </td>
                            </tr>
                            <tr><!--
                                <td>
                                    <label><?= $model->getAttributeLabel('advertPrice') ?></label>
                                </td>-->
                                <td>
                                    <?= implode('</td><td>', array_values($prices)) ?>
                                </td>
                            </tr>
                        </table>
                    <?php
                    else:
                        echo Yii::t('app', 'No advert prices filled');
                    endif;
                    ?>
                </div>
            <?php endif; ?>

            <div class="advert_details_entry">
                <label><?= $model->getAttributeLabel('advertSubjects') ?></label>
                <value><?= implode(", ", ArrayHelper::getColumn($model->advertSubjects, 'name')) ?></value>
            </div>

            <div class="advert_details_entry">
                <label><?= $model->getAttributeLabel('advertGoals') ?></label>
                <value><?= implode(", ", ArrayHelper::getColumn($model->advertGoals, 'name')) ?></value>
            </div>

            <div class="advert_details_entry">
                <label><?= $model->getAttributeLabel('tutorGrade') ?></label>
                <value><?= $model->getTutorGradeName() ?></value>
            </div>

            <div class="advert_details_entry">
                <label><?= $model->getAttributeLabel('experience') ?></label>
                <value><?= $model->experience ?> <?= ($model->experience>0?Yii::t('app', 'Years'):Yii::t('app','No experience')) ?></value>
            </div>

        </div>
    </div>
    <div class="col-lg-2">
        <div class="additional_info">
            <?= $model->description ?>
        </div>
    </div>
</div>
<hr/>