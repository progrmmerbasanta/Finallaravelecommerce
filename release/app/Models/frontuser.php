<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class frontuser extends Model
{
    use HasFactory;
	protected $table = 'user';

	public $timestamps = false;
	protected $fillable = ['id','f_name','email','phone','order_count'];


	protected $guarded = [''];

}
