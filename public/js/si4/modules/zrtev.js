si4.modules.zrtev = function(args) {

    //console.log("zrtev", args);

    var container = new si4.widget.si4Element({ parent: args.parent, tagClass: "defContainer moduleZrtev" });

    var cDiv1 = new si4.widget.si4Element({ parent: container.selector, tagClass: "zrtevCDiv" });
    var backButton = new si4.widget.si4Element({ parent: cDiv1.selector, tagName: "a", tagClass: "noHover" });
    //backButton.addHtml(si4.translate("text_back"));
    backButton.addHtml('<img src="/img/icon/dataTable_prev.png" class="imgBack" />');
    backButton.selector.click(function() {
        si4.navigation.back();
    });
    var pdfButton = new si4.widget.si4Element({ parent: cDiv1.selector, tagName: "a", tagClass: "zrtevPdfButton noHover" });
    //pdfButton.addHtml(si4.translate("text_downloadPdf"));
    pdfButton.addHtml('<img src="/img/icon/pdf.png" class="imgPdf" />');
    pdfButton.selector.click(function() {
        var url = "/file/zrtevPdf?id="+args.row.ID;
        window.open(url, "_blank");
    });

    var dataDiv = new si4.widget.si4Element({ parent: container.selector, tagClass: "zrtevDetails" });

    var fields = [
        "ID", "PRIIMEK", "PRIIMEK2", "IME", "STARSI",
        "ROJSTVO", "KRAJ_ROJSTVA", "ZUPNIJA", "BIVALISCE", "OBCINA", "DEZELA", "DOMOVINSKA", "STAN",
        "VPOKLIC", "SMRT", "KRAJ_SMRTI", "VZROK", "POKOP",
        "CIN", "ENOTA", "OSTALO",
        "VIRI", "OPOMBE", "IZVOR",
    ];

    for (var i in fields) {
        var fieldName = fields[i];
        if (args.row[fieldName]) {
            var fieldDiv = new si4.widget.si4Element({ parent: dataDiv.selector, tagClass: "attrRow row collapse" });

            var nameSpan = new si4.widget.si4Element({ parent: fieldDiv.selector, tagName: "span", tagClass: "attrName large-2 medium-2 small-12 columns" });
            nameSpan.addHtml(si4.translate("field_"+fieldName) +":");

            var valueSpan = new si4.widget.si4Element({ parent: fieldDiv.selector, tagName: "span", tagClass: "attrValue large-10 medium-10 small-12 columns" });
            valueSpan.addHtml(args.row[fieldName]);
        }
    }

    var backButton2 = new si4.widget.si4Element({ parent: container.selector, tagName: "a", tagClass: "noHover" });
    backButton2.addHtml('<img src="/img/icon/dataTable_prev.png" class="imgBack" />');
    //backButton2.addHtml(si4.translate("text_back"));
    backButton2.selector.click(function() {
        si4.navigation.back();
    });

    var pdfButton2 = new si4.widget.si4Element({ parent: container.selector, tagName: "a", tagClass: "zrtevPdfButton noHover" });
    pdfButton2.addHtml('<img src="/img/icon/pdf.png" class="imgPdf" />');
    //pdfButton2.addHtml(si4.translate("text_downloadPdf"));
    pdfButton2.selector.click(function() {
        var url = "/file/zrtevPdf?id="+args.row.ID;
        window.open(url, "_blank");
    });


};
