<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'book/_view',
)); ?>
