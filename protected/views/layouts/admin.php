<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	

	<link rel="stylesheet"  href="/css/tmp/bootstrap_old.min.css" type="text/css" />
	<link rel="stylesheet"  href="/css/tmp/admin.css" type="text/css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="/js/tmp/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://bootstrap.veliovgroup.com/assets/js/bootstrap-tooltip.js"></script>
	
	
</head>
<body>
</script>
<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<span class="brand">Админка</span>
			<ul class="nav">
				<li class="dropdown">
					<a href="/admin">Дела</a>
				</li>
				<li class="dropdown">
					<a href="/admin/user">Юзеры</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Задания<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="/admin/question">Поиск заданий</a></li>
						<li><a href="/admin/task">Поиск вопросов к заданиям</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="/admin/content">Контент</a>
				</li>
				<li class="dropdown">
					<a href="/admin/orders">Заявки</a>
				</li>
				<li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Расписание<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="/admin/schedule/adminRegular">Регулярные</a></li>
						<li><a href="/admin/schedule">Разовые</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="/admin/updateVersion">Обновление</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container">
	<?=$content?>
</div>
</body>
</html>