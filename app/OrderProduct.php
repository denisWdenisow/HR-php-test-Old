<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderProduct extends Model
{
	public function listProductInOrder($id_order)
	{
		// Список продуктов заказа для формы редактирования
		$list_product = DB::select('SELECT products.id,products.name,SUM(order_products.quantity) as sum_quant FROM `order_products` INNER JOIN products ON order_products.product_id=products.id WHERE order_products.order_id=? GROUP BY order_products.product_id',[$id_order]);
		return $list_product;
	}
	
	
}
