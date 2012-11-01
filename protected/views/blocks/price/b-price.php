<?/* 
	BLOCK: P R I C E
	MODIFICATION: M A I N
*/?>

<div class="price__holder">
	<div class="price">
        <h2><?=$this->T['price']['title']?></h2>
        <table class="price__table">
            <tr class="price__first">
                <td width="*" class="price__title"></td>
                <td width="120px"><?=$this->T['price']['1_lesson']?></td>
                <td width="120px"><?=$this->T['price']['4_lesson']?></td>
                <td width="120px"><?=$this->T['price']['8_lesson']?></td>
                <td width="125px"><?=$this->T['price']['16_lesson']?></td>
            </tr>
            <tr>
                <td class="price__title"><?=$this->T['price']['pos_1']?></td>
                <td class="price__left-border"></td>
                <td class="price__left-border"><img src="images/point.png" /></td>
                <td class="price__left-border"><img src="images/point.png" /></td>
                <td class="price__left-border"><img src="images/point.png" /></td>
            </tr>
            <tr>
                <td class="price__title"><?=$this->T['price']['pos_2']?></td>
                <td class="price__left-border"><img src="images/point.png" /></td>
                <td class="price__left-border"><img src="images/point.png" /></td>
                <td class="price__left-border"><img src="images/point.png" /></td>
                <td class="price__left-border"><img src="images/point.png" /></td>
            </tr>
            <tr>
                <td class="price__title"><?=$this->T['price']['pos_3']?></td>
                <td rowspan="2" class="price__free price__left-border">
               		<div class="price__free-holder">
	                    <img src="images/free.png" class="price__free" />
                    </div>
                </td>
                <td class="price__single-session price__left-border"><?=$this->T['price']['rus_1']?></td>
                <td class="price__single-session price__left-border"><?=$this->T['price']['rus_2']?></td>
                <td class="price__single-session price__left-border"><?=$this->T['price']['rus_3']?></td>
            </tr>
            <tr>
                <td class="price__title"><?=$this->T['price']['pos_4']?></td>
                <td class="price__multi-session price__left-border"><?=$this->T['price']['en_1']?></td>
                <td class="price__multi-session price__left-border"><?=$this->T['price']['en_2']?></td>
                <td class="price__multi-session price__left-border"><?=$this->T['price']['en_3']?></td>
            </tr>
        </table>
        <p class="price__time-duration">
        	<img src="images/mini-clock.png" />
            <?=$this->T['price']['duration']?>
        </p>
	</div>
</div>