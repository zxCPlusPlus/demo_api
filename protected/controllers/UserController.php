<?php
//参考 http://www.yiiframework.com/doc/guide/1.1/zh_cn/database.ar

class UserController extends CController {
    public function actionAddUser() {
        $params = file_get_contents("php://input");
        $params = json_decode($params, true);
        if(empty($params['name']) || empty($params['age']) ){
            echo array('ret' => 0, 'msg' => '参数错误');
        }

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
        $params = file_get_contents("php://input");
        $params = json_decode($params, true);
        $criteria = new CDbCriteria();
        //两种写法都可以
        //$criteria->select = 'id, name, age';
        $criteria->select = array('id', 'name', 'age');
        $criteria->condition = 'name=:userName';
        $criteria->params = array(':userName' => $params['userName']);
        
        $findRet = UserModel::model()->findAll($criteria);

        //输出结果的几种方式


        //这样输出的结果为[{}]，
        //$findRet是一个数组，数组中的每一个元素都是CActiveRecord类型，不能直接json_encode
        //echo json_encode($findRet);

        //第一种
//        var_dump($findRet[0]);
//        exit;
//        /*
//        array (size=1)
//          0 =>
//            object(UserModel)[31]
//              private '_new' (CActiveRecord) => boolean false
//              private '_attributes' (CActiveRecord) =>
//                array (size=3)
//                  'id' => string '7' (length=1)
//                  'name' => string 'wowo' (length=4)
//                  'age' => string '15' (length=2)
//              private '_related' (CActiveRecord) =>
//                array (size=0)
//                  empty
//              private '_c' (CActiveRecord) => null
//              private '_pk' (CActiveRecord) => string '7' (length=1)
//              private '_alias' (CActiveRecord) => string 't' (length=1)
//              private '_errors' (CModel) =>
//                array (size=0)
//                  empty
//              private '_validators' (CModel) => null
//              private '_scenario' (CModel) => string 'update' (length=6)
//              private '_e' (CComponent) => null
//              private '_m' (CComponent) => null
//        */

//        //第二种
//        echo CJSON::encode($findRet);
//        exit;
//        /*
//         * [{"id":"7","name":"wowo","age":"15","c_t":null,"u_t":null}]
//         */

        //第三种
        foreach ($findRet as $userItem) {
            echo json_encode($userItem->getAttributes($criteria->select));
        }
        exit;
        /*
         * {"id":"7","name":"wowo","age":"15"}
         */
    }

    public function actionUpdateUser() {
        $params = array();
        $params['id'] = 7;
        $params['age'] = 22;

        $updateRet = UserModel::model()->updateAll(array('age' => $params['age'], 'u_t' => time()), 'id=:id', array(':id' => $params['id']));

        var_dump($updateRet);
        //成功返回 1
        exit();
    }

    public function actionDeleteUser() {
        $params = array();
        $params['id'] = 7;

        $deleteRet = UserModel::model()->deleteAll('id = :id', array(':id' => $params['id']));
        var_dump($deleteRet);
        //成功返回 1
        exit;
    }

}
