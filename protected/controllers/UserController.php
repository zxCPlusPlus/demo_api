<?php
//参考 http://www.yiiframework.com/doc/guide/1.1/zh_cn/database.ar

class UserController extends CController {
    public function actionAddUser() {
        //参数获取下次再讲，这次写死
        $params = array();
        $params['name'] = '张三';
        $params['age'] = 15;

        $now = time();
        $userModel = new UserModel();
        $userModel->name = $params['name'];
        $userModel->age = $params['age'];
        $userModel->c_t = $now;
        $userModel->u_t = $now;
        $addRet = $userModel->save();

        $result = array();
        $result['code'] = 1;
        $result['data'] = array($addRet);
        echo json_encode($result);
    }

    public function actionfindUser() {
        $params = array();
        $params['userName'] = 'wowo';
        $userModel = new UserModel();
        $criteria = new CDbCriteria();
        $criteria->select = 'id, name, age';
        $criteria->condition = 'id=:userName';
        $criteria->params = array(':userName' => $params['userName']);
        
        $findRet = UserModel::model()->findAll($criteria);

        $result = array();
        $result['code'] = 1;
        $result['data'] = $findRet;

        echo json_encode($result);

    }
}
