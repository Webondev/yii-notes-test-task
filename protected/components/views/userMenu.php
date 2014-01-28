<ul>
	<li><?php echo CHtml::link('Create New Note',array('noteslist/create')); ?></li>
	<li><?php echo CHtml::link('Manage Notes',array('noteslist/admin')); ?></li>
	<li><?php echo CHtml::link('Export CSV',array('noteslist/export')); ?></li>
	<li><?php echo CHtml::link('Send by email',array('noteslist/export?email=yes')); ?></li>
</ul>