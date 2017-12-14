<?php

function update_line_items($line_items, $product) {
  if (!isset($product)) return $line_items;

  if (!isset($line_items))
    $line_items = array();

  $index = line_items_has_product($line_items, $product);
  echo $index;
  if (isset($index))
    $line_items[$index] = increment_line_item($line_items[$index]);
  else
    $line_items[] = build_line_item($product);

  return $line_items;
}

function line_items_has_product($line_items, $product) {
  if (count($line_items) == 0) return null;

  foreach ($line_items as $i => $line_item)
    if ($line_item['product_id'] == $product['id'])
      return $i;

  return null;
}

function increment_line_item($line_item) {
  $line_item['count']++;
  $line_item['total_price'] = $line_item['price'] * $line_item['count'];
  return $line_item;
}

function build_line_item($product) {
  return array(
    'count' => 1,
    'product_id' => $product['id'],
    'name' => $product['name'],
    'price' => $product['price'],
    'total_price' => $product['price']
  );
}

?>