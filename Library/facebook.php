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
class facebook extends functions{
	private $db;
	private $lang;
	
    public function __construct($db,$lang)
    {
        $this->db = $db;
        $this->lang = $lang;
    }

	public function sdk()	
	{	
		$result = '
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0&appId=154422631851891&autoLogAppEvents=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, "script", "facebook-jssdk"));</script>
		';
		return $result;
	}

	public function comment()	
	{	
		$result = '<div data-width="100%" class="fb-comments" data-href="'.$this->getCurrentPageURL().'" data-numposts="5"></div>';
		return $result;
	}

	public function like()	
	{	
		$result = '<div class="fb-like" data-href="'.$this->getCurrentPageURL().'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>';
		return $result;
	}

	public function send()	
	{	
		$result = '<div class="fb-send" data-href="'.$this->getCurrentPageURL().'"  data-layout="button_count"></div>';
		return $result;
	}
	public function share()	
	{	
		$result = '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-570cc0718870e6c3"></script>
		<div class="addthis_native_toolbox"></div>';
		return $result;
	}
}?>