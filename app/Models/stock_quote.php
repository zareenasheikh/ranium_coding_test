<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stock_quote extends Model
{
     protected $fillable = [

'quote_symbol',
'quote_open',
'quote_high',
'quote_low',
'quote_price',
'quote_volume',
'quote_latest_trading_day',
'quote_previous_close',
'quote_change',
'quote_change_percent',

	 ];
}
		

 // php artisan make:migration create_stock_quotes_table --create=stock_quotes