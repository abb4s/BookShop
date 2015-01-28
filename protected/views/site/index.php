<?php
/**
 * Created by PhpStorm.
 * User: abbas
 * Date: 12/25/14
 * Time: 5:57 AM
 */
$this->widget('zii.widgets.CMenu',array(
    'items'=>$this->menu));

?>
<h1>
    WELCOME TO HERE
</h1>
<?php
$this->renderpartial('book/index',array('dataProvider'=>$books));
?>