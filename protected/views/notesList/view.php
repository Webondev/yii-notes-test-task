<?php
/* @var $this NotesListController */
/* @var $model NotesList */

$this->breadcrumbs=array(
	'Notes Lists'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List NotesList', 'url'=>array('index')),
	array('label'=>'Create NotesList', 'url'=>array('create')),
	array('label'=>'Update NotesList', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NotesList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NotesList', 'url'=>array('admin')),
);
?>

<h1>View NotesList #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'text',
		'date',
		'author',
		'image',
	),
)); ?>
