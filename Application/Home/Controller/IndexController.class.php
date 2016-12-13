<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 前台控制器
 */
class IndexController extends Controller {

    public function index(){
    	// 实例名栏目模型，然后调用getNav方法
    	$cateModel = D("Category");
    	// 连接memcache给栏目增加一个小时的缓存 1000 1 999
    	// 1. 先连接memcache，先去memcache查，第一次肯定不存在的【注意key的构造，唯一 公司前缀_数据库_表_操作行为 -- md5次】
    	// 2. 去数据库取，还要在memcache里面缓存一份，然后在返回
    	// 3. 只要在有效期内数据都是从memcache里面取的
    	$cateData = $cateModel->getNav(); // 注意：如果数组维数过多可以使用print_r打印
    	// dump($cateData);exit();
    	$this->assign('cateData', $cateData);
    	// 获取推荐商品信息
    	$goodsModel = D("Goods");
    	$bestData = $goodsModel->getRecGoods('is_best');
    	$newData = $goodsModel->getRecGoods('is_new');
    	$hotData = $goodsModel->getRecGoods('is_hot');
    	$randData = $goodsModel->getRecGoods('is_random');
    	$crazyData = $goodsModel->getRecGoods('is_crazy');

    	$this->assign(array(
    		'bestData' => $bestData,
    		'newData' => $newData,
    		'hotData' => $hotData,
    		'randData' => $randData,
    		'crazyData' => $crazyData
    	));

    	$this->display();
    }

    // 获取商品详情
    public function detail()
    {
    	$goodsId = I('get.goods_id');
    	$goodsModel = D("Goods");
    	$goodsInfo = $goodsModel->find($goodsId);
    	$this->assign('goodsInfo', $goodsInfo);
        // 获取关联商品
        $relationData = array();
        if($goodsInfo['is_relationship']){
            $relationData =  $this->_relationship($goodsInfo['is_relationship']);
        }else{
            // 随机的去取5件商品
            $relationData = $goodsModel->order('rand()')->limit(5)->select();
        }
        $this->assign('relationData', $relationData);
        // 把对应的商品信息保存到session里面
        $this->_history($goodsInfo);
        // 获取最近浏览记录
        // array_reverse(session('goodsData'), true) 第一个参数是需要倒置的数组， 第二参数是把倒置后的key保持原来的key不变
        $historyData =  array_reverse(session('goodsData'), true);
        $this->assign('historyData', $historyData);
        // 获取面包屑导航
        $cateModel = D("Category");
        $familyData = $cateModel->getFamily($goodsInfo['cate_id']);
        $familyData = array_reverse($familyData);
        $this->assign('familyData', $familyData);

    	$this->display();
    }

    

    // 获取栏目的详情
    public function category()
    {
    	$cateId = I('get.cate_id'); // 只是获取当前这个栏目下的商品信息
    	$goodsModel = D("Goods");
    	// $where = array('cate_id' => $cateId);

    	// 查看当前栏目及其子栏目的商品的信息
    	// 思路：1. 先查询对应栏目的所有的子级栏目信息 
    	// 2. 在sh_goods里面使用select * from sh_goods where cate_id in (12,45);
    	$cateModel = D("Category");
    	$cateIds = $cateModel->getChild($cateId);
    	$cateIds[] = $cateId; // 包含：自己 及其子级栏目的主键cate_id
    	$cateIds = implode(',', $cateIds);//  in (12,34,56)
    	$listData = $goodsModel->where("cate_id in ($cateIds)")->select();

    	$this->assign('listData', $listData);


        // 获取面包屑导航
        $familyData = $cateModel->getFamily($cateId);
        $familyData = array_reverse($familyData);
        $this->assign('familyData', $familyData);

    	$this->display();
    }

    public function _history($goodsInfo)
    {
        // 先查看session里面是否存在数据，如果存在则取出，不存在则初始化一个数组
        $goodsData = session('?goodsData') ? session('goodsData') : array();

        if(count($goodsData) > 2){
            array_shift($goodsData); // unshift 按进去 | push pop
        }

        $tmp = array();
        $tmp['goods_name'] = $goodsInfo['goods_name'];
        $tmp['goods_thumb'] = $goodsInfo['goods_thumb'];

        // 保存session[goods_id]  
        // [goods_id=>array('goods_name'=>'phone','goods_thumb'=>'goods/1.jpg'),  goods_id=>array('goods_name'=>'phone','goods_thumb'=>'goods/1.jpg'), goods_id=>array('goods_name'=>'phone','goods_thumb'=>'goods/1.jpg')]
        $goodsData[$goodsInfo['goods_id']] = $tmp;
        session('goodsData', $goodsData);
    }

    /**********取出商品管理商品************/
    public function _relationship($relationIds)
    {
        $goodsModel = D("Goods");
        // select * from sh_goods where goods_id in (1,2,3);
        return $goodsModel->where("goods_id in ($relationIds)")->select();


    }

    /**********前台清空session数据************/
    public function clearHistory()
    {
        session('goodsData', null);

    }

    public function test()
    {
        header('Content-Type:text/html;charset=utf-8');
        dump(session('goodsData'));
    }
}