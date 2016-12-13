<?php 
namespace Home\Model;
use Think\Model;

class GoodsModel extends Model 
{
	
	// 获取首页的推荐信息 is_crazy is_hot is_new is_best is_random
	public function getRecGoods($type, $limit = 5)
	{
		$where = array('is_delete' => 0, 'is_sale' => 1);
		if($type == 'is_random'){
			// mysql> select goods_id,goods_name from sh_goods order by rand() limit 5;
			return $this->field('goods_id,goods_name,goods_thumb,goods_price')->where($where)->order('rand()')->limit($limit)->select();

		}else if($type == 'is_crazy'){
			// 获取商品价格最贵的前5的商品
			return $this->field('goods_id,goods_name,goods_thumb,goods_price')->where($where)->order('goods_price desc')->limit($limit)->select();
		}else{
			$where = array($type=> 1, 'is_delete' => 0, 'is_sale' => 1); // is_hot = 1 and is_delete = 0 and is_sale = 1
			return $this->field('goods_id,goods_name,goods_thumb,goods_price')->where($where)->limit($limit)->select();
		}
	}
}

 ?>