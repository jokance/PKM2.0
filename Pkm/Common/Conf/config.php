<?php
return array(
	//'配置项'=>'配置值'
	//禁止模块访问
	//'MODULE_DENY_LIST'=>array('Common','Runtime','Admin'),
	//允许模块访问
	'MODULE_ALLOW_LIST'=>array('Home','Admin'),
	//设置默认的加载模块
	'DEFAULT_MODULE'=>'Home',
	//只允许一个模块
	//'MULTI_MODULE'=>false,
	//设置PATHINFO的URL分隔符
	//'URL_PATHINFO_DEPR'=>'_',
	//修改键的名称
// 	'VAR_MODULE'=>'mm',
// 	'VAR_CONTROLLER'=>'cc',
// 	'VAR_ACTION'=>'aa',
	
	//数据库配置
	/*
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'localhost',
	'DB_USER'=>'root',
	'DB_NAME'=>'thinkphp',
	'DB_PWD'=>'123',
	'DB_PORT'=>3306,
	'DB_PREFIX'=>'pkm_',
	*/
	
	//PDO专用定义
	
	'DB_TYPE'=>'pdo',
	'DB_USER'=>'root',
	'DB_PWD'=>'123',
	'DB_PREFIX'=>'pkm_',
	'DB_DSN'=>'mysql:host=localhost;dbname=pkm;charset=UTF8',
	
	//页面Trace，调试辅助工具
	'SHOW_PAGE_TRACE' =>true,		
		
	//关闭字段缓存	
	//'DB_FIELDS_CACHE'=>false,
	
	//修改视图目录，默认是View
	//'DEFAULT_V_LAYER'=>'Template',
	//修改模板文件后缀名,默认是.html
	//'TMPL_TEMPLATE_SUFFIX'=>'.tpl',
	//修改模板目录
	//'VIEW_PATH'=>'./Public/',
	//设置默认主题
	'DEFAULT_THEME'=>'default',
	
	//修改模板定界符
	//'TMPL_L_DELIM'=>'<{',
	//'TMPL_R_DELIM'=>'}>',
	
	//启用路由功能
	//'URL_ROUTER_ON'=>true,
	//配置路由规则
	//'URL_ROUTE_RULES'=>array(
	//每条键值对，对应一个路由规则
		//'u/:id\d|md5'=>'User/index',
		//正则路由
		//'/^u\/(\d{2})$/'=>'User/index?id=:1',
	//),
		
	//URL可以不区分大小写
// 	'URL_CASE_INSENSITIVE' =>true,
		
	//设置伪静态后缀，默认为html
	//'URL_HTML_SUFFIX'=>'shtml',
	//如果设置为空，那么就任意后缀
	//'URL_HTML_SUFFIX'=>'',
	//设置可以伪静态的后缀
	//'URL_HTML_SUFFIX'=>'html|shtml|xml',
	//禁止访问的后缀
	//'URL_DENY_SUFFIX' => 'html|pdf|ico|png|gif|jpg',
	//重写模式
	//'URL_MODEL'=>2

	//变量默认过滤方式,I方法
	//'DEFAULT_FILTER' => 'addslashes,htmlspecialchars',
		
);