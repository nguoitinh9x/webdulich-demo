<script src="Assets/addons/jquery/jquery-3.4.1.min.js"></script>
<script src="Assets/addons/bootstrap/js/bootstrap.min.js"></script> 
<script src="Assets/js/script.js?mMenu"></script>
<script src="Assets/addons/owlcarousel/dist/owl.carousel.min.js"></script>
<script src="Assets/addons/fancybox/jquery.fancybox.min.js"></script>

<?php /*
    <script src="Assets/addons/simplyscroll/jquery.simplyscroll.min.js"></script>
*/?>

<?=$plugin_jsfile?> 
<script><?=$plugin_js?></script>

<?php if($source=='contact'): ?>
    <script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit&hl=<?=$lang?>" defer></script>
    <script>
        if($('#recaptcha').length){
            var recaptcha;
            var myCallBack = function() {
                recaptcha = grecaptcha.render('recaptcha', {
                    'sitekey' : '6LfzH3YUAAAAACpJhQk9MyMXyU7RUvLCpQ6RFtwB',
                    'theme' : 'light',
                    'callback': 'verifyCapt',
                });
            };
            var verifyCapt = function( response ) {
                console.log( 'g-recaptcha-response: ' + response );
            };
        }
    </script>
<?php endif ?>

<?php if($template=='product_detail'): ?>
	<script src="Assets/addons/magiczoomplus/magiczoomplus.js"></script>
	<script>
		$(document).ready(function() {
			$(".owl_carousel_detail").owlCarousel({
				autoplayHoverPause:1,
				loop:1,
				margin:5,
				nav:0,
				dots:1,
				lazyLoad:1,
				autoplay:1,
				setTimeout:3000,
				smartSpeed:1500,
				fluidSpeed:1500,
				items:4
			});

		});
	</script>
<?php endif ?>