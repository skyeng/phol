<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'surname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nicname'); ?>
		<?php echo $form->textField($model,'nicname',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nicname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password (hash)'); ?>
		<?php echo $form->textField($model,'password',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<label for="new_password">new password (plain)</label>
		<input name="new_password" id="new_password" type="text" value=""/>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birth'); ?>
		<?php echo $form->textField($model,'birth'); ?>
		<?php echo $form->error($model,'birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'privacy'); ?>
		<?php echo $form->textField($model,'privacy'); ?>
		<?php echo $form->error($model,'privacy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'classes'); ?>
		<?php echo $form->textField($model,'classes'); ?>
		<?php echo $form->error($model,'classes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'identity'); ?>
		<?php echo $form->textField($model,'identity',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'identity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'network'); ?>
		<?php echo $form->textField($model,'network',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'network'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'full_name'); ?>
		<?php echo $form->textField($model,'full_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'full_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->