//-------------------------------------------------------------------------------------
//
// THIS FILE IS NOT A PART OF THE PLUGIN, IT'S ONLY FOR THE DEMO
//
//-------------------------------------------------------------------------------------
!(function(){
    'use strict';

		
		
    
		// finally, initialize photobox on all retrieved images
		$('#gallery').photobox('a', { thumbs:true, loop:false });
		// using setTimeout to make sure all images were in the DOM, before the history.load() function is looking them up to match the url hash
		
})();