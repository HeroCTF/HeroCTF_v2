var page = require('webpage').create();
var system = require('system');
var host = "";
var cookieName = "";
var cookieVal = "";
var url = "";
var timeout = 3000;

page.settings.userAgent = "PhantomJs";



system.args.forEach(function(arg,i){
    if(i==1) host = arg;
    if(i==2) url = arg;
	if(i==3) cookieName = arg;
	if(i==4) { 
		cookieVal = arg;
		phantom.addCookie({
			'name': cookieName,
			'value': cookieVal,
			'path':'/',
			'domain': host
		});
	}
})

page.onNavigationRequested = function(url, type, willNavigate, main) {
    console.log("[PhantomJS - URL] URL="+url);  
};
page.settings.resourceTimeout = timeout;
page.onResourceTimeout = function(e) {
    setTimeout(function(){
        console.log("[PhantomJS - INFO] Timeout")
        phantom.exit();
    }, 1);
};

page.open(url, function(status) {
	console.log("[PhantomJS - INFO] rendered page status: "+status);
	console.log(page.content)
    setTimeout(function(){
        phantom.exit();
    }, 1000);
});
