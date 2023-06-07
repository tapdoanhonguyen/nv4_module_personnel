(function(d){d.fn.price_format=function(){function l(k,b,a){var c='',g=a.replace(/[^0-9.]/g, '').split('');a=[];for(var e=0,h="",f=g.length-1;0<=f;f--)h+=g[f],e++,3==e&&(a.push(h),e=0,h="");0<e&&a.push(h);for(f=a.length-1;0<=f;f--){g=a[f].split("");for(e=g.length-1;0<=e;e--)c+=g[e];0<f&&(c+=",")}"input"==b?d(k).val(c):d(k).empty().text(c)}this.each(function(k,b){var a=null,c=null;d(b).is("input")||d(b).is("textarea")?(c=d(b).val().replace(/,/g,""),a="input"):(c=d(b).text().replace(/,/g,""),a="other");d(b).on("paste keyup",function(){if( d(b).val().length > 1 && $.isNumeric(d(b).val())){c=d(b).val().replace(/,/g,"").replace(/^0+/, '');}else{c=d(b).val().replace(/,/g,"");if( c== '' ) c = 0;}l(b,a,c)});l(b,a,c)})}})(jQuery);
 
function getData(b){var c={},d=/^data\-(.+)$/;$.each(b.get(0).attributes,function(b,a){if(d.test(a.nodeName)){var e=a.nodeName.match(d)[1];c[e]=a.nodeValue}});return c};
 
$.fn.center  = function() {
 
    this.css({
        'position': 'absolute',
        'left': '50%',
        'top': '50%'
    });
    this.css({
        'margin-left': -this.outerWidth() / 2 + 'px',
        'margin-top': -( $(window).height() / 2 + 100 ) + 'px'
    });

    return this;
}


$(document).ready(function() {
	
	$('[data-toggle=\'tooltip\']').tooltip({container: 'body', html: true});
 
	$('button[type=\'submit\']').on('click', function() {
		$("form[id*='form-']").submit();
	});
 
	$('.text-danger').each(function() {
		var element = $(this).parent().parent();
		
		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});
	
	$('body').on('click', '.alert i.fa-times', function(){
		$(this).parent().slideUp( "slow", function() {
			$(this).remove();
		}); 
	})
});


