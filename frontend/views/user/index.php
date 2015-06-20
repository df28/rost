<?php
/* @var $this yii\web\View */
/* @var $model \common\models\User */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>

<div class="">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Edit'), ['update'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
        <tr>
            <td><?= Yii::t('app', 'Login') ?></td>
            <td><?= $model->username ?></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Name') ?></td>
            <td><?= implode(' ',array_filter([$model->last_name, $model->first_name, $model->middle_name])); ?></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Experience') ?></td>
            <td><?= $model->experience ?></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Address') ?></td>
            <td><?= $model->address ?></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'TutorPhones') ?></td>
            <td><?= implode("<br />", ArrayHelper::getColumn($model->tutorPhones, 'phone')) ?></td>
        </tr>
        <tr>
            <td>Avatar</td>
            <td>
                <?php if ($model->avatar != ''): ?>
                    <img src="<?= $model->getImageUrl() ?>">
                <?php endif; ?>
            </td>
        </tr>
    </table>

</div>
