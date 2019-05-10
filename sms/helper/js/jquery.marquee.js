(function($) {
		  
$.fn.fMarquee = function(o) {
    o = $.extend({
		'height'	: 100,
		'width'		: 650,
		'showtime'	: 5000,
		'direction'	: 'left'
    }, o || {});
	
    this.each(function(ib) {
		var t = $(this);
		var msgs = [];
		var i = 0;
	
		t.css({'position':'relative', 'height': o.height+'px', 'width': o.width+'px', 'overflow': 'hidden'});
		
		t.find('div.mchild').each(function(id) {
			/* Save each one of the mchild divs into the msgs array and give them the basic css */
			var c = msgs[id] = $(this);
			c.css({'position':'absolute', 'opacity':'0', 'width': ((!c.css('width')) ? t.width() : c.css('width'))+'px', 'left': t.width()+'px'});
			i++;
		});
		
		startAnimation(0); /* start animation by 0 */
		
		function startAnimation(id) {
			var el = msgs[id];
			
			/* Animation direction */
			switch(o.direction) {
				case 'right':
					var _1_start_x 	= (-1)*(t.width()) +'px';
					var _1_end_x 	= '0px';
					var _2_end_x	= (t.width() - el.width()) + 'px';
					var _3_end_x	= (t.width()) +'px';
					break;
				case 'left':
				default:
					var _1_start_x 	= (t.width()) +'px';
					var _1_end_x 	= (t.width() - el.width()) +'px';
					var _2_end_x	= ((t.width()/8)*1) + 'px';
					var _3_end_x	= (-1)*(t.width()) +'px';
					break;
			}
			
			el.css({'left':_1_start_x});
			/* Start the animation */
			el.animate({'left':_1_end_x, 'opacity':1}, 500, 'easeInQuad', function() {										   
				el.animate({'left':_2_end_x, 'opacity':1}, o.showtime, 'easeOutQuad', function() { 
					el.animate({'left':_3_end_x, 'opacity':0}, 500, 'easeOutQuad', function() {
						/* Decide wether to go for the next child, or start from 0 again */
						if (id == (i-1)) { startAnimation(0); }
						else { startAnimation(id+1); }
						
					});
				});
			});
		}
		
		
    });
	
};

})(jQuery);