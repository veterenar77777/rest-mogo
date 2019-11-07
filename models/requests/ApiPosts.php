<?php
/**
 * Created by PhpStorm.
 * User: plasmo
 * Date: 05.11.2019
 * Time: 16:08
 */

namespace app\models\requests;


use yii\base\Model;

class ApiPosts extends Model
{
    public $userId;
    public $offset = 0;
    public $limit = 20;

    public function rules()
    {
        return[
            [['userId'],'required'],

        ];

    }
}