$(function () {
	$('.teacher-item').click(function(){
        var dialog = $('#ajaxDialog');
		var me = $(this);
		if(me.hasClass('finished'))
			return;
		dialog.find('#a').html(me.attr('Cname'));
                dialog.find('#b').html(me.attr('Tname'));
		ajaxForm.teacher_id.value =  me.attr('teacher_id');
		// 清空上次的选择
		new Star("#ajaxForm .starWidget").reset();
                ajaxForm.reset();
		// 隐藏结果区
		$('.result-container').hide();
		// 显示模态框
		dialog.find('.modal-footer').show();
		dialog.modal('show');
	});

	// 显示打分的文字评价
	$('.starRow .more').click(function(){
		$(this).parents('.starRow').next('.boxt').toggle();
	});

	/* ajax提交 */
	$('#ajaxSubmit').click(function(){
		var data = {};
		for (var i = 0; i < ajaxForm.elements.length; i++) {
			// 从表单获取数据
			var el = ajaxForm.elements[i];
			data[el.name] = el.value;
		};
		$.post(ajaxForm.action, data, onAjaxResponse);
	})
});
function open_w(v){
    v = document.getElementById(v);
    v.style.width='380px';
    v.style.height='230px';
    v.style.display='block';
}
function close_w(v){
    close_t(v);
    v=document.getElementById(v);
    v.style.display='none';
}
function open_t(v){
     v = document.getElementById(v);
     v.style.height='338px';
     v.style.display='block';
}
function close_t(v){
    v=document.getElementById(v);
    v.style.display='none';
}

/* ajax响应 */
function onAjaxResponse(data, status) {
	if(status == 'success'){
		$('.result-container').show().find('.result').html(data);
		if(data == '提交成功')
		{
			var dialog = $('#ajaxDialog');
			dialog.find('.modal-footer').hide();
			// 两秒后隐藏模态框
			setTimeout(function () {
				dialog.modal('hide');
			}, 2000);

		}
	}
}