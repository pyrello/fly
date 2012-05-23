/**
 * @todo
 */
var target = '';
(function($) {
	/**
   * @todo
   */	
	Drupal.behaviors.fly = {
		attach: function (context) {
			
			$('.user-menu-link>a').click( function() {
				if ($(this).hasClass('active')) {
					$('.user-menu-link .menu').hide();
					$(this).removeClass('active');
					return false;
				} else {
					$('.user-menu-link .menu').show();
					$(this).addClass('active');
					return false;
				}
			});
			
			$('.user-login-link>a').click( function() {
				if ($(this).hasClass('active')) {
					$('.user-login-link .menu').hide();
					$(this).removeClass('active');
					return false;
				} else {
					$('.user-login-link .menu').show();
					$(this).addClass('active');
					return false;
				}
			});
			$(document).click(function(e) {
				if ($(e.target).parents('#menu-login').length === 0 && e.target.id !== 'block-user-login') {
					$('#menu-login').hide();
					$('.user-login-link>a').removeClass('active'); 
				}
				if ($(e.target).parents('.user-menu-link').length === 0 && e.target.className !== 'user-menu-link') {
					$('.user-menu-link .menu').hide();
					$('.user-menu-link>a').removeClass('active'); 
				}
			});
		}
	} // Drupal.behaviors.bump_seven
	
})(jQuery);