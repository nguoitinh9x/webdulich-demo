<?php
namespace Library;
/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
class script extends functions{
	private $db;
	private $lang;
	
    public function __construct($db,$lang)
    {
        $this->db = $db;
        $this->lang = $lang;
    }

	public function cut_copy_paste()	
	{	
		$result = "
		<script>
			$(document).ready(function(){
				$('*').bind('cut copy paste contextmenu', function (e) {
				e.preventDefault();
				})
			});
		</script>
		";
		return $result;
	}

	public function skillcopy()	
	{	
		$result = '
			<script>
			function killCopy(e){
			return false
			}
			function reEnable(){
			return true
			}
			document.onselectstart=new Function ("return false")
			if (window.sidebar){
			document.onmousedown=killCopy
			document.onclick=reEnable
			}
			</script>
		';
		return $result;
	}

	public function rightclick()	
	{	
		$result = '
			<script>
			var message="NoRightClicking";
			function defeatIE() {if (document.all) {(alert("© 2018 Master All Right Reserved"));return false;}}
			function defeatNS(e) {if (document.layers||(document.getElementById&&!document.all))
			{ if (e.which==2||e.which==3||e.keyCode==123) {
				(alert("© 2018 Master All Right Reserved"));return false;}}} if (document.layers)
				{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=defeatNS;}
				else{document.onmouseup=defeatNS;document.oncontextmenu=defeatIE;} document.oncontextmenu=new Function("return false")
			</script>
			<script>
			function showKeyCode(e) {
				if(e.keyCode==123){
					alert("© 2018 Master All Right Reserved");
						return false;
				}
			}
			</script>';
		return $result;
	}

	public function backTop(){
		$html .= '<a href="#" id="backtop"></a>';
		$html .= '<script>
		$(document).ready(function() {
		$(window).scroll(function() {
			$top = $(window).scrollTop();
			if($top > 100) {
				$("#backtop").addClass("show");
			} else {
				$("#backtop").removeClass("show");
			}
	   	});
		$("#backtop").click(function() {
			$("html,body").animate({scrollTop:0},500);
				return false;
		   	});
		});
		</script>';
		return $html;
	}

	public function backTop2(){
		$html = '';
		$html .= '<a href="#" id="backtop2"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="40px" height="60px" viewBox="0 0 40 60" enable-background="new 0 0 40 60" xml:space="preserve"> <g> <path  d="M29.699,42.238c-5.222,5.928-14.166,5.934-19.124,0.271c-3.258,4.533-6.02,4.27-9.018-0.858 c-2.533-4.333-1.891-9.321,1.297-13.584c1.259-1.683,2.254-3.891,2.59-6C6.809,13.5,10.615,6.641,17.056,1.315 c2.1-1.737,3.789-1.765,5.898-0.016C29.241,6.512,33.038,13.18,34.509,21.54c0.426,2.423,1.558,4.91,2.962,6.89 c3.329,4.692,3.455,10.555-0.118,14.825C34.004,47.257,32.225,47.098,29.699,42.238z M19.839,25.821 c3.526,0.116,6.512-3.1,6.551-7.056c0.039-4.031-2.745-7.091-6.452-7.091c-3.447,0-6.187,2.925-6.3,6.727 C13.518,22.415,16.266,25.703,19.839,25.821z"/> </g> <g> <path d="M21.192,58.732c0,0.7-0.534,1.268-1.191,1.268l0,0c-0.66,0-1.192-0.567-1.192-1.268v-9.552 c0-0.699,0.533-1.269,1.192-1.269l0,0c0.657,0,1.191,0.569,1.191,1.269V58.732z"/> <path d="M24.993,52.705c0,0.691-0.528,1.251-1.178,1.251l0,0c-0.649,0-1.176-0.56-1.176-1.251v-3.541 c0-0.693,0.527-1.252,1.176-1.252l0,0c0.65,0,1.178,0.559,1.178,1.252V52.705z"/> <path d="M17.364,52.705c0,0.691-0.528,1.251-1.177,1.251l0,0c-0.649,0-1.176-0.56-1.176-1.251v-3.541 c0-0.693,0.528-1.252,1.176-1.252l0,0c0.65,0,1.177,0.559,1.177,1.252V52.705z"/> </g> </svg></a>'; $html .= '<script>
		$(document).ready(function() {
		$(window).scroll(function() {
			$top = $(window).scrollTop();
			if($top > 100) {
				$("#backtop2").addClass("show");
			} else {
				$("#backtop2").removeClass("show");
			}
	   	});
		$("#backtop2").click(function() {
			$("html,body").animate({scrollTop:0},500);
				return false;
		   	});
		});
		</script>';
		return $html;
	}	

	public function nano()	
	{	
		$result = '
		<script>
			jQuery("#nanogallery2").nanogallery2({
			thumbnailWidth: "280",
			thumbnailHeight: "225",
			galleryMosaic: [{
			w: 2,h: 1,c: 1,r: 1
			}, {
			w: 1,h: 1,c: 3,r: 1
			}, {
			w: 1,h: 2,c: 4,r: 1
			}, {
			w: 1,h: 1,c: 1,r: 2
			}, {
			w: 1,h: 1,c: 2,r: 2
			}, {
			w: 1,h: 1,c: 3,r: 2
			}],
			thumbnailAlignment: "scaled",
			thumbnailBaseGridHeight: 80,
			thumbnailDisplayTransition: "slideLeft",
			thumbnailDisplayTransitionDuration: 1440,
			thumbnailDisplayInterval: 90,
			galleryMaxRows: 1,
			galleryDisplayMode: "rows",
			thumbnailL1GutterWidth: 0,
			thumbnailL1GutterHeight: 0,
			thumbnailBorderHorizontal: 0,
			thumbnailBorderVertical: 0,
			thumbnailLabel: {
			display: !1,
			position: "onBottomOverImage",
			hideIcons: !0,
			titleFontSize: "1em",
			align: "left",
			titleMultiLine: !0,
			displayDescription: !1
			},
			thumbnailBorderHorizontal: 12,
			thumbnailBorderVertical: 12
			}), $("#gallery-wrap").length && jQuery("#gallery-wrap").unitegallery({
			gallery_theme: "tiles"
			});
		</script>';
		return $result;
	}

}
?>