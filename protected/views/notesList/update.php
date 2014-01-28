<?php
/* @var $this NotesListController */
/* @var $model NotesList */

$this->breadcrumbs=array(
	'Notes Lists'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NotesList', 'url'=>array('index')),
	array('label'=>'Create NotesList', 'url'=>array('create')),
	array('label'=>'View NotesList', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NotesList', 'url'=>array('admin')),
);
?>

<h1>Update NotesList <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>