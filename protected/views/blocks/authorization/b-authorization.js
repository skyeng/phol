$(document).ready(function() {
	$("a.authorization__login").click(function() {
		$(".authorization form").submit();
		return false;
	});
});