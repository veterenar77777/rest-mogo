<?php
/**
 * Created by PhpStorm.
 * User: plasmo
 * Date: 04.11.2019
 * Time: 11:40
 */
namespace app\controllers;

use app\models\GeneralInternalError;
use app\models\Posts;
use app\models\requests\ApiPosts;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class ApiController extends Controller
{

    public function actionPosts(){


            $request = new ApiPosts();
            if($request->load(\Yii::$app->request->get(),'') && $request->validate()){

                $post =new Posts($request);
                $answer = $post->getData();
            }else{
                throw new GeneralInternalError(500,'Произошла ошибка',2);
            }

            \Yii::$app->response->format= \yii\web\Response::FORMAT_JSON;
            return $answer;

    }


    public function actionError(){

        \Yii::$app->response->format= \yii\web\Response::FORMAT_JSON;
        $exception = \Yii::$app->errorHandler->exception;
       $answer['message']="Неизвестная ошибка";
        if($exception!=null){

            if( $exception instanceof  NotFoundHttpException ){
                $answer=['data'=>(object)[]];
                \Yii::$app->response->statusCode=$exception->statusCode;
                $answer['status']='UrlNotFound';
                $answer['message']='URL не найден';
            }elseif(  $exception instanceof HttpException ){

                $answer=['data'=>(object)[]];
                \Yii::$app->response->statusCode=$exception->statusCode;
                $answer['status']=$exception->getName();
                $answer['message']=$exception->getMessage();


            }
        }


           return $answer;
    }
}