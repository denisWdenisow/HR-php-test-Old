<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Partner;
use App\Status;
use App\OrderProduct;

class OrderController extends Controller
{
	
	// Список всех заказов
    public function orderList()
    {	
		$order = new Order;
		$order_list = $order->getOrderList();
		return view('order',[
			'order_list'=>$order_list['order_list'],
			'name_product_array'=>$order_list['name_product_array']
		]);
	} 
	
	
	// Наполнение формы для редактирования данными заказа 
	public function showOrder(Request $request){
		// Если выбран заказ
		if (isset($request->order_id)){
			$order = new Order;
			$info_order = $order::find($request->order_id);	
			$sum_order = $order->orderSum($request->order_id);
			$order_product = new OrderProduct;
			$product_list = $order_product->listProductInOrder($request->order_id);
		}
		// Если новый заказ
		else{
			$info_order = null;
			$sum_order = 0;
			$product_list = array();
		}
		// Партнеры
		$partner = new Partner;
		$partner_list = $partner::all();
		// Статусы
		$status = new Status;
		$status_list = $status::all();
		
		return view('order_editor',[
			'info_order'=>$info_order,
			'partner_list'=>$partner_list,
			'status_list'=>$status_list,
			'sum_order'=>$sum_order,
			'product_list'=>$product_list
		]);
	}
	
	
	public function saveOrder(Request $request)
	{
		// Проверка правильости заполнения полей формы
    	$this->validate($request,[
    		'client_mail' => 'required|email',
    		'partner' => 'required|min:1',
    		'status' => 'required'
    	]);
    	// Запись информации в БД
    	try{
	       $new_order = Order::find($request->order_id) ?? $new_order = new Order;
	       $new_order->client_email = $request->client_mail;
	       $new_order->partner_id = $request->partner;
	       $new_order->status = $request->status;
	       $new_order->save();
	       // Перемещаемся на страницу заказов
	       return redirect('order');
	    }
	    catch(\Exception $e){
	       // Сообщение если ошибка
	       echo $e->getMessage(); 
	    }
    	
	}
	
}
