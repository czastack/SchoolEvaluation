$(function () {
	var last_class_item;

	/**
	 * 点击班级列表出现弹出框
	 */
	$('.class-item').click(function(){
		var me = $(this);
		if(me.hasClass('finished'))
			return;
		last_class_item = this;
		var dialog = $('#evalClassDialog');
		// 班级名称
		dialog.find('h2').html(me.find('.class_name').html());
		// 班级图片
		dialog.find('.classImg').attr('src', me.find('img').attr('src'));
		ajaxForm.class_id.value =  me.attr('class_id');
		// 清空上次的选择
		new Star("#ajaxForm .starWidget").reset();
		// 隐藏结果区
		$('.result-container').hide();
		// 显示模态框
		dialog.find('.modal-footer').show();
		dialog.modal('show');
	});


	/* ajax提交 */
	$('#ajaxSubmit').click(function () {
		var data = {};
		for (var i = 0; i < ajaxForm.elements.length; i++) {
			// 从表单获取数据
			var el = ajaxForm.elements[i];
			data[el.name] = el.value;
		};
		$.post(ajaxForm.action, data, onAjaxResponse);
	})

	/* ajax响应 */
	function onAjaxResponse(data, status) {
		if(status == 'success'){
			$('.result-container').show().find('.result').html(data);
			if(data == '提交成功')
			{
				var dialog = $('#evalClassDialog');
				dialog.find('.modal-footer').hide();
				// 对应的列表项置为已填
				$(last_class_item).addClass('finished');
				last_class_item = null;
				
				// 两秒后隐藏模态框
				setTimeout(function () {
					dialog.modal('hide');
				}, 2000);
			}
		}
	}
});