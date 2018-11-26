<!DOCTYPE html>
<html lang="sl" xml:lang="sl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <link rel="icon" type="image/png" href="/img/icon.png">
    <title>Žrtve 1. svetovne vojne</title>

    <script src="/lib/jquery/jquery-2.1.1.js"></script>

    <script src="/js/si4/si4.js"></script>
    <script src="/js/si4/config.js"></script>
    <script src="/js/si4/util.js"></script>
    <script src="/js/si4/codes.js"></script>
    <script src="/js/si4/api.js"></script>
    <script src="/js/si4/navigation.js"></script>
    <script src="/js/si4/translate/translate.js"></script>
    <script src="/js/si4/object/si4EventBase.js"></script>
    <script src="/js/si4/object/si4FileUploader.js"></script>
    <script src="/js/si4/widget/si4Element.js"></script>
    <script src="/js/si4/widget/si4TabPage.js"></script>
    <script src="/js/si4/widget/si4DataTable.js"></script>
    <script src="/js/si4/widget/si4Panel.js"></script>
    <script src="/js/si4/widget/si4Form.js"></script>
    <script src="/js/si4/widget/si4Input.js"></script>
    <script src="/js/si4/widget/si4InputArray.js"></script>
    <script src="/js/si4/widget/si4MultiSelect.js"></script>
    <script src="/js/si4/widget/si4Dialog.js"></script>
    <script src="/js/si4/widget/si4HtmlTable.js"></script>
    <script src="/js/si4/widget/si4Hint.js"></script>
    <script src="/js/si4/widget/si4AutoComplete.js"></script>
    <script src="/js/si4/modules/index.js"></script>
    <script src="/js/si4/modules/search.js"></script>
    <script src="/js/si4/modules/zrtev.js"></script>
    <script src="/js/si4/init.js"></script>

    <script>
        var lang = '<?php echo $lang; ?>';
    </script>

    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(["setDomains", ["*.zv1.sistory.si"]]);
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//sistory.si/piwik/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 4]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <noscript><p><img src="//sistory.si/piwik/piwik.php?idsite=4" style="border:0;" alt="" /></p></noscript>
    <!-- End Piwik Code -->


    <link rel="stylesheet" href="/lib/zurb/css/normalize.css" />
    <link rel="stylesheet" href="/lib/zurb/css/foundation.css" />

    <link rel="stylesheet" href="/css/gradients.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/standard.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/si4.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/zrtve1.css" />
</head>

<body>

@yield("content")

</body>
</html>