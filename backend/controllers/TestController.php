<?php


namespace backend\controllers;
use yii\base\Action;
use Yii;
use yii\web\Request;


class TestController extends Action
{
    public $url;
    public $path;

    public function run()
    {
        $query = explode('=', parse_url($this->url, PHP_URL_QUERY));
        var_dump($query[1]);

//        $request = new Request(['url' => parse_url($this->url, PHP_URL_PATH)]);
//        $url = Yii::$app->urlManager->parseRequest($request);
//        var_dump($url); // ['user/view', 'id' => 42]

    }
}