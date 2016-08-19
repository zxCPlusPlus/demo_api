<?php

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
        $result['data'] = array($result);
        echo json_encode($result);
    }

}
