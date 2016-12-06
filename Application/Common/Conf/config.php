<?php
return array(
	//'配置项'=>'配置值'
	/* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'jx_',    // 数据库表前缀

    // 激活邮箱秘钥
    'EMAIL_KEY'				=>	'tQMCouXW32yOx9cgxWMMTzbtxwwa22vQ',

    // 用于富文本编辑器与XSS攻击的解决方案
    'DEFAULT_FILTER'        =>  'removeXSS',

    // 文件上传的配置信息
    'MAX_UPLOAD_FILE_SIZE'  =>  '3M',
    'UPLOAD_ROOT_PATH'      =>  './Public/Uploads/',
    'ALLOW_EXTS'            =>  array('jpg', 'gif', 'png', 'jpeg'),
    'THUMB'     =>  array(
        'THUMB_W'       =>  150,
        'THUMB_H'       =>  150,
        'THUMB_S'       =>  1,
    ),

    'VIEW_ROOT_PATH'        =>  '/Public/Uploads/',
);