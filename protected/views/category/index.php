<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

?>

<h1><?php echo $model->name; ?></h1>
<hr />
<?php
$this->breadcrumbs=array(
    'Categories',
);


$this->widget('zii.widgets.CMenu',array('items'=>$this->menu,));
?>
<?php $this->renderPartial('book/index',array('dataProvider'=>$dataProvider));


