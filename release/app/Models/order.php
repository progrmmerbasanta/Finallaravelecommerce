<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
	protected $table = 'order';

	public $timestamps = true;
	protected $fillable = ['id','name','price','img','quantity','isExist','time','status','product'];

	protected $casts = [
		'product' => 'array',
	];
	protected $guarded = [''];

}
