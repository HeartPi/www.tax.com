<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IndentModel extends Model
{
    //表明
    protected $table = 'indent';

    /**
     * 开启自动维护时间戳
     */
    public $timestaps = true;

    /**
     * 自动时间默认值默认值 
     */
    public function freshTimestamp()
    {
        return time();
    }
    /**
	 * 从数据库获取的为获取时间戳格式
	 *
	 * @return string
	 */
	public function getDateFormat() {
		return 'U';
    }
    /**
	 * select的时候避免转换时间为Carbon
	 *
	 * @param mixed $value
	 * @return mixed
	 */
//  protected function asDateTime($value) {
//	  return $value;
//  }
/**
	 * 避免转换时间戳为时间字符串
	 *
	 * @param DateTime|int $value
	 * @return DateTime|int
	 */
	public function fromDateTime($value) {
		return $value;
	}
}
