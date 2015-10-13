// typeahead
~function($, JSON, config, window) {
	if (window.localStorage) {
		if (window.localStorage.getItem('tools') 
			&& window.localStorage.getItem('tools_version')
			&& (window.localStorage.getItem('tools_version') >= config.tools_version)) {
			init_typeahead(JSON.parse(window.localStorage.getItem('tools')));
		} else {
			$.ajax({
				type: 'get',
				url: '/site/ajax/tools',
				async: true,
				success: function(result){
					init_typeahead(result);
					window.localStorage.setItem('tools_version', config.tools_version);
					window.localStorage.setItem('tools', JSON.stringify(result));
				}
			})
		}
	} else {
		$.get("/site/ajax/tools", init_typeahead);
	}
	function init_typeahead(tools){
		var $input = $('.typeahead');
		$input.typeahead({
			source: tools, 
			autoSelect: true,
			minLength: 1,
			matcher: function(item) {
				return item.description.toLowerCase().match(this.query.toLowerCase());
			}
		}); 
		$input.change(function() {
			var current = $input.typeahead("getActive");
			if (current) {
				// Some item from your model is active!
				if (current.name == $input.val()) {
					window.location.href=current.url
					// This means the exact match is found. Use toLowerCase() if you want case insensitive match.
				} else {
					// This means it is only a partial match, you can either add a new item 
					// or take the active if you don't want new items
				}
			} else {
				// Nothing is active so it is a new value (or maybe empty value)
			}
		});
	}
}(jQuery, JSON, site_config, window);