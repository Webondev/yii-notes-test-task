<?php
/* @var $this NotesListController */
/* @var $model NotesList */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notes-list-form',
	'enableAjaxValidation'=>false,
	
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php 
		if(!empty($model->date)){
			echo $model->date;
		}else{
			echo date("d-m-Y");
			
		}
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
	
		<?php
			 echo $form->labelEx($model,'image'); ?>
			<?php echo $form->fileField($model,'image',array('size'=>60)); ?>
			<?php echo $form->error($model,'image');  
			
			if(!empty($model->image)){
				echo '<br><a href="/uploads/'.$model->id.'/'.$model->image.'"><img style="width:300px;" src="/uploads/'.$model->id.'/'.$model->image.'"></a>';
			}
			
			?>
			
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->