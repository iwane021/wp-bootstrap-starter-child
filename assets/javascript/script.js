jQuery(function($) {

    // Add custom script here. Please backup the file before editing/modifying. Thanks
    
    // Run the script once the document is ready
    $(document).ready(function() {
    	$(window).scroll(function () {
    		var navbar = document.getElementById("subnav").offsetTop;
    		if ($(window).scrollTop() > navbar) {
				$('#subnav').addClass('navbar-fixed');
			}
			else {
				$('#subnav').removeClass('navbar-fixed');
			}
		});
    });

    // Run the script once the window finishes loading
    $(window).load(function(){
        
    });


});
