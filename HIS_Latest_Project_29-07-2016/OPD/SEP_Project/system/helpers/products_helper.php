<?php

include_once 'json_helper.php';

function product_image_tag($product) {
  $path = strtolower($product['name']);
  return "<img src=\"assets/products/{$path}.jpg\" alt=\"{$product['name']}\">";
}

function fetch_products() {
  return read_json(products_path());
}

function fetch_product_by_id($id) {
  $products = fetch_products();
  if (!isset($products)) return;

  foreach ($products as $product)
    if ($product['id'] == $id)
      return $product;
}

function products_path() {
  return "db/products.json";
}

?>