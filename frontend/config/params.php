<?php
//$uploadsDir = realpath(dirname(__FILE__).'/../../uploads').DIRECTORY_SEPARATOR;

$uploadsDir = Yii::getAlias('@webroot').'/uploads/';
$uploadsUrl = Yii::$app->urlManager->baseUrl . '/uploads/';

return [
    'adminEmail' => 'admin@example.com',


    'uploadsDir' => $uploadsDir,
    'uploadsUrl' => $uploadsUrl,

    'avatarsDir' => $uploadsDir.'avatars/',
    'avatarsUrl' => $uploadsUrl.'avatars/',
];
