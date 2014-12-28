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

PUKISAPP.BEHAVIOR.PUKIS.ajax = function() {
	var type = null;
	var data = null;
	var ajaxType = function(type) {
		type = type || 'get';
		this.type = type;
		return this;
	}
	var ajaxData = function(data) {
		this.data = data;
		return this;
	}
	var ajaxRequest = function(obj, url, element) {
		redirect = PUKISAPP.BEHAVIOR.PUKIS.dispacher().redirect(url, element);
		if (typeof redirect.url != 'undefined' && redirect.url != null) {			
			data = null;
			if (this.type == 'post' && this.data == null) {
				this.data = $(obj).serialize();
			}
			$.ajax({
					url: redirect.url,
					type: this.type,
					data: this.data,
					success: function(data){
						response = PUKISAPP.BEHAVIOR.PUKIS.util().checkJson(data);
				    	if (typeof response.url != 'undefined') {
				    		ajaxType('get');
				    		ajaxRequest(obj, response.url, redirect.element);				
						} else {
							$(redirect.element).html(data);
						}
					},
					error: function(error){
						if(error.status != '403') {
				    		modal = PUKISAPP.BEHAVIOR.PUKIS.view().showErrorModal(error.status, error.statusText, redirect.url);
				    	} else {
				    		ajaxType('get');
				    		ajaxRequest(obj, '/admin/users/users/login', '#wrapper');		
				    	}
					},
					beforeSend: function(){
						$('#loader').show();
					},
					complete: function(){
						$('#loader').hide();
					}
				});
		}
		return false;
	}
	return {
		ajaxType: ajaxType,
		ajaxData: ajaxData,
		ajaxRequest: ajaxRequest
	}
}

PUKISAPP.BEHAVIOR.PUKIS.util = function() {
	var checkJson = function(jsonString) {
		try {
	        var jsonObject = JSON.parse(jsonString);
	         if (jsonObject && typeof jsonObject === "object" && jsonObject !== null) {
	        	return jsonObject;
	        }
	    }
	    catch(e) {
	    	return false;
	    }
	    return false;
	}
	return {
		checkJson: checkJson
	}
};

PUKISAPP.BEHAVIOR.PUKIS.view = function() {
	var modal = '#modal';
	var showErrorModal = function(errorStatus, errorStatusText, errorUrl) {
		message = '<h3>Error ' + errorStatus + ' <small>' + errorStatusText + '</small></h3>\n' + errorUrl;
		$('#modal').easyModal({top: '200'});
		$('#modal').html(message);
		$('#modal').trigger('openModal');
	}	
	return {
		showErrorModal: showErrorModal
	}
}

PUKISAPP.BEHAVIOR.PUKIS.dispacher = function() {
	var defaultUrl = null;
	var defaultElement = '#wrapper';
	var redirect = function(url, element) {
		url = url || defaultUrl;
		element = element || defaultElement;
		if(url === null){
			return {url: defaultUrl, element: element};
		}
		if(url.indexOf("#") > -1){
			return {url: defaultUrl, element: element};
		}
		if(url.indexOf("login") > -1) {
			return {url: url, element: defaultElement}
		}
		if(url.indexOf("logout") > -1) {
			return {url: url, element: defaultElement}
		}
		return {url: url, element : element}
	}
	return {
		redirect : redirect
	}
}

var pukisRequest = new PUKISAPP.BEHAVIOR.PUKIS.ajax();