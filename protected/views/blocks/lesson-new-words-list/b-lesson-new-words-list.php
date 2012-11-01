<div class="b-lesson-new-words-list__holder">
    <div class="b-lesson-new-words-list">
        <p class="b-lesson-new-words-list__title"><strong>New words</strong> in that lesson</p>
        <ul class="b-lesson-new-words-list__list">
        	<li class="b-lesson-new-words-list__element">
                    <a href=""><!--                     <audio>
                            <source src='http://translate.google.com/translate_tts?ie=UTF-8&tl=en&total=1&idx=0&textlen=4&prev=input&q=text'></source>
                        </audio> 
                        --><img src="/images/blocks/lesson-new-words-list/b-lesson-new-words-list__sound-icon.png" /></a><!--
                    --><a href="" class="b-lesson-new-words-list__word">1</a>
                </li>
<!--            <li class="b-lesson-new-words-list__element">
                    <a href="#">
                        <audio>
                            <source src='http://translate.google.com/translate_tts?ie=UTF-8&tl=en&total=1&idx=0&textlen=4&prev=input&q=text'></source>
                        </audio>
                        <img src="/images/blocks/lesson-new-words-list/b-lesson-new-words-list__sound-icon.png" />
                    </a>
                    <a href="#" class="b-lesson-new-words-list__word">Text</a>
                </li> -->
            <? foreach($words as $word) { ?>
                <li class="b-lesson-new-words-list__element">
                    <a href="">
                       <!--  <audio>
                            <source src='http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q=Fuck'></source>
                        </audio> -->
                        <img src="/images/blocks/lesson-new-words-list/b-lesson-new-words-list__sound-icon.png" />
                    </a>
                    <a href="" class="b-lesson-new-words-list__word"><?=$word->word->word?></a>
                </li>
            <? } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>