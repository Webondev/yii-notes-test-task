<?php
/* @var $this NotesListController */
/* @var $model NotesList */

$this->breadcrumbs=array(
	'Notes Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NotesList', 'url'=>array('index')),
	array('label'=>'Manage NotesList', 'url'=>array('admin')),
);
?>

<h1>Create NotesList</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>