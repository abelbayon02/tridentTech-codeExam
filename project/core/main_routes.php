<?php 
switch ($access) {
	case 'product-category':
		require 'views/product_category.php';
		break;
	case 'products':
		require 'views/products.php';
		break;
	default:
		# code...
		break;
}