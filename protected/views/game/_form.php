<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'game-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'players_home'); ?>
        <?php echo CHtml::activeListBox( $model, 'players_home', Player::model()->getPlayerList(), array( 'multiple' => true, 'size' => 10 ) ); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'players_visitor'); ?>
        <?php echo CHtml::activeListBox( $model, 'players_visitor', Player::model()->getPlayerList(), array( 'multiple' => true, 'size' => 10 ) ); ?>
    </div>


    <?php echo $form->hiddenField($model,'players_home',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->hiddenField($model,'players_visitor',array('size'=>60,'maxlength'=>255)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'score_home'); ?>
		<?php echo $form->textField($model,'score_home'); ?>
		<?php echo $form->error($model,'score_home'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'score_visitor'); ?>
		<?php echo $form->textField($model,'score_visitor'); ?>
		<?php echo $form->error($model,'score_visitor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'details'); ?>
		<?php echo $form->textArea($model,'details',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'details'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
