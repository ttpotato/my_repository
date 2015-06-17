<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Baidu API Test</title>
		<link rel="shortcut icon" href="__PUBLIC__/img/favicon.png">
		<link href="__PUBLIC__/css/bootstrap.css" rel="stylesheet">
		<link href="__PUBLIC__/css/docs.css" rel="stylesheet">
		<link href="__PUBLIC__/css/prettify.css" rel="stylesheet">
		<link href="__PUBLIC__/css/common.css" rel="stylesheet">
		<link href="__PUBLIC__/css/page.css" rel="stylesheet">
		<link href="__PUBLIC__/ZTree/css/zTreeStyle/zTreeStyle.css" rel="stylesheet">  
		<script src="__PUBLIC__/js/jquery.js"></script>
		<script src="__PUBLIC__/js/bootstrap.min.js"></script>
		<script src="__PUBLIC__/js/common.js"></script>
		<style type="text/css">
		html{
			height: 101%;
		}
			body {
			padding-top: 60px;
			padding-bottom: 40px;
			}
		</style>
		<script type="text/javascript">
			var URL = "__URL__";
			var APP = "__APP__";
			var ROOT = "__ROOT__";
			var ACTION = "__ACTION__";
		</script>
	</head>
	<body data-spy="scroll" data-target=".bs-docs-sidebar">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="span10 offset1">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="brand" href="<?php echo U('Index/index');?>">BAT</a>
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"  id="current_space">欢迎您：<?php echo session('username'); ?><b class="caret"></b></a>
					<ul class="dropdown-menu" >						
						<li><a href="<?php echo U('User/updateInfo');?>">个人资料</a></li>
						<li><a href="<?php echo U('User/updatePwd');?>">密码修改</a></li>
						<li><a href="<?php echo U('Login/loginOut');?>">安全退出</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav" id="appList">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="current_space" style="width:80px;">
						<?php echo session('appName'); ?><b class="caret"></b>
					</a>
					<ul class="dropdown-menu" id="space_menu"></ul>
				</li>
			</ul>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li id="index_page"><a href="<?php echo U('Index/index');?>">首页</a></li>
					<li id="api_page" class="login_req"><a href="<?php echo U('Api/alist');?>">API</a></li>
					<li id="data_page" class="login_req"><a href="<?php echo U('Data/dlist');?>">数据</a></li>
					<li id="case_page" class="login_req"><a href="<?php echo U('Case/clist');?>">用例</a></li>
					<li id="plan_page" class="login_req"><a href="<?php echo U('Plan/plist');?>">计划</a></li>
					<li id="project_page" class="login_req dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">项目管理<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo U('User/ulist');?>">用户管理</a></li>
							<li><a href="<?php echo U('App/applist');?>">APP管理</a></li>
							<li><a href="<?php echo U('Module/mlist');?>">模块管理</a></li>
						</ul>
					</li>
					<li id="help_page"><a href="<?php echo U('Help/index');?>">函数帮助</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
			</div>
			<div class="row-fluid">
				<div class="span10 offset1">
	<div class="span12">
		<ul class="breadcrumb">
			<li><a href="<?php echo U('Index/index');?>">首页</a> <span class="divider">/</span></li>
			<li><a href="<?php echo U('Api/alist');?>">API</a> <span class="divider">/</span></li>
			<li>列表</li>
		</ul>
	</div>
	<div class="span12">
		<div class="bc">
			<form class="form-inline" action="<?php echo U('Api/alist');?>" method="get">
				<label>ID：</label>
				<input style="width:80px;" type="text" name="apiId" placeholder="API--ID" value="<?php echo ($_GET['apiId']); ?>" /> 
				<label>PATH：</label>
				<input id="api_path" class="span3" type="text" name="path" placeholder="URL的Path部分"  value="<?php echo ($_GET['path']); ?>" autocomplete="off"/> 
				<label>方法：</label>
				<select name="method" class="span1" value="<?php echo ($_GET['method']); ?>">
					<option></option>
					<option value="GET">GET</option>
					<option value="POST">POST</option>
					<option value="PUT">PUT</option>
					<option value="DELETE">DELETE</option>
					<option value="HEAD">HEAD</option>
					<option value="OPTIONS">OPTIONS</option>
					<option value="TRACE">TRACE</option>
					<option value="PATCH">PATCH</option>
				</select>
				<label>&nbsp&nbsp模块：</label>
				<select name="mid" class="span1" value="<?php echo ($_GET['mid']); ?>">
				</select>
				<label>负责人：</label>
				<input class="span2" type="text" name="owner" placeholder="作者" value="<?php echo ($_GET['owner']); ?>" />
				<button type="submit" class="btn btn-info" >查找</button>
				<button class="btn btn-info" id="reset-btn">重置</button>
			</form>
		</div>
	</div>
	<div class="btn-group tool-btn">
		<a href="<?php echo U('Api/add');?>" id="api_add" class="btn btn-info">新增</a>
		<a id="api_update" class="btn btn-info">修改</a>
		<a id="api_delete" class="btn btn-info">删除</a>
	</div>
	<div class="btn-group tool-btn">
		<a id="case_add" class="btn btn-info">制作用例</a>
	</div>
	<div class="span12" id="apis-data">
		<table class="table table-hover table-condensed table-bordered table-striped">
			<thead>
				<tr>
					<th width="2%" style="text-align: center;"><input
						id="selectAll" type="checkbox" /></th>
					<th width="5%">ID</th>
					<th width="15%">HOST</th>
					<th width="20%">PATH</th>
					<th width="5%">方法</th>
					<th width="20%">描述</th>
					<th width="5%">引用</th>
					<th width="5%">模块</th>
					<th width="8%">责任人</th>
					<th width="15%">更新时间</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($apis)): if(is_array($apis)): $i = 0; $__LIST__ = $apis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$api): $mod = ($i % 2 );++$i;?><tr>
					<td style="text-align: center;"><input class="selectCell"
						type="checkbox" value="<?php echo ($api["id"]); ?>" /></td>
					<td><?php echo ($api["id"]); ?></td>
					<td title="<?php echo (htmlspecialchars($api["host"])); ?>">
						<?php if(strlen($api['host']) > 30): echo (substr($api["host"],0,30)); ?>...<?php else: echo ($api["host"]); endif; ?>
					</td>
					<td title="<?php echo (htmlspecialchars($api["path"])); ?>">
						<?php if(strlen($api['path']) > 30): echo (substr($api["path"],0,30)); ?>...<?php else: echo ($api["path"]); endif; ?>
					</td>
					<td><?php echo ($api["method"]); ?></td>
					<td title="<?php echo (htmlspecialchars($api["desc"])); ?>">
						<?php if(mb_strlen($api['desc'],'utf8') > 14): echo (mb_substr($api["desc"],0,14,utf8)); ?>...<?php else: echo ($api["desc"]); endif; ?>
					</td>
					<td><?php echo ($api["times"]); ?></td>
					<td><?php echo ($api["module"]["name"]); ?></td>
					<td><?php echo ($api["user"]["name"]); ?></td>
					<td><?php echo ($api["updateTime"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?> 
				<?php else: ?>
				<tr>
					<td colspan="18" style="text-align: center;">对不起，暂时没有任何数据</td>
				</tr><?php endif; ?>
			</tbody>
		</table>
	</div>
	<div class="green-black"><?php echo ($paging); ?></div>
</div>
<script src="__PUBLIC__/js/api.js"></script>

			</div>
			<div class="row-fluid">
				<div class="row-fluid footer">
	<footer>
		<div class="container">
			<p >&copy;from  2014 <i class="icon-check"></i>使用中有任何问题请加QQ群咨询:188734537</p>
		</div>
	</footer>
</div>
			</div>
		</div>
		<div class="non">
			<div id="error" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;margin-left:-200px;">
				<div class="modal-header alert alert-error">
					<h4 id="myModalLabel">友情提示：</h4>
				</div>
				<div class="modal-body">
					<i class="icon-warning-sign"></i> <span id="error_body"></span>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
					<button class="btn btn-primary" id="error_conform" data-dismiss="modal" aria-hidden="true">确认</button>
				</div>
			</div>
		</div>
		<div style="">
			<div class="alert alert-block alert-error" id="errmsg">
			  	<i class="icon-warning-sign"></i><strong>Warning：</strong>
			  	<span></span>
			</div>
		</div>
	</body>
</html>