<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Book', 'url'=>array('index')),
	array('label'=>'Create Book', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#book-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Books</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('book/_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'book-grid',

	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'owner_id',
		'name',
		'author',
		'pages',
        array(
            'name'=>'name',
            'value'=>'Yii::app()->order->getCountOfBookOrders($data->id)',
        ),
        array(
            'name'=>'name',
            'value'=>'Yii::app()->order->getAvailableOrderingUser($data->id)? Yii::app()->order->getAvailableOrderingUser($data->id)->username : "no one" ',
        ),
        array
        (
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}{next user}',
            'buttons'=>array(

                'update'=>array(
                    'url'=>'CController::createUrl("/dashboard/bookupdate", array("id"=>$data->id))'
                ),
                'view'=>array(
                    'url'=>'CController::createUrl("/dashboard/bookview", array("id"=>$data->id))'
                ),
                'delete'=>array(
                    'url'=>'CController::createUrl("/dashboard/bookdelete", array("id"=>$data->id))'
                ),
                'next user'=>array(
                    'url'=>'CController::createUrl("/dashboard/nextOrderingUser", array("id"=>$data->id))',
                    'visible'=>'Yii::app()->order->have($data->id)',
                ),
            ),

        ),

	),
)); ?>
