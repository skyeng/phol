<div class="workplace">
  <div class="task__holder">
    <div class="task" style="padding:15px !important;">
      <div class="task__container nice-shadowed-box">
        <div class="nice-shadowed-box__container">
          <? switch($trigger){
            case 'no_task':?><p><?=$this->T['lesson']['no_tasks']?></p><? break;
            case 'no_time':?><p><?=$this->T['lesson']['no_time']?></p><? break;
            default:?><p>Непредвиденная ошибка.</p><?
          }?>
          <button class="button workplace__finish"><?=$this->T['lesson']['finish_button']?></button>
        </div>
      </div>
    </div>
  </div>
</div>