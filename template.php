<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */
 
 /**
 * Preprocessor for theme('fieldset').
 */
function fly_preprocess_fieldset(&$vars) {
	$element = $vars['element'];
  _form_set_class($element, array('form-wrapper'));
  $vars['attributes'] = isset($element['#attributes']) ? $element['#attributes'] : array();
  $vars['attributes']['class'][] = 'fieldset';
  if (!empty($element['#title'])) {
    $vars['attributes']['class'][] = 'titled';
  }
  if (!empty($element['#id'])) {
    $vars['attributes']['id'] = $element['#id'];
  }

  $description = !empty($element['#description']) ? "<div class='description'>{$element['#description']}</div>" : '';
  $children = !empty($element['#children']) ? $element['#children'] : '';
  $value = !empty($element['#value']) ? $element['#value'] : '';
  $vars['content'] = $description . $children . $value;
  $vars['title'] = !empty($element['#title']) ? $element['#title'] : '';
  $vars['hook'] = 'fieldset';
  if (!empty($vars['element']['#collapsible']) && isset($vars['element']['#title'])) {
    $vars['element']['#title'] = "<span class='icon'></span>" . $vars['element']['#title'];
  }
}

function fly_menu_link(array $variables) {
	$element = $variables['element'];
	global $user;
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
	
	if ($element['#theme'] == 'menu_link__user_menu') {
		if ($user->uid != 0) {
			if ($element['#title'] == t('My account')) {
				$u = user_load($user->uid);
				$element['#title'] = format_username($u) ;
				$element['#localized_options']['html'] = TRUE;
				$fid = $user->picture;
				$file = file_load($fid);
				$path = is_object($file) ? $file->uri : '' . drupal_get_path('theme', 'fly') . '/images/no-image.png';
				$element['#attributes']['class'][] = 'user-menu-link';
				$element['#title'] = theme('image_style', array('style_name' => 'profile-thumbnail', 'path' => $path, 'alt' => $element['#title'], 'title' => $element['#title'])) . $element['#title'];
			}
		} else if ($element['#title'] == t('Login')) {
			$element['#attributes']['class'][] = 'user-login-link';
			$sub_menu .= '<div class="menu" id="menu-login">' . drupal_render(drupal_get_form('user_login_block')) . '</div>';
		}
	}
	
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}