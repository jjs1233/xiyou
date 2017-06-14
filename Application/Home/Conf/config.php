<?php
return array(
	//'配置项'=>'配置值'
		'TMPL_PARSE_STRING' =>  array( // 添加输出替换
    //'__UPLOAD__'    =>  __ROOT__.'/Admin/Public/Uploads',//__ROOT__网站根目录，跟网站的入口文件位置相同
    '__JS__' => __ROOT__.'/Public/js',
    '__CSS__' => __ROOT__.'/Public/css',
    '__IMG__' => __ROOT__.'/Public/images',
    '__FONT__'=>__ROOT__.'/Public/font',
	  '__YINYUE__'=>__ROOT__.'/Public/audio',
    ),
	
	 // 'DB_PREFIX' => 'wk_' //测试完要注释 不然你的程序无法运行
);