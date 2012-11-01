<?/* 
	BLOCK: C L I E N T S _ C O M M E N T S
	MODIFICATION: M A I N
*/?>

<?	$this->need('jquery');?>

<div class="clients-comments__holder">
    <div class="clients-comments">
        <h2><?=$this->T['clients-comments']['title']?></h2>
        <div class="clients-comments__text">
            <p><?=$this->T['clients-comments']['text']?></p>
        </div>
        <div class="clients-comments__img">
            <img src="images/client.jpg" />
            <p><?=$this->T['clients-comments']['who']?></p>
        </div>
        <div class="clear"></div>
    </div>
</div>