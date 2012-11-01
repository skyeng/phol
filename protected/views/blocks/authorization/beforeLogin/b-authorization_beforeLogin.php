<?/*
	BLOCK: A U T H O R I Z A T I O N
	MODIFICATOR: B E F O R E _ L O G I N
*/?>

<?	$this->need('jquery');?>

<div class="authorization__holder"> 
    <div class="authorization">
		<div class="authorization__container">
			<p class="authorization"><?=$this->T['authorization']['title']?></p>
			<?php $form=$this->beginWidget('CActiveForm', array('action' => '/login')); ?>
				<input name="email1" type="text" placeholder="E-mail" class="authorization__login" /><br />
				<input name="pass1" type="password" placeholder="<?=$this->T['authorization']['pass_placeholder']?>" class="authorization__pass">
				<a href="" class="authorization__login"><?=$this->T['authorization']['login_button']?></a>
				<input type="submit" name="enter" value="<?=$this->T['authorization']['login_button']?>" style="display:none"/>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>