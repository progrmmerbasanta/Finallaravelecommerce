<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
	protected $table = 'cart';

	public $timestamps = false;
	protected $fillable = ['id','name','price','img','quantity','isExist','time','product'];


	protected $guarded = [''];

}
