@extends('layouts.header')

@section('title')
	<title>Список всех заказов</title>
@endsection

@include('layouts.top_menu')

@section('content')
    
    <div class="row">
  		<div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table">
                	<thead>
		                <tr>
		                  	<th>ид_заказа</th>
		                  	<th>название_партнера</th>
		                  	<th>стоимость_заказа</th>
		                  	<th>наименование_состав_заказа</th>
		                  	<th>статус_заказа</th>
		                </tr>
                	</thead>
                	<tbody>
                		@foreach ($order_list as $orders)
                		<tr>                			
		                  	<td><a href="order_editor?order_id={{$orders->id}}">Заказ №{{$orders->id}}</a></td>
		                  	<td>{{$orders->name}}</td>
		                  	<td>{{$orders->order_sum}}</td>
		                  	<td>
		                  		@foreach ($name_product_array[$orders->id] as $val)
		                  		{{$val}}<br />
		                  		@endforeach
		                  	</td>
		                  	<td>{{$orders->statusName}}</td>		                  	
		                </tr>
		                @endforeach
                	</tbody>
                	<tfoot>
                		<tr>
		                  	<th></th>
		                  	<th>Сумма</th>
		                  	<th></th>
		                  	<th></th>
		                  	<th></th>
		                </tr>
                	</tfoot>
                </table>
            </div>
        </div>
    </div>
        

@endsection