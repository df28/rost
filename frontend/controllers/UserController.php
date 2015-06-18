<?php

namespace frontend\controllers;

use common\models\User;
use Yii;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = $this->findModel();

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * @return User
     * @throws NotFoundHttpException
     */
    protected function findModel()
    {
        $id = intval(Yii::$app->user->id);
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdate()
    {
        $model = $this->findModel();
        $oldFile = $model->getImageFile();
        $oldAvatar = $model->avatar;

        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $imageFile = $model->uploadImage();

            // revert back if no valid file instance uploaded
            if ($imageFile === false) {
                $model->avatar = $oldAvatar;
            }

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($imageFile !== false) {
                    $path = $model->getImageFile();
                    $imageFile->saveAs($path);

                    //resize to standard size
                    $image = Yii::$app->image->load($path);
                    $image->resize(150, 150, Yii\image\drivers\Image::AUTO);
                    $image->save($path);

                    if($oldFile != null)
                        unlink($oldFile);
                }
                return $this->redirect(['index']);
            } else {
                // error in saving model
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

}
