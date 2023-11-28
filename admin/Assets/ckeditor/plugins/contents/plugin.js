CKEDITOR.plugins.add( 'contents', {
	requires: 'widget',
	icons: 'contents',
	init: function( editor ) {
		editor.addContentsCss( this.path + 'styles/styles.css' );
		CKEDITOR.dialog.add( 'contents', this.path + 'dialogs/contents.js' );
		editor.widgets.add( 'contents', {
			button: 'Insert Table of Contents',
			template:
			'<div class="widget-toc"></div>',
			allowedContent:
			'div(!widget-toc,float-left,float-right,align-center);' +
			'p(!toc-title);',
			dialog: 'contents',
			upcast: function( element ) {
				return element.name == 'div'
				&& element.hasClass( 'widget-toc' );
			},
			init: function() {
				editor.on('saveSnapshot', function(evt) {
					buildToc(this.element)
				}.bind(this));
				this.on('focus', function(evt) {
					buildToc(this.element)
				}.bind(this));
				buildToc(this.element);
				console.log(this.element.hasClass( 'float-right' ) );
				if ( this.element.hasClass( 'float-left' ) )
					this.setData( 'align', 'float-left' );
				if ( this.element.hasClass( 'float-right' ) )
					this.setData( 'align', 'float-right' );
				if ( this.element.hasClass( 'toc_root' ) )
					this.setData( 'chkInsertOpt', true);
			},
			data: function() {
				this.element.removeClass( 'float-left' );
				this.element.removeClass( 'float-right' );
				this.element.removeClass( 'toc_root' );
				if ( this.data.align )
					this.element.addClass(this.data.align );
				if ( this.data.chkInsertOpt )
					this.element.addClass('toc_root');
			},
		} );
		function encodeUrl(str){
			str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
			str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
			str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
			str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
			str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
			str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
			str = str.replace(/đ/g, "d");
			str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
			str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
			str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
			str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
			str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
			str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
			str = str.replace(/\(|\)|"|'|\|/g, "");
			str = str.replace(/Đ/g, "D");
			str = str.replace(/-|\+/g, "_");
			str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, "");
			str = str.replace(/\u02C6|\u0306|\u031B/g, "");
			str = str.replace(/:/g, "");
			str = str.replace(/,/g, "");
			str = str.replace(/__/g, "_");
			str = str.toLowerCase();
			str = str.match(/[a-zA-Z_]+/g);
			return str;
		}

		function ChangeToSlug(slug)
		{
			slug = slug.toLowerCase();
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, "");
        slug = slug.replace(/\u02C6|\u0306|\u031B/g, "");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        return slug;
    }

    function decodeHTMLEntities (str) {
    if(str && typeof str === 'string') {
      // strip script/html tags
      str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
      str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
     
    }

    return str;
  }

    function buildToc(element){
    //set everything up
    element.setHtml('<p class="toc-title">Nội dung</p>');
    Container = new CKEDITOR.dom.element( 'ol' );
    Container.appendTo(element);
    if (element.hasClass( 'toc_root' )){
    	findRoot = '> h1,> h2,> h3,> h4,> h5,> h6,';
    }else{
    	findRoot = 'h1,h2,h3,h4,h5,h6,';
    }
    var headings = editor.editable().find(findRoot),
    parentLevel = 1,
    length = headings.count();
    //get each heading
    for (var i = 0 ; i < length ; ++i) {
    	var currentHeading = headings.getItem( i ),
    	text = currentHeading.getText( ),
    	newLevel = parseInt(currentHeading.getName().substr(1,1));
    	var diff = (newLevel - parentLevel);
        //set the start level incase it is not h1
        if(i === 0){diff = 0; parentLevel = newLevel;}
        //we need a new ul if the new level has a higher number than its parents number
        if (diff > 0) {
        	var containerLiNode = Container.getLast();
        	var ulNode = new CKEDITOR.dom.element( 'ol' );
        	ulNode.appendTo(containerLiNode);
        	Container = ulNode;
        	parentLevel = newLevel;
        }
        //we need to get a previous ul if the new level has a lower number than its parents number
        if (diff < 0) {
        	while (0 !== diff++) {
        		parent = Container.getParent().getParent();
        		Container = (parent.getName() === 'ol' ? parent : Container);
        	}
        	parentLevel = newLevel;
        }
        //we can add the list item if there is no difference
        //if(text === ''){text = 'empty'}
        if (text == null || text.trim() === ''){
        	//text = '&nbsp;'
        }
        var id = text.replace(/ /g, "+");

		text = text.replace(/&nbsp;/gi,'-')
        text = decodeHTMLEntities(text);
        text = text.replace(/\u00A0/g, '-')
        text = $('<textarea />').html(text).text();

        currentHeading.setAttribute( 'id', ChangeToSlug(text) );
        var liNode = CKEDITOR.dom.element.createFromHtml( '<li><a href="#'+ChangeToSlug(text)+'">'+text+'</a></li>' );
        liNode.appendTo(Container);
    }
}
}
} );
