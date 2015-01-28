<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Favorites</h1>
<p>
    ADD FAVORITEV:
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'category-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>
    <?php echo $form->dropDownList($model,'id',$categories,array('empty' => '(Select a favorite'));?>
    <?php echo $form->error($create,'category_id'); ?>
    <?php echo CHtml::submitButton('add'); ?>
    <?php
        $this->endWidget();
    ?>
</p>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('category/_search',array(
        'model'=>$model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name' => 'id',
            'type'=>'raw',
            'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
        ),
        array(
            'name' => 'name',
            'type'=>'raw',
            'value' => 'CHtml::link(CHtml::encode($data->name),array("admin/update","id"=>$data->id))',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
