
 // is Undefined
function isU(o) {
  return (typeof o == 'undefined');
}

// is defined
function isD(o) { 
  return (typeof o != 'undefined');
}

function _log() {
	
	var m = arguments.length;
	
	for (var i = 0; i < m; i += 1) {
		if (typeof arguments[i] == 'object') {
			console.dir(arguments[i]);
		} else {
			console.log(arguments[i]);
		}
	}

};

function apiPath() {

	return 'https://test.sendsay.ru/admin/api/';

}

function apiRequest(a) {

	return {
	    	"method": "POST",
	    	"url": apiPath(),
	    	"data": {
	    		"request": a,
	    		"apiversion": 100,
	            "json": 1
	    	}
	    };
}