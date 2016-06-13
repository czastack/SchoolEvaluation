$(function () {
	// 初始化 长文本输入框
	$(".longtext input[type=file]").change(function(evt){
		if (!window.FileReader) return;

		var img = $(this).parent().prev('img');
		var file = evt.target.files[0];

		if (!file || !file.type.match('image.*')) {
			img.removeAttr('src').addClass('noimg');
			return false;
		}

		var reader = new FileReader();
		reader.onload = function(e) {
			img.removeClass('noimg').attr('src',  e.target.result);
		};

		reader.readAsDataURL(file);
	});

	$(".longtext .btnRemoveImg").click(function () {
		var longtext = $(this).parent();
		longtext.find('img').removeAttr('src').addClass('noimg');
		longtext.find('input[type=file]').val('');
	});
});