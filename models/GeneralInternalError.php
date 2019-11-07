<?php
/**
 * Created by PhpStorm.
 * User: plasmo
 * Date: 07.11.2019
 * Time: 20:05
 */

namespace app\models;


use yii\web\HttpException;

class GeneralInternalError extends HttpException
{
    public function getName(){
        return 'GeneralInternalError';
    }

}