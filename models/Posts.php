<?php
/**
 * Created by PhpStorm.
 * User: plasmo
 * Date: 07.11.2019
 * Time: 14:00
 */
namespace app\models;
use app\models\requests\ApiPosts;
use yii\mongodb\Query;


class Posts
{
    public  $request ;
    public function __construct(ApiPosts $request)
    {
        $this->request = $request;

    }

    private function getPlace($placeId){
        $query = new  Query();
        $place = [];
        $placeModel = $query->from('places')->where(['_id'=>$placeId])->one();
        if($placeModel){
            $place['id']=(string)$placeModel['_id'];
            $place['name']=$placeModel['name'];
            $place['city']=$placeModel['city'];
            $place['street']=$placeModel['street'];
            $place['category']=$placeModel['category'];
        }
        return $place;
    }
    private function getOrganisation($organisationId){
        $query = new  Query();
        $organisation = [];
        $organisationModel = $query->from('organisations')->where(['_id'=>$organisationId])->one();
        if($organisationModel){
            $organisation['id']=(string)$organisationModel['_id'];
            $organisation['name']=$organisationModel['name'];
            $organisation['category']=$organisationModel['category'];
            $organisation['city']=$organisationModel['city'];
        }
        return $organisation;
    }
    private function getUser($userId){
        $query = new  Query();
        $user = [];
        $userModel = $query->from('users')->where(['_id'=>$userId])->one();
        if( $userModel){
            $user['id']=(string)$userModel['_id'];
            $user['firstName']=$userModel['firstName'];
            if(isset($userModel['secondName'])){
                $user['secondName']=$userModel['secondName'];
            }
        }

        return $user;
    }
    private function preparePosts($rawData){
         $post['id'] =(string)$rawData['_id'];
         if(isset($rawData['userId'])){
             if($user=$this->getUser($rawData['userId']) ){
                 $post['user']=$user;
             }

         }

        if(isset($rawData['placeId'])){
            if($place=$this->getPlace($rawData['placeId'])){
                $post['place']=$place;
            }

        }

         if(isset($rawData['organisationId'])){
            $post['organisation']=$this->getOrganisation($rawData['organisationId']);
         }

         if(isset($rawData['text'])){
             $post['text']=$rawData['text'];
         }
         $post['timePassed']= time()-$rawData['createdAt'];
         return $post;

    }
    public function getData(){
        $query = new Query();
        $query->from('posts')
            ->where(['userId'=>$this->request->userId])
            ->offset($this->request->offset)
            ->limit($this->request->limit);

        $rows = $query->all();
        $posts =[];
        foreach ($rows as $row){
           $posts[] = $this->preparePosts($row);
        }
        if(!$posts){
            throw new RecordNotFound(404,'Запись не найдена',1);
        }
        return [
            'status'=>"Success",
            'message'=>"Успешно",
            "data"=>[
                'posts'=>$posts,
            ]
        ];

    }

}