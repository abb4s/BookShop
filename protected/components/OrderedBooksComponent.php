<?php
/**
 * Created by PhpStorm.
 * User: abbas
 * Date: 12/25/14
 * Time: 1:10 PM
 */

class OrderedBooksComponent {
    public function admin(){
        $model=new Book('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Book']))
            $model->attributes=$_GET['Book'];

        return $model;
    }
    public function add($id){
       $model=new Order();
       $model->users_id=Yii::app()->user->id;
       $model->book_id=$id;
       if(! $model->exists('book_id= :BI and users_id= :UI',array('BI'=>$model->book_id,'UI'=>$model->users_id)))
           if($model->save()){
               return $model;
           }
       return $model;
    }
    public function cancel($id){
        //$model=new Order();
       // $model->users_id=Yii::app()->user->id;
        //$model->book_id=$id;
        //if($model->exists('book_id= :BI and users_id= :UI',array('BI'=>$model->book_id,'UI'=>$model->users_id)))
            if($model=Order::model()->deleteAll('book_id= :BI and users_id= :UI',array('BI'=>$id,'UI'=>Yii::app()->user->id))){
                return $model;
            }
        return $model;
    }
    public function next($id){
        $model=Order::model()->find('book_id= :BI ',array('BI'=>$id),array('order'=>'`id` ASC'));
        if($model->delete()){
            return $model;
        }
        return $model;
    }
    public function have($id){
        return Order::model()->exists('book_id= :BI ',array('BI'=>$id));
    }
    public function getCountOfBookOrders($id){
        return Order::model()->count('book_id= :BI',array('BI'=>$id));
    }
    public function getAvailableOrderingUser($id){
        $model=Order::model()->find('book_id = :BI',array('BI'=>$id),array('order'=>'id'));
        if($model)
            return $model->users;
        else
            return NULL;
    }
    public function init(){

    }
} 