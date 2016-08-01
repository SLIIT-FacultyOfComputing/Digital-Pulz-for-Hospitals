<?php

include_once 'render_helper.php';
include_once 'line_items_helper.php';
include_once 'cart_helper.php';

function build_json_response($type, $line_item, $total_amount) {
  $response = array(
    'cartUpdateType' => $type,
    'html' => render_inline($line_item, 'line_item'),
    'totalPriceHtml' => render_inline($total_amount, 'amount')
  );
  return json_encode($response);
}

function json_response_for_product($product) {
  $cart = current_cart();
  $line_items = $cart['line_items'];

  $index = line_items_has_product($line_items, $product);
  $line_item = isset($index) ? $line_items[$index] : null;
  $line_item = increment_or_create_item($line_item, $product);
  if (isset($index)) {
    $line_items[$index] = $line_item;
    $type = 'update';
  } else {
    $line_items[] = $line_item;
    $type = 'add';
  }

  $cart['line_items'] = $line_items;
  update_cart($cart);

  $amount = total_cart_amount($cart);
  return build_json_response($type, $line_item, $amount);
}

function increment_or_create_item($item, $product) {
  return isset($item) ? increment_line_item($item) : build_line_item($product);
}

?>
