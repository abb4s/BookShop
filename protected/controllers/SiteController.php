<?php
/**
 * Created by PhpStorm.
 * User: abbas
 * Date: 12/16/14
 * Time: 8:49 PM
 */

class SiteController extends Controller{
    public function filters()
    {
        return array(
            'rights', // perform access control for CRUD operations

        );
    }
    public function actionIndex(){
        $books=Yii::app()->book->getAll();
        $categories=Yii::app()->category->getAll();
        $this->render('index',array('books'=>$books,'categories'=>$categories));
    }
    public function actionSearch($word){
        $criteria=new CDbCriteria();
        $criteria->with=array(
            'categories'=>array(
                'alias'=>'categories',
            ),
        );
        $criteria->together=true;
        $criteria->group = 't.id';
        $criteria->compare('t.author',$word,true,'or');
        $criteria->compare('t.name',$word,true,'or');
        $criteria->compare('categories.name',$word,true,'or');
        /*$criteria->addSearchCondition('author',$word,true,'or');
        $criteria->addSearchCondition('name',$word,true,'or');
        $criteria->addSearchCondition('categories.name',$word,true,'or');*/
        $dataProvider= new CActiveDataProvider(new Book(), array(
            'criteria'=>$criteria,
        ));
        $this->render('search',array('dataProvider'=>$dataProvider));
    }
    public function actionError(){
        echo "error";
    }
    public function actionCheck($id){
        echo User::model()->findByPk($id)->username;

    }
    public function actionSend(){
        $mail = new YiiMailer();
        $mail->setView('email');
        $mail->setData(array('message' => 'Message to send', 'name' => 'John Doe', 'description' => 'Contact form'));

        $mail->setFrom('from@example.com', 'John Doe');
        $mail->setTo('abbas.hoseini74@gmail.com');
        $mail->setSubject('Mail subject');
        if ($mail->send()) {
            echo "ok";
        } else {
            echo "not okay";
        }
    }
    public function allowedActions() {
        return 'index';
    }
} 