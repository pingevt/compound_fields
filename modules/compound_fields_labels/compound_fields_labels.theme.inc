<?php
/**
 * @file
 *
 */

/**
 * Theme function for text_long_text.
 */
function theme_text_long_text_default_display($vars) {
  $field = $vars['item']['#item'];
  $settings = $vars['item']['#item']['settings'];

  $str = '';

  // Build Text.
  $str .= '<' . $settings['text_wrapper'];
  if (!empty($settings['text_classes'])) {
    $str .= ' class="' . $settings['text_classes'] . '"';
  }
  $str .= '>';
  $str .= $field['text_value'];
  $str .= '</' . $settings['text_wrapper'] . '>';

  // Build Long Text.
  $str .= '<' . $settings['long_text_wrapper'];
  if (!empty($settings['long_text_classes'])) {
    $str .= ' class="' . $settings['long_text_classes'] . '"';
  }
  $str .= '>';
  $str .= $field['safe_longtext_value'];
  $str .= '</' . $settings['long_text_wrapper'] . '>';

  return $str;
}

/**
 * Theme function for text_long_text.
 */
function theme_text_long_text_text_display($vars) {
  $field = $vars['item']['#item'];
  $settings = $vars['item']['#item']['settings'];

  $str = '';

  // Build Text.
  $str .= '<' . $settings['text_wrapper'];
  if (!empty($settings['text_classes'])) {
    $str .= ' class="' . $settings['text_classes'] . '"';
  }
  $str .= '>';
  $str .= $field['text_value'];
  $str .= '</' . $settings['text_wrapper'] . '>';

  return $str;
}

/**
 * Theme function for text_long_text.
 */
function theme_text_long_text_long_display($vars) {
  $field = $vars['item']['#item'];
  $settings = $vars['item']['#item']['settings'];

  $str = '';

  // Build Long Text.
  $str .= '<' . $settings['long_text_wrapper'];
  if (!empty($settings['long_text_classes'])) {
    $str .= ' class="' . $settings['long_text_classes'] . '"';
  }
  $str .= '>';
  $str .= $field['safe_longtext_value'];
  $str .= '</' . $settings['long_text_wrapper'] . '>';

  return $str;
}

/**
 * Theme function for text_text.
 */
function theme_text_text_default_display($vars) {
  $field = $vars['item']['#item'];
  $settings = $vars['item']['#item']['settings'];

  $str = '';

  // Build Text.
  $str .= '<' . $settings['text_wrapper'];
  if (!empty($settings['text_classes'])) {
    $str .= ' class="' . $settings['text_classes'] . '"';
  }
  $str .= '>';
  $str .= $field['text_value'];
  $str .= '</' . $settings['text_wrapper'] . '>';


  // Build Text2.
  $str .= '<' . $settings['text2_wrapper'];
  if (!empty($settings['text2_classes'])) {
    $str .= ' class="' . $settings['text2_classes'] . '"';
  }
  $str .= '>';
  $str .= $field['text2_value'];
  $str .= '</' . $settings['text2_wrapper'] . '>';

  return $str;
}
