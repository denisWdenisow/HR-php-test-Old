<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
	
	// Запрос погода через API Яндекс.Погоды
    private function requestWeather($url, $method)
    {
		$data = null;		
        $headers = array(
            'X-Yandex-API-Key: 97de2439-bc23-4f3a-ae23-a698d5b243b6'
        );        
        $rw = curl_init();
        curl_setopt($rw, CURLOPT_URL, $url);
        curl_setopt($rw, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($rw, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($rw, CURLOPT_HTTPHEADER, $headers);        
        $data = curl_exec($rw);        
        curl_close($rw);
        if ($data===false) 
        	print 'error with curl - '.curl_error($rw).'<br />';
		else
        	return $data;
    }
    
    
    // Отображение результата пользователю
    public function showTemperature()
    {
    	$answer = $this->requestWeather('https://api.weather.yandex.ru/v1/forecast?lat=53.25209&lon=34.37167&lang=ru_RU&limit=0&extra=false','GET');	  	
    	$temp = json_decode($answer,$assoc=true);
    	$temperature = $temp['fact']['temp'];
		return view('weather',['temperature'=>$temperature]);
	}
}
