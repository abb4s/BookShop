<?php
/**
 * Created by PhpStorm.
 * User: abbas
 * Date: 12/25/14
 * Time: 7:31 AM
 */

class CategoryComponent {
    public function admin(){
        $model=new Category('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Category']))
            $model->attributes=$_GET['Category'];

        return  $model;
    }
    public function createFavorite($id=NULL){
        $model=new UserCategory();

        if($id!=NULL){
            $model->category_id=$id;
        }
        elseif(isset($_POST['Category'])){
            $model->category_id=$_POST['Category']['id'];
        }
        else
            return $model;
        $model->users_id=Yii::app()->user->id;
        if($model->exists('category_id = :ci and users_id = :ui',array('ci'=>$model->category_id,'ui'=>$model->users_id))){
            return $model;
        }
        if($model->save())
            return $model;
        return $model;
    }
    public function deleteFavorite($id){
        $model=new UserCategory();
        if(!$model->exists('category_id = :ci and users_id = :ui',array('ci'=>$id,'ui'=>Yii::app()->user->id)))
            return $model;
        $model->category_id=$id;
        $model->users_id=Yii::app()->user->id;
        $model=$model->find();
        if($model->delete()){
            return $model;
        }
        else
            return $model;

    }
    public function loadModel($id)
    {
        $model=Category::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    public function init(){

    }
} 