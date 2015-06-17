$(document).ready(function(){
	//选中的菜单高亮
	$("#app_page").addClass("active");

	//提交新增操作
	$("#app_add_form").submit(doAdd);
	
	//提交更新表单
	$("#app_update_form").submit(doUpdate);
	
	//更新操作勾选检查
	$("#app_update").click(function(){
		var checked_num = $(".selectCell:checked").length; 
		if (checked_num > 1) {
			showError("一次只能修改一条记录！");
			return false;
		};

		if (checked_num < 1) {
			showInfo("请选择需要修改的记录！");
			return false;
		}; 

		var id = $(".selectCell:checked").attr("value");
		redirect("/App/update?id=" + id);
	});

	

	//删除操作
	$("#app_delete").click(function(){
		var checked_num = $(".selectCell:checked").length; 
		if (checked_num < 1) {
			showInfo("请选择需要删除的记录！");
			return false;
		}; 

		showError("该操作不可逆，你确认要删除这些记录吗？");

		$("#error_conform").click(function(){
			$('#error').modal('hide');
			var ids = new Array();
			$(".selectCell:checked").each(function(){
				id = $(this).attr("value");
				ids.push(id);
			});
	        $.ajax({
	            type: "post",
	            url: URL + "/delete",
	            data: "ids=" + ids,
	            success:function (result) {
	            	status = result.status;
	            	if(status == 10001){
	            		redirect('/Login/login');
	            	}
	            	if (status == "success:true") {
	            		location.reload();
	            	}
	            	if(status == 'success:false'){
	            		showError(result.info);
	            		return false;
	            	}
	            },
	        });	
		});
	});

});

//新增app到数据库
var doAdd = function(){
	$.ajax({
		type:"post",
		url:URL + "/doAdd",
		data:$('#app_add_form').serialize(),
		success:function(result){
			status = result.status;
			if(status == 10001){
				redirect('/Login/login');
			}
			if(status == "success:true") {
				redirect('/App/applist');
			} 
			if(status == "success:false"){
				console.info(status);
				showInfo(result.info);
			}
		}
	});
	return false;
}

//异步更新app
var doUpdate = function(){
	$.ajax({
		type:"post",
		url:URL + "/doUpdate",
		data:$('#app_update_form').serialize(),
		success:function(result){
			status = result.status;
			if(status == 10001){
				redirect('/Login/login');
			}
			if(status == "success:true") {
				redirect('/App/applist');
			} 
			if(status == 'success:false'){
				showInfo(result.info);
			}
		}
	});
	return false;
}




