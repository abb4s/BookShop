<?php
/**
 * Created by PhpStorm.
 * User: abbas
 * Date: 12/16/14
 * Time: 8:49 PM
 */

class Controller extends RController {
    public $layout='//layouts/main';
    public $breadcrumbs;
    public $menu=array(

    );
    public function init(){
        $this->menu=array(
            array('label'=>Yii::t('app','Home'), 'url'=>array('/site/index')),
            array('label'=>Yii::t('app','About'), 'url'=>array('/site/page', 'view'=>'about')),
            array('label'=>Yii::t('app','Contact'), 'url'=>array('/site/contact')),
            array('label'=>Yii::t('app','Login'), 'url'=>array('/user/login'),'visible'=>Yii::app()->user->isGuest),
            array('label'=>Yii::t('app','Rights'), 'url'=>array('/rights')),
            array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('app','book dashboard'), 'url'=>array('/dashboard/index')),
        );
    }
} 