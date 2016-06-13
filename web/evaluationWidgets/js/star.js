$(function () {
	// 初始化
	$('.starWidget').find('span').click(function(){
		var me = $(this);
		var ACTIVE = Star.prototype.ACTIVE;
		if(me.hasClass(ACTIVE))
			return;
		var parent = me.parent();
		if(parent.hasClass('disabled'))
			return;

		me.siblings('.' + ACTIVE).removeClass(ACTIVE);
		me.addClass(ACTIVE);

		parent.find('input').val(parent.find('span').length - me.index());
	});
});

function Star(selector) {
	this.container = $(selector);
}
Star.prototype.ACTIVE = 'active';
/* 清空上次选中 */
Star.prototype.clearLast = function() {
	this.container.find('.' + this.ACTIVE).removeClass(this.ACTIVE);
}
/* 设置当前星级 */
Star.prototype.setValue = function(value) {
	this.container.each(function () {
		var star = new Star(this);
		var list = star.container.find('span');
		if(value > 0 & value <= list.length){
			star.clearLast();
			list.eq(list.length - value).addClass(star.ACTIVE);
			star.container.find('input').val(value);
		}
	});
};
/* 清空值 */
Star.prototype.reset = function(value) {
	this.container.find('input').val(value);
	this.clearLast();
}