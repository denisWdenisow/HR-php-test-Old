<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
	public function status()
	{
		return $this->hasOne('App\Status','code','status');
	}

	
	// Список заказов
    public function getOrderList()
    {	
    	$result_array = array();
    	// Получение данных из БД	
		$order_list = DB::select('SELECT orders.id,(SELECT statuses.name FROM statuses WHERE statuses.code=orders.status) as statusName, partners.name, SUM(order_products.price*order_products.quantity) as order_sum FROM `orders` INNER JOIN partners ON orders.partner_id=partners.id INNER JOIN order_products ON orders.id=order_products.order_id GROUP BY orders.id');
		$order_product = DB::select('SELECT order_products.order_id, products.name FROM order_products INNER JOIN products ON order_products.product_id=products.id');
		// Формирование комплектов продукта для каждого заказа
		$name_product_array = array();
		foreach ($order_product as $poduct_list){
			$name_product_array[$poduct_list->order_id][] = $poduct_list->name;
		}
		// Компановка результатирующего массива
		$result_array['order_list'] = $order_list;
		$result_array['name_product_array'] = $name_product_array;				
		return $result_array;
	} 
	
	
	// Сумма заказа для формы редактирования
	public function orderSum($order_id)
	{
		$result_array = DB::select('SELECT SUM(order_products.price*order_products.quantity) as order_sum FROM orders INNER JOIN order_products ON orders.id=order_products.order_id WHERE orders.id=?',[$order_id]);
		return $result_array[0]->order_sum;
	}
}
