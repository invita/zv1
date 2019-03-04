var foo = {};
$(document).ready(function() {


    si4.api.dictionary({ lang: lang }, function(data) {
        var dict = JSON.parse(data);
        si4.translations = dict;
        //console.log("dict", dict);

        si4.data.contentElement = $('div#pageHolder');

        $('.translatePlaceholder').each(function(idx, el) {
            $(el).attr("placeholder", si4.translate($(el).attr("data-translatePlaceholder")));
            $(el).removeAttr("data-translatePlaceholder");
            $(el).removeClass("translatePlaceholder");
        });
        $('.translateHtml').each(function(idx, el) {
            $(el).html(si4.translate($(el).attr("data-translateHtml")));
            $(el).removeAttr("data-translateHtml");
            $(el).removeClass("translateHtml");
        });
        $('.translateValue').each(function(idx, el) {
            $(el).attr("value", si4.translate($(el).attr("data-translateValue")));
            $(el).removeAttr("data-translateValue");
            $(el).removeClass("translateValue");
        });

        si4.data.initView = $('#initView');
        si4.data.initView.detach();

        si4.navigation = new si4.si4Navigation({
            contentElement: si4.data.contentElement
        });

        si4.navigation.switchPage("index");

        $("#searchFormZrtve").submit(function(e) {
            e.preventDefault();
            var searchVal = $("#searchInput").val();
            if (searchVal) {
                si4.navigation.switchPage("search", { search: searchVal });
            }
        });

    });
});
