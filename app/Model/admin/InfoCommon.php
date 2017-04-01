<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class InfoCommon extends Model
{
	/**
	 * 与模型关联的数据表
	 *
	 * @var string
	 */
	protected $table = 'InfoCommon';
	
	/**
	* 该模型是否被自动维护时间戳
	*
	* @var bool
	*/
	public $timestamps = false;
}
