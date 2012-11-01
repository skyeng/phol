<div class="black__screen"></div>
<div class="main">
	<div class="main__container">
		<div class="main__header">
			<div class="logo__holder">
				<? $this->block('logo');?>
			</div>
			<div class="auth__holder">
				<? $this->block('authorization/'.Yii::app()->user->isGuest?'beforeLogin':'afterLogin');?>
			</div>
		</div>
		<? $this->block('showcase');?>
	</div>
</div>
<br />
<div class="main">
	<div class="main__container">
		<div class="main__body">
			<div class="info">	
				<? $this->block('price');?>
				<? $this->block('order');?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<br />
<div class="main">
	<div class="main__container">
		<div class="main__body">
			<? $this->block('activities');?>
		</div>
	</div>
</div>
<br />
<div class="main">
	<div class="main__container">
		<div class="main__body">
			<div class="info">
				<? $this->block('video-holder');?>
				<? $this->block('comments-holder');?>
				<div class="clear"></div>
			</div>
			<? $this->block('footer');?>
		</div>
	</div>
</div>