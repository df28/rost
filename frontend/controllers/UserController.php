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
            $image = $model->uploadImage();

            // revert back if no valid file instance uploaded
            if ($image === false) {
                $model->avatar = $oldAvatar;
            }

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false) { // delete old and overwrite
                    $path = $model->getImageFile();
                    $image->saveAs($path);

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
