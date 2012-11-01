<? $this->beginContent('//layouts/main');?>
<? $this->first_block('layout/internal');?>
<? $this->first_block('global');?>
<div class="black__screen"></div>
<div class="main">
	<div class="main__container">
		<div class="main__header">
			<? $this->block('logo');?>
            <? $this->block('menu');?>
			<? $this->block('authorization/'.(Yii::app()->user->isGuest?'beforeLogin':'afterLogin'));?>
		</div>
		<div class="main__body">
			<?=$content?>
			<? $this->block('footer');?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>