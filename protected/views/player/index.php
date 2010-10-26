<?php
$this->breadcrumbs=array(
	'Players',
);

$this->menu=array(
	array('label'=>'Create Player', 'url'=>array('create')),
	array('label'=>'Manage Player', 'url'=>array('admin')),
);
?>

<h1>Players</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
