<?php

const PARTIALS_DIR = 'includes/';
const PARTIALS_PREFIX = '_';

# First argument is the object or objects to render
# Second argument is the name of the partial to render
# Third argument is a function to run if there are no $objects to render
function render($objects, $partial_name, $null_function = null) {
  if (!isset($objects))
    return isset($null_function) ? $null_function() : false;

  if (is_numeric_array($objects))
    return render_collection($objects, $partial_name);

  return render_member($objects, $partial_name);
}

function render_collection($objects, $partial_name) {
  foreach ($objects as $object)
    render_member($object, $partial_name);
}

function render_member($object, $partial_name) {
  eval("\${$partial_name} = \$object;"); # $product = $object;
  include(partial_path($partial_name));
}

function render_inline($object, $partial_name) {
  eval("\${$partial_name} = \$object;"); # $product = $object;
  ob_start();
  include(partial_path($partial_name));
  return ob_get_clean();
}

function partial_path($name) {
  return PARTIALS_DIR . PARTIALS_PREFIX . $name . '.php';
}

function is_numeric_array($array) {
  if (!is_array($array)) return false;

  $keys = array_keys($array);
  return ($keys === array_keys($keys));
}
?>