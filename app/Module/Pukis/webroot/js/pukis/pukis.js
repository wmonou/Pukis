// create the root namespace and making sure we're not overwriting it
var PUKISAPP = PUKISAPP || {};
 
// create a general purpose namespace method
// this will allow us to create namespace a bit easier
// author http://www.kenneth-truyers.net/2013/04/27/javascript-namespaces-and-modules/
PUKISAPP.createNameSpace = function(namespace) {
    var nsparts = namespace.split(".");
    var parent = PUKISAPP;
 
    // we want to be able to include or exclude the root namespace
    // So we strip it if it's in the namespace
    if (nsparts[0] === "PUKISAPP") {
        nsparts = nsparts.slice(1);
    }

    // loop through the parts and create
    // a nested namespace if necessary
    for (var i = 0; i < nsparts.length; i++) {
        var partname = nsparts[i];
        // check if the current parent already has
        // the namespace declared, if not create it
        if (typeof parent[partname] === "undefined") {
            parent[partname] = {};
        }
        // get a reference to the deepest element
        // in the hierarchy so far
        parent = parent[partname];
    }

    // the parent is now completely constructed
    // with empty namespaces and can be used.
    return parent;
};

PUKISAPP.createNameSpace("PUKISAPP.BEHAVIOR.PUKIS");

PUKISAPP.BEHAVIOR.PUKIS.ajaxRequest = function() {
	var obj = obj;
	var ajaxUrl = function(reloadUrl) {
		if (typeof reloadUrl != 'undefined') {
			return reloadUrl; 
			}
		return "#";
	}
	var ajaxElement = function(reloadElement) {
		if (typeof reloadElement != 'undefined') {
			return reloadElement; 
			}
		return "#content";
	}
	var ajaxRedirect = function(url, element) {
		$.get(url, function(data){
			$(ajaxElement(element)).html(data);
			});
		return false;
	}
	var ajaxLinkRequest = function(obj, url, element) {
		$('#loader').show();
		$.get(ajaxUrl(url), function(data) {
			response = PUKISAPP.BEHAVIOR.PUKIS.checkJson(data);
			if (typeof response.url != 'undefined') {
				ajaxRedirect(response.url, ajaxElement(element));				
			} else {
				$(ajaxElement(element)).html(data);
			}
		}).fail(function(error) {
			// currently only handling 404
			// @todo handle other message
			message = '<h3>Error ' + error.status + '</h3>\n' + ajaxUrl(url) + ' ' + error.statusText;
			modal = PUKISAPP.BEHAVIOR.PUKIS.modal(message).show();
		}).always(function() {
			$('#loader').hide();
		});	
	}
	var ajaxFormRequest = function(obj, url, element) {
		$('#loader').show();
		var form = $(obj).serialize();
		$.post(ajaxUrl(url), form, function(data){
			response = PUKISAPP.BEHAVIOR.PUKIS.checkJson(data);
			if(typeof response.url != 'undefined'){
				ajaxRedirect(response.url, ajaxElement(element));				
			}else{
				$(ajaxElement(element)).html(data);
			}
		}).fail(function(error) {
			// currently only handling 404
			// @todo handle other message
			message = '<h3>Error ' + error.status + '</h3>\n' + ajaxUrl(url) + ' ' + error.statusText;
			modal = PUKISAPP.BEHAVIOR.PUKIS.modal(message).show();
		}).always(function() {
			$('#loader').hide();
		});
	}
	return {
		ajaxRedirect: ajaxRedirect,
		ajaxLinkRequest: ajaxLinkRequest,
		ajaxFormRequest: ajaxFormRequest
	}
}

PUKISAPP.BEHAVIOR.PUKIS.modal = function(message) {
	var modal = '#modal';
	var message = message;
	var setModal = function() {
		$(modal).easyModal({top: 200});
	}
	var setMessage = function() {
		$(modal).html(message);
	}
	var show = function(message) {
		setModal();
		setMessage();
		$(modal).trigger('openModal');
	}
	return {
		show: show
	}
}

PUKISAPP.BEHAVIOR.PUKIS.checkJson = function(jsonString) {
	try {
        var jsonObject = JSON.parse(jsonString);
        // Handle non-exception-throwing cases:
        // Neither JSON.parse(false) or JSON.parse(1234) throw errors, hence the type-checking,
        // but... JSON.parse(null) returns 'null', and typeof null === "object",
        // so we must check for that, too.
        if (jsonObject && typeof jsonObject === "object" && jsonObject !== null) {
        	return jsonObject;
        }
    }
    catch(e) {
    	return false;
    }
    return false;
};