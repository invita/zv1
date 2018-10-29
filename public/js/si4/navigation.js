si4.si4Navigation = function(args)
{
    // Init
    var _p = this;

    this.currentPage = {
        pageName: "",
        pageArgs: {}
    };

    this.historyStack = [];

    // Settings
    this.contentElement = si4.getArg(args, "contentElement", null);

    // Implementation
    this.switchPage = function(pageName, pageArgs) {
        if (_p.currentPage.pageName) {
            _p.historyStack.push(_p.currentPage);
        }

        if (!pageArgs) pageArgs = {};
        _p._switchPage({
            pageName: pageName,
            pageArgs: pageArgs
        });
    };

    this.back = function() {
        if (_p.historyStack.length) {
            _p._switchPage(_p.historyStack.pop());
        }
    };

    this._switchPage = function(page) {
        //console.log("navigate", page);
        _p.currentPage = page;
        _p.renderPage();
    };

    this.renderPage = function() {
        $(_p.contentElement).empty();

        if (typeof(si4.modules[_p.currentPage.pageName]) == "function") {
            var pageArgs = Object.assign({}, _p.currentPage.pageArgs);
            pageArgs.parent = _p.contentElement;
            var page = new si4.modules[_p.currentPage.pageName](pageArgs);
        }
    };




    /*
     var hash = pageName;
     if (pageArgs && Object.keys(pageArgs).length) {
     var pageArgsCmps = [];
     for (var i in pageArgs) {
     pageArgsCmps.push(i+"="+pageArgs[i]);
     }
     hash += "?"+pageArgsCmps.join("&");
     }

     if (hash != location.hash) {
     location.hash = hash;
     _p.renderPage();
     }
     */


    /*
    window.onhashchange = function(e){
        var oldHash = e.oldURL.indexOf("#") != -1 ? e.oldURL.split("#")[1] : "";
        var newHash = e.newURL.indexOf("#") != -1 ? e.newURL.split("#")[1] : "";
        console.log(e);
        console.log(oldHash, newHash);
    };
    */

    return this;
}
