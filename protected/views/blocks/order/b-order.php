<?/*
	BLOCK:	O R D E R
    MODIFICATOR: M A I N 
*/?>

<?	$this->need('jquery');?>

<div class="order__holder">
    <div class="order">
        <div class="lifted">
            <div class="lifted__container order__box">
                <h2><?=$this->T['order']['title']?></h2>
                <p class="order__text"><?=$this->T['order']['text']?></p>
                <form>
                    <input name="name" placeholder="<?=$this->T['order']['name']?>" />
					<input name="email" placeholder="<?=$this->T['order']['mail']?>" />
					<input name="phone" placeholder="<?=$this->T['order']['phone']?>" />						
                    <div class="button order__apply"><?=$this->T['order']['button']?></div>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>