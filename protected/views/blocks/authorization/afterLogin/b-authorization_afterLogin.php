<div class="authorization__holder"> 
    <div class="authorization">
		<div class="authorization__container">
			<img class="authorization__userpic" src="/images/userpic.png" />
			<div class="authorization__information-holder">
				<p class="authorization__username"><?=(Yii::app()->user->full_name!='')?Yii::app()->user->full_name:Yii::app()->user->name?>, <span class="authorization__username__age"><?=(Yii::app()->user->role == 'teacher')?'Teacher':'Student'?></span></p>
				<p class="authorization__usernick"><?=Yii::app()->user->identity?> <a href="/logout" class="authorization__username__logout"><?=$this->T['authorization']['logout']?></a></p>
			</div>
		</div>
	</div>
</div>