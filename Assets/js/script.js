var script = function() {
    var win = $(window);
    var html = $('html');
    var body = $('body');

    // mMenu
    var mMenu = function() {
        var menu = $('.m-nav');
        var ct = menu.find('.nav-ct');
        var open = $('.nav-open');
        var close = $('.nav-close');
        ct.append($('.h-hotline').clone());
        ct.append($('.main-nav').clone());
        open.click(function(e) {
            e.preventDefault();
            if (win.width() < 992) {
                menu.addClass('act');
            }
        });
        close.click(function(e) {
            e.preventDefault();
            if (win.width() < 992) {
                menu.removeClass('act');
            }
        });
        var sidebar = $('.sb-nav');
        var ct2 = sidebar.find('.nav-ct');
        var open2 = $('.sb-open');
        var close2 = $('.sb-close');
        open2.click(function(e) {
            e.preventDefault();
            if (win.width() < 992) {
                sidebar.addClass('act');
            }
        });
        close2.click(function(e) {
            e.preventDefault();
            if (win.width() < 992) {
                sidebar.removeClass('act');
            }
        });
        win.click(function(e) {
            if (menu.has(e.target).length == 0 && !menu.is(e.target) && open.has(e.target).length == 0 && !open.is(e.target)) {
                menu.removeClass('act');
            }
            if (sidebar.has(e.target).length == 0 && !sidebar.is(e.target) && open2.has(e.target).length == 0 && !open2.is(e.target)) {
                sidebar.removeClass('act');
            }
        });
        nav = menu.find('.main-nav');
        nav.find("ul li").each(function() {
            if ($(this).find("ul>li").length > 0) {
                $(this).prepend('<i class="nav-drop"></i>');
            }
        });
        $(".nav-drop").click(function() {
            var ul = $(this).nextAll("ul");
            if (ul.is(":hidden") === true) {
                ul.parent('li').parent().children().children('ul').slideUp(200);
                ul.parent('li').parent().children().children('.nav-drop').removeClass("act");
                $(this).addClass("act");
                ul.slideDown(200);
            } else {
                ul.slideUp(200);
                $(this).removeClass("act");
            }
        });
    }
    // fixMenu
    var fixMenu = function() {
        win.bind('scroll', function() {
            if (win.scrollTop() > 32) {
                $('#menu').addClass('fixed');
            } else {
                $('#menu').removeClass('fixed');
            }
        })
    }
    /*
    // loader
    var loader = function(){
        win.on('load', function () {
            $("#loader").delay(300).fadeOut();
        });
    }
    */
    // Add smooth scrolling to all links
    var scrolling = function(){
        $(".main-nav a").click(function(){
        if (this.hash !== "") {
				//event.preventDefault();
				var hash = this.hash;
		    	$('html, body').animate({
		        	scrollTop: $(hash).offset().top
		    	}, 800, function(){

		        window.location.hash = hash;
		      });
		    }
        });
    }
    
    var widget = function() {
        $(".widget-toc a").click(function(event) {
            var id = $(this).attr("href");
            id = id.split("#");
            id = "#" + id[id.length - 1];
            var pos = $(id).offset().top - 30;
            $("html,body").animate({
                scrollTop: pos
            }, "slow");
            return false;
        });
    }
    return {
        RUN: function($run) {
            switch ($run) {
                case 'mMenu':
                    mMenu();
                    break;
                case 'fixMenu':
                    fixMenu();
                    break;
                case 'scrolling':
                    scrolling();
                    break;
                case 'widget':
                    widget();
                    break;
                default:
                    mMenu();
                    fixMenu();
                    scrolling();
                    widget();
            }
        }
    }
}();

jQuery(function() {
    script.RUN();
});