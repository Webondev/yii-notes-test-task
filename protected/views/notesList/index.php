<?php
/* @var $this NotesListController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Notes Lists',
);

$this->menu=array(
	array('label'=>'Create NotesList', 'url'=>array('create')),
	array('label'=>'Manage NotesList', 'url'=>array('admin')),
);
?>

<h1>Notes Lists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
