<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //Определяем ключевое поле
    protected $primaryKey = 'code';    
    //Отключаем дату создания и обновления
    public $timestamps = false;
}
