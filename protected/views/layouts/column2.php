<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
	<div class="span-18">
	<div class="info_err" style="color:red;"><?php if(!empty($_GET['export'])){ echo "<script>alert('Letter sent!')</script>"; }?></div>
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-6 last">
		<div id="sidebar">
			<?php  $this->widget('UserMenu'); ?>




		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>