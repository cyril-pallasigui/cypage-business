( function( $ ) {
	wp.customize.bind('ready', function () {

		wp.customize.control('testimonials_enabled', function (control) {
			control.setting.bind(function(value) {
				switch (value) {
					case 'yes':
						wp.customize.control('testimonials_heading').toggle(true);
						break;
					case 'no':
						wp.customize.control('testimonials_heading').toggle(false);
						break;
				}
			});
		});

		wp.customize.control('services_enabled', function (control) {
			control.setting.bind(function(value) {
				switch (value) {
					case 'yes':
						wp.customize.control('services_heading').toggle(true);
						break;
					case 'no':
						wp.customize.control('services_heading').toggle(false);
						break;
				}
			});
		});

		wp.customize.control('gallery_enabled', function (control) {
			control.setting.bind(function(value) {
				switch (value) {
					case 'yes':
						wp.customize.control('gallery_heading').toggle(true);
						break;
					case 'no':
						wp.customize.control('gallery_heading').toggle(false);
						break;
				}
			});
		});

	});
} )( jQuery );

