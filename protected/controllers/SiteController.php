<?php
/**
 * Created by PhpStorm.
 * User: abbas
 * Date: 12/16/14
 * Time: 8:49 PM
 */

class SiteController extends Controller{
    public function actionIndex(){
        $books=Yii::app()->book->getAll();
        $this->render('index',array('books'=>$books));
    }
    public function actionSearch(){

    }
    public function actionError(){
        echo "error";
    }
    public function actionCheck(){
        echo "abbas";
    }
} 
