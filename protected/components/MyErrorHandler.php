<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/28
 * Time: 22:19
 */

class MyErrorHandler extends CErrorHandler
{
    public function handle($event)
    {
        if(YII_DEBUG) {
            parent::handle($event);
        }
        else {
            $exception = $event->exception;
            $ret = array();
            $ret['code'] = 500;
            $ret['msg'] = $exception->getMessage();

            echo json_encode($ret);
            exit;
        }
    }
}