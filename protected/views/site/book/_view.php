<?php
/* @var $this BookController */
/* @var $data Book */
?>

<div class="view">
    <h3>
       <a href="<?php echo $this->createUrl('book/view',array('id'=>CHtml::encode($data->id)))?>">
           <?php echo CHtml::encode($data->name); ?>
       </a>
    </h3>
    <hr/>
    <b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
    <?php echo CHtml::encode($data->author); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('pages')); ?>:</b>
    <?php echo CHtml::encode($data->pages); ?>
    <br />
    <b>owner : </b>
    <?php echo CHtml::encode($data->owner->username); ?>
    <br />
    <b>
    <?php
    $r=Order::model()->exists('book_id= :BI and users_id= :UI',array('BI'=>$data->id,'UI'=>Yii::app()->user->id));
    ?>
     <a href="<?php echo $this->createUrl('dashboard/'.($r?  'cancelOrder' : 'addOrder'),array('id'=>CHtml::encode($data->id)))?>">
         <?php echo $r? 'cancelOrder' :  'addOrder'?>
      </a>
    </b>
    <br />
    <br />
    <br />
</div>