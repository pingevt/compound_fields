<?php
/*
 * @file
 * Devel Generate for compound_fields_label module
 *
 */

/*
 * Implements hook_devel_generate();
 */
function compound_fields_labels_devel_generate($object, $field, $instance, $bundle) {
  if (field_behaviors_widget('multiple values', $instance) == FIELD_BEHAVIOR_CUSTOM) {
    return devel_generate_multiple('_compound_fields_label_devel_generate', $object, $field, $instance, $bundle);
  }
  else {
    return _compound_fields_label_devel_generate($object, $field, $instance, $bundle);
  }
}

function _compound_fields_label_devel_generate($object, $field, $instance, $bundle) {
  $obj = array();

  switch($field['type']) {
  case 'text_text':
    $obj['text_value'] = substr(devel_create_greeking(mt_rand(1, $field['settings']['text_max_length'] / 6), FALSE), 0, $field['settings']['text_max_length']);
    $obj['text2_value'] = substr(devel_create_greeking(mt_rand(1, $field['settings']['text2_max_length'] / 6), FALSE), 0, $field['settings']['text2_max_length']);
    break;
  case 'text_long_text':
    $formats = filter_formats();
    $format = array_rand($formats);
    $obj['text_value'] = substr(devel_create_greeking(mt_rand(1, $field['settings']['text_max_length'] / 6), FALSE), 0, $field['settings']['text_max_length']);
    $obj['longtext_value'] = devel_create_content($format);
    $obj['longtext_format'] = $format;
    break;
  }
  return $obj;
}