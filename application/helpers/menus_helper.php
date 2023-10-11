<?php

if (!function_exists('menus_active')) {
	function menus_active($params_url = false, $main_menu = false)
	{
		$CI = &get_instance();
		$urlController = $CI->uri->segment(2);
		$urlController2 = $CI->uri->segment(3);
		if ($params_url && isset($params_url)) {
			if ($urlController) {
				if ($urlController == $params_url) {
					return 'active';
				}
			}
			if ($urlController2) {
				if ($urlController . '-' . $urlController2 == $params_url) {
					return 'active';
				}
			}
		} else if (is_array($main_menu)) {
			foreach ($main_menu as $menu) {
				if (stripos($urlController, $menu) !== FALSE) return 'active';
			}
		}
	}
}
