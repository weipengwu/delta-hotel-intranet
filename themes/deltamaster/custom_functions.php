<?php 
function remove_the_dashboard () {
if (current_user_can('level_10')) {
return;
}else {
	global $menu, $submenu, $user_ID;
	$the_user = new WP_User($user_ID);
	reset($menu); $page = key($menu);
	while ((__('Dashboard') != $menu[$page][0]) && next($menu))
		$page = key($menu);
		if (__('Dashboard') == $menu[$page][0]) unset($menu[$page]);
		reset($menu); $page = key($menu);
		while (!$the_user->has_cap($menu[$page][1]) && next($menu))
		$page = key($menu);
	if (preg_match('#wp-admin/?(index.php)?$#',$_SERVER['REQUEST_URI']) && ('index.php' != $menu[$page][2]))
wp_redirect(get_option('siteurl') . '/wp-admin/post-new.php');
}
}
add_action('admin_menu', 'remove_the_dashboard');
?>
