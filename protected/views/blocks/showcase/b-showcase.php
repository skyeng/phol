<?/*
	BLOCK:	S H O W C A S E
    MODIFICATOR: M A I N 
*/?>

<?	$this->need('jquery');?>
<?	$this->need('scrollTo');?>

<div class="main__body">
	<div class="showcase nice-shadowed-box ">
		<div class="nice-shadowed-box__container">
			<div class="showcase__image">
				<div id="showcase__slideshow">
                    <img src="/images/tisers/1_small.png" alt="" class="showcase__slideshow-active" />
                    <img src="/images/tisers/2_small.png" alt="" />
            	    <img src="/images/tisers/3_small.png" alt="" />
               	    <img src="/images/tisers/4_small.png" alt="" />
                    <img src="/images/tisers/5_small.png" alt="" />
                    <img src="/images/tisers/6_small.png" alt="" />
                    <img src="/images/tisers/7_small.png" alt="" />
                </div>
			</div>
            <div class="showcase__text">
				<div class="showcase__title"><?=$this->T['showcase']['title']?></div>
				<ul class="showcase__features">
					<li><?=$this->T['showcase']['feature_1']?></li>
					<li><?=$this->T['showcase']['feature_2']?></li>
					<li><?=$this->T['showcase']['feature_3']?></li>
					<li><?=$this->T['showcase']['feature_4']?></li>
				</ul>
				
				<div class="button showcase__apply"><?=$this->T['showcase']['button']?></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	&nbsp;
</div>