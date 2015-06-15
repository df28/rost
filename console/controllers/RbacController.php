<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
//        $createPost = $auth->createPermission('createPost');
//        $createPost->description = 'Create a post';
//        $auth->add($createPost);

        // add "updatePost" permission
//        $updatePost = $auth->createPermission('updatePost');
//        $updatePost->description = 'Update post';
//        $auth->add($updatePost);

        // add "author" role and give this role the "createPost" permission
        $tutor = $auth->createRole('tutor');
        $auth->add($tutor);
//        $auth->addChild($tutor, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
//        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $tutor);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($tutor, 3);
        $auth->assign($tutor, 2);
        $auth->assign($admin, 1);
    }
}