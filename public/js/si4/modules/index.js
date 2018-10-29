si4.modules.index = function(args) {

    //console.log("index", args)

    if (si4.data.initView) {
        si4.data.initView.appendTo(args.parent);
    }

    /*
    var container = new si4.widget.si4Element({ parent: args.parent, tagClass: "defContainer center" });

    var titleDiv = new si4.widget.si4Element({ parent: container.selector, tagClass: "titleDiv" });
    titleDiv.selector.html(si4.translate("text_indexTitle"));

    var textDiv = new si4.widget.si4Element({ parent: container.selector, tagClass: "textDiv" });
    textDiv.selector.html(si4.translate("text_indexText"));
    */
};