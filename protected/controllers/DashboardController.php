<?php
/**
 * Created by PhpStorm.
 * User: abbas
 * Date: 12/22/14
 * Time: 4:10 AM
 */

class DashboardController extends Controller{
    public $layout='//layouts/dashboard';
   /* public function filters()
    {
        return array(
            'rights', // perform access control for CRUD operations

        );
    }*/
    public function actionBookAdmin(){
        $model=Yii::app()->book->admin();
        $model->owner_id=Yii::app()->user->id;
        $this->render('book/admin',array('model'=>$model));
    }
    public function actionBookCreate(){

        $model=Yii::app()->book->create();

        if(isset($_POST['Book']) && !$model->hasErrors())
            $this->redirect(Yii::app()->createAbsoluteUrl('dashboard/bookadmin',array('id'=>$model->id)));
        $categories=Category::model()->findAll();
        $categories = CHtml::listData($categories,
            'id', 'name');
        $this->render('book/create',array('model'=>$model,'categories'=>$categories,'category'=>new Category()));
    }
    public function actionBookView($id){
        $model=Yii::app()->book->view($id);
        $this->render('book/view',array('model'=>$model));
    }
    public function actionBookUpdate($id){
        $model=Yii::app()->book->update($id);
        if(isset($_POST['Book']) && !$model->hasErrors())
            $this->redirect(Yii::app()->createAbsoluteUrl('dashboard/bookview',array('id'=>$model->id)));
        $categories=Category::model()->findAll();
        $categories = CHtml::listData($categories,
            'id', 'name');
        $this->render('book/create',array('model'=>$model,'categories'=>$categories,'category'=>new Category()));
    }
    public function actionFavoriteAdmin(){
        $create=Yii::app()->category->createFavorite();
        $categories=Category::model()->findAll();
        $categories = CHtml::listData($categories,
            'id', 'name');
        $admin=Yii::app()->category->admin();
        $admin->user_id_for_search=Yii::app()->user->id;
        $this->render('category/admin',array('model'=>$admin,'create'=>$create,'categories'=>$categories));
    }
    public function actionFavoriteAdd($id){
        if(Yii::app()->category->createFavorite($id)){

        }else{

        }
        $this->redirect(Yii::app()->user->returnUrl);
    }
    public function actionBookDelete(){

    }
    public function actionFavoriteCancel($id){
        if(Yii::app()->category->deleteFavorite($id)){

        }else{

        }
        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionOrderAdmin(){
        $model=Yii::app()->order->admin();
        $model->user_id_for_wanted=Yii::app()->user->id;
        $this->render('orders/admin',array('model'=>$model));
    }
    public function actionAddOrder($id){
        if(Yii::app()->order->add($id)){
            $this->redirect(Yii::app()->user->returnUrl);
        }

        else{
            $this->redirect(Yii::app()->user->returnUrl);
        }

    }
    public function actionCancelOrder($id){
        if(Yii::app()->order->cancel($id)){
            $this->redirect(Yii::app()->user->returnUrl);
        }

        else{
            $this->redirect(Yii::app()->user->returnUrl);
        }
    }
    public function actionNextOrderingUser($id){
        if(Yii::app()->order->next($id)){
            $this->redirect(Yii::app()->user->returnUrl);
        }
    }
    public function actionIndex(){
        $this->render('index');
    }
} 