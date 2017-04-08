<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	/**
	 * 与模型关联的数据表
	 *
	 * @var string
	 */
	protected $table = 'User';
	
	/**
	 * 与模型相关联的主键
	 * @var integer
	 */
	protected $primaryKey = 'UserId';

	 /**
	 * 该模型是否被自动维护时间戳
	 *
	 * @var bool
	 */
	public $timestamps = false;
}
