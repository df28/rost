<?php
/* @var $this yii\web\View */
/* @var $model \common\models\User */

use yii\helpers\Html;
?>

<div class="">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Edit'), ['update'], ['class' => 'btn btn-success']) ?>
    </p>

    <table>
        <tr>
            <td>Username</td>
            <td><?= $model->username ?></td>
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
