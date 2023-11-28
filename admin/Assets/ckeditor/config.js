/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.extraPlugins = 'lineheight,wenzgmap,youtube,googledocs,tableresize,imagerotate,youtube,entities,bootstrapVisibility,slideshow,locationmap,pastefromword,lightbox,imagebrowser,imagepaste,quicktable,widget,widgetbootstrap,widgettemplatemenu,contextmenu,menu,fontawesome,templates,contents,a11ychecker,balloonpanel,html5video';
	config.codemirror_theme = 'rubyblue';  // Go here for theme names: http://codemirror.net/demo/theme.html
	config.locationMapPath = 'Assets/ckeditor/map/';
	config.ckfinder = true;
	config.codemirror = {
		lineNumbers: true,
		highlightActiveLine: true,
		enableSearchTools: true,
		showSearchButton: true,
		showFormatButton: true,
		showCommentButton: true,
		showUncommentButton: true,
		showAutoCompleteButton: true
	};
	config.extraAllowedContent = 'a[data-lightbox,data-title,data-lightbox-saved]';
	config.contentsCss = 'Assets/ckeditor/plugins/fontawesome/font-awesome/css/font-awesome.min.css';
	config.pasteFromWordPromptCleanup = false;
	config.pasteFromWordCleanupFile = false;
	config.pasteFromWordRemoveFontStyles = false;
	config.pasteFromWordNumberedHeadingToList = false;
	config.pasteFromWordRemoveStyles = false;
	// Comment out or remove the 2 lines below if you want to enable the Advanced Content Filter	
	config.allowedContent = true;
	config.extraAllowedContent = '*{*}';	
	//config.uiColor = '#ffffff';
	config.skin = 'office2013';
	config.line_height="1.0;1.1;1.2;1.3;1.4;1.5;1.5;1.6;1.7;1.8;1.9;2.0;3.0;4.0;5.0" ;
	config.toolbar = 'Full';
	config.entities = false;
};