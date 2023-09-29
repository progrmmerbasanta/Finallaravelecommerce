<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class signp extends Model
{
    use HasFactory;
	protected $table = 'signp';

	public $timestamps = false;
	protected $fillable = ['id','f_name','f_phone','f_email','f_password'];


	protected $guarded = [''];

}
