								<form>
									<input name="name" placeholder="Ваше имя" value="<?=$name?>" />
									<input name="email" placeholder="E-mail" value="<?=$email?>" />
									<input name="phone" placeholder="Телефон" value="<?=$phone?>" />
									<p class="application__text">';
                                    <? foreach($err as $e)echo $e.'<br />';?>
                                    </p>				
									<div class="button order__apply"><strong>Хочу</strong> попробовать</div>
									<div class="clear"></div>
								</form>