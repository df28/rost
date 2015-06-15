<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <ul>
        <li><?= Html::a(Yii::t('app', 'Advert'), ['advert/advert/index']) ?></li>
        <li><?= Html::a(Yii::t('app', 'City'), ['advert/city/index']) ?></li>
        <li><?= Html::a(Yii::t('app', 'Subject'), ['advert/subject/index']) ?></li>
        <li><?= Html::a(Yii::t('app', 'StudyGoal'), ['advert/study-goal/index']) ?></li>
        <!--<li><?= Html::a(Yii::t('app', 'TutorGrade'), ['advert/tutor-grade/index']) ?></li>-->
    </ul>

</div>
