<?php
# https://gist.github.com/2151128

if( !array_key_exists('layout', get_defined_vars()) )
  $layout = realpath(dirname(__DIR__).'/partials/default.php');

if( array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )
  $layout = null;

$use_layout = true;
if(is_null($layout)) $use_layout = false;

function apply_content_filters($in) {
  global $content_filters;
  foreach($content_filters as $filter) {
    $in = call_user_func($filter, $in);
  }
  return $in;
}
if( !isset($content_filters) ) $content_filters = array();

if( $use_layout ) ob_start();

function layout_shutdown() {
  global $layout;
  global $use_layout;
  global $error_triggered;

  if( !$use_layout ) return;

  $content = apply_content_filters(ob_get_contents());
  ob_end_clean();

  if( $error_triggered || is_null($layout) ) {
    echo $content;
    return;
  }

  foreach(headers_list() as $header)
    if( preg_match('/^Location/', $header) ) return;

  // Template globals
  // TODO: find a better way to include them
  global $title;
  global $full_url;
  global $description;
  global $global_styles;
  global $global_js;
  global $include_styles;
  global $include_js;

  require $layout;
}

register_shutdown_function('layout_shutdown');
