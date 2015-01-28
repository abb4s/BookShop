<?php
/* @var $this BookController */
/* @var $dataProvider CActiveDataProvider */

?>

<h1>Books</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'book/_view',
)); ?>
