var downloadable = {};

downloadable.baseURL = $('body').data('base');

downloadable.goToList = function(e) {
	e && e.preventDefault && typeof e.preventDefault == 'function' && e.preventDefault();
	downloadable.files.hideAll();
	downloadable.fileList.show();
	if(e) {
		window.history.pushState({}, '', './');
	}
};

downloadable.fileList = {
	elm: $('#files'),
	
	show: function() {
		this.elm.removeClass('hide');
	},
	
	hide: function() {
		this.elm.addClass('hide');
	}
};

downloadable.files = [];
downloadable.files.hideAll = function() {
	$('.info').addClass('hidden');
};

downloadable.file = function(src, scope){
	this.url = src.href;
	this.elm = src;
	this.scope = scope || $('body');
	$(src).bind('click', $.proxy(this.process, this));
	return this;
};

downloadable.file.prototype = {
	elm: null,
	scope: null,
	info: null,
	url: "",
	
	load: function() {
		$.ajax({
			dataType: 'html',
			type: 'get',
			url: this.url,
			success: $.proxy(function(html) {
				this.setupInfo(html).inject();
				setTimeout($.proxy(function() {
					this.show();
				}, this), 50);
			}, this),
			error: function() {
				console.log('there was an error retrieving the content');
			}
		});
	},
	
	setupInfo: function(html) {
		this.info = $(html);
		return this;
	},
	
	inject: function() {
		this.info.addClass('hidden').appendTo(this.scope);
		return this;
	},
	
	show: function() {
		downloadable.fileList.hide();
		this.info.removeClass('hidden');
		return this;
	},
	
	hide: function() {
		downloadable.fileList.show();
		if(this.info) {
			this.info.addClass('hidden');
		}
		return this;
	},
	
	process: function(e) {
		e && e.preventDefault && typeof e.preventDefault == 'function' && e.preventDefault();
		if(e) {
			window.history.pushState({}, '', this.url);
		}
		if(this.info != null) {
			this.show();
		} else {
			this.load();
		}
	}
	
};

(function() {
	
	var popped = false,
		file = $('body').data('file');

	$('#files a').each(function() {
		var file = new downloadable.file(this);
		$(this).data('instance', file);
		downloadable.files.push(file);
	});
	
	$('.back').live('click', downloadable.goToList);
	
	window.onpopstate = function() {
		if(popped) {
			if(window.location.pathname == downloadable.baseURL) {
				downloadable.goToList();
			} else {
				$('a').filter(function() {
					return $(this).attr('href') == window.location.pathname.split('/').slice(-1);
				}).data('instance').process();
			}
		} else {
			popped = true;
		}
	};
	
})();

