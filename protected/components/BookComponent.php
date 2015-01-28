<?php
/**
 * Created by PhpStorm.
 * User: abbas
 * Date: 12/22/14
 * Time: 3:46 AM
 */

class BookComponent {
    public function view($id)
    {
        return $this->loadModel($id);
    }
    /**
     * search books in different condition
     */
    public function getFavorites(){

    }
    public function getAll(){
        return $dataProvider=new CActiveDataProvider('Book');
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function create()
    {
        $model=new Book;
        $arr=array(
            array(
                'id'=>1,
                'name'=>'elmi'
            ),
            array(
                'id'=>2,
                'name'=>'mazhabi',

            ),
        );
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Book']))
        {
            $model->attributes=$_POST['Book'];
            $model->owner_id=Yii::app()->user->id;
            if($model->save()){
                $this->addCategories($arr,$model->id);
                return $model;
            }

        }

        return $model;
    }
    public function addCategories($arr,$book_id){
        if($arr == NULL)
            return false;
        foreach($arr as $category){
            $model=new BookCategory();
            $model->book_id=$book_id;
            $model->category_id=$category['id'];
            if(!$model->save()){
                return false;
            }
        }
        return true;
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function update($id)
    {
        $model=$this->loadModel($id);
        $owner=$model->owner_id;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $arr=array(
            array(
                'id'=>3,
                'name'=>'elmi wsd'
            ),
            array(
                'id'=>2,
                'name'=>'mazhabi',

            ),
            array(
                'id'=>4,
                'name'=>'mazhabi mba',
            ),
        );
        if(isset($_POST['Book']))
        {
            $model->attributes=$_POST['Book'];
            $model->owner_id=$owner;
            if($model->save()){
                $this->updateCategories($arr,$model->id);
                return $model;
            }

        }

        return $model;
    }
    public function updateCategories($arr,$book_id){
        if($arr == NULL)
            return false;
        $model=new BookCategory();
        $model->book_id=$book_id;
        $model->deleteAll();
        foreach($arr as $category){
            $model=new BookCategory();
            $model->book_id=$book_id;
            $model->category_id=$category['id'];
            if(!$model->save()){
                return false;
            }
        }
        return true;
    }
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function delete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function index()
    {
        $dataProvider=new CActiveDataProvider('Book');
        return $dataProvider;
    }

    /**
     * Manages all models.
     */
    public function admin()
    {
        $model=new Book('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Book']))
            $model->attributes=$_GET['Book'];

        return $model;
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Book the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Book::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    public function init(){

    }

} 