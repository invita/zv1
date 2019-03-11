@extends("layout")

@section("content")

<main>

    <div id="langSelect">
        <a href="/?lang=sl">Slovensko</a>
        <a href="/?lang=en">English</a>
    </div>

    <div id="searchbar" class="mb15">
        <div class="row">

            <div class="large-2 medium-2 small-12 columns">
                <a href="/" title="Žrtve 1. svetovne vojne" style="border:0;">
                    <img id="logoImg" alt="Zgodovina Slovenije - SIstory" src="/img/logo-{{$lang}}.png">
                </a>
            </div>

            <div class="search large-10 medium-10 small-12 columns" style="height: 7em;">
                <div class="searchTitle">
                    <!-- Desktop tabs -->
                    <div class="show-for-large-up">
                        <div class="row collapse searchInputTabs">
                            <a class="tab translateHtml" data-translateHtml="mainTabs_pub" href="http://www.sistory.si/"></a>
                            <a class="tab active translateHtml" data-translateHtml="mainTabs_zrt1"></a>
                            <!--
                            <a class="tab translateHtml" data-translateHtml="mainTabs_zrt2" href="http://zv2.sistory.si/?lang={{$lang}}"></a>
                            -->
                            <a class="tab translateHtml" data-translateHtml="mainTabs_zrt2" href="http://www.sistory.si/zrtve"></a>
                            <a class="tab translateHtml" data-translateHtml="mainTabs_pop" href="http://www.sistory.si/popis"></a>
                            <a class="tab translateHtml" data-translateHtml="mainTabs_zic" href="http://www.sistory.si/zic"></a>
                        </div>
                    </div>

                    <!-- Mobile dropdown -->
                    <div class="show-for-medium-down">
                        <div class="row collapse searchInputTabsMobile">
                            <a class="dropdownArrow translateHtml" href="#" data-dropdown="drop1" data-translateHtml="mainTabs_zrt1"></a>
                            <ul id="drop1" class="f-dropdown" data-dropdown-content>
                                <li><a class="translateHtml" data-translateHtml="mainTabs_pub" href="http://www.sistory.si/"></a></li>
                                <li><a class="active translateHtml" data-translateHtml="mainTabs_zrt1"></a></li>
                                <!--
                                <li><a class="translateHtml" data-translateHtml="mainTabs_zrt2" href="http://zv2.sistory.si/?lang={{$lang}}"></a></li>
                                -->
                                <li><a class="translateHtml" data-translateHtml="mainTabs_zrt2" href="http://www.sistory.si/zrtve"></a></li>
                                <li><a class="translateHtml" data-translateHtml="mainTabs_pop" href="http://www.sistory.si/popis"></a></li>
                                <li><a class="translateHtml" data-translateHtml="mainTabs_zic" href="http://www.sistory.si/zic"></a></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="content katSearch active" id="pnlZrtve">
                    <form id="searchFormZrtve">
                        <div class="row collapse searchInputRow">
                            <div class="large-11 medium-11 small-10 columns">
                                <input id="searchInput" name="search" value="{{$search}}" type="text"
                                  class="translatePlaceholder" data-translatePlaceholder="text_searchString">
                            </div>
                            <div class="large-1 medium-1 small-2 columns">
                                <a onclick="$('#searchFormZrtve').submit()" id="searchButtonZrtve" class="postfix button button_small">
                                    <div class="searchicon"></div>
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="row collapse searchInputRow" style="margin-top: 5px;">
                        <div class="large-11 medium-11 small-10 columns">&nbsp;</div>
                        <div class="large-1 medium-1 small-2 columns" style="z-index:10;">
                            <a class="translateHtml" data-translateHtml="text_vseZrtve"
                                onclick="$('#searchInput').val('*'); $('#searchFormZrtve').submit();"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="pageHolder" class="large-12 medium-12 small-12 columns">
            <div id="initView">

                <div class="search large-12 medium-12 small-12 columns">
                    <div class="searchTitle"></div>
                    <div class="content katSearch active" id="pnlZrtve">
                        <form id="chartFormZrtve">
                            <div class="large-12 medium-12 small-12">

                                <div class="chartField large-12 medium-12 small-12 columns">
                                    <label class="translateHtml" data-translateHtml="chart_field_chartType"></label>
                                    <select name="type">
                                        @foreach($types as $type)
                                        <option value="{{$type["key"]}}"{{ $type["key"] == $qType ? " selected" : ""}}>{{$type["value"]}}</option>
                                        @endforeach;
                                    </select>
                                </div>

                                <div class="chartField large-6 medium-6 small-12 columns">
                                    <label class="translateHtml" data-translateHtml="chart_field_from"></label>
                                    <select name="from">
                                        <option value=""></option>
                                        @foreach($froms as $from)
                                            <option value="{{$from["key"]}}"{{ $from["key"] == $qFrom ? " selected" : ""}}>{{$from["value"]}}</option>
                                        @endforeach;
                                    </select>
                                </div>

                                <div class="chartField large-6 medium-6 small-12 columns">
                                    <label class="translateHtml" data-translateHtml="chart_field_to"></label>
                                    <select name="to">
                                        <option value=""></option>
                                        @foreach($tos as $to)
                                            <option value="{{$to["key"]}}"{{ $to["key"] == $qTo ? " selected" : ""}}>{{$to["value"]}}</option>
                                        @endforeach;
                                    </select>
                                </div>

                                <div class="chartField large-6 medium-6 small-12 columns">
                                    <label class="translateHtml" data-translateHtml="chart_field_land"></label>
                                    <select name="land">
                                        <option value=""></option>
                                        @foreach($lands as $land)
                                            <option value="{{$land}}"{{ $land == $qLand ? " selected" : ""}}>{{$land}}</option>
                                        @endforeach;
                                    </select>
                                </div>

                                <div class="chartField large-6 medium-6 small-12 columns">
                                    <label class="translateHtml" data-translateHtml="chart_field_munic"></label>
                                    <select name="munic">
                                        <option value=""></option>
                                        @foreach($munics as $munic)
                                            <option value="{{$munic}}"{{ $munic == $qMunic ? " selected" : ""}}>{{$munic}}</option>
                                        @endforeach;
                                    </select>
                                </div>

                                <!--
                                <div class="large-11 medium-11 small-10 columns">
                                    <input id="searchInput" name="search" value="" type="text"
                                      class="translatePlaceholder" data-translatePlaceholder="text_searchString">
                                </div>
                                <div class="large-1 medium-1 small-2 columns">
                                    <a onclick="$('#searchFormZrtve').submit()" id="searchButtonZrtve" class="postfix button button_small">
                                        <div class="searchicon"></div>
                                    </a>
                                </div>
                                -->
                            </div>

                            <div class="chartField large-6 medium-6 small-12 columns">
                                <input type="submit" class="button large-6 medium-6 small-6 translateValue"
                                    data-translateValue="chart_button_refresh" value="" />
                                <div></div>
                            </div>
                        </form>
                        <!--
                        <div class="row collapse searchInputRow" style="margin-top: 5px;">
                            <div class="large-11 medium-11 small-10 columns">&nbsp;</div>
                            <div class="large-1 medium-1 small-2 columns">
                                <a class="translateHtml" data-translateHtml="text_vseZrtve"
                                    onclick="$('#searchInput').val('*'); $('#searchFormZrtve').submit();"></a>
                            </div>
                        </div>
                        -->
                    </div>
                </div>


                <pre id="chartData" style="display:none;">
                    {{json_encode([ "chartData" => $chartData,"qType" => $qType ])}}
                </pre>
                <canvas id="chartCanvas" width="1000" height="300"></canvas>
            </div>
        </div>
    </div>


    <footer id="bottom">
        <div class="row">
            <div class="large-3 medium-3 columns hide-for-small">
                <a href="/" title="SIstory Zgodovina Slovenije" style="border:0;">
                    <img id="logoImg1" alt="SIstory Zgodovina Slovenije" src="/img/logo-bw.png" style="border:0px; width: auto;">
                </a>
            </div>
            <div class="large-5 medium-5 small-12 columns" style="float:left">
                <div class="row">
                    <?php echo $footerHtml; ?>
                </div>
                <hr class="show-for-small-only">
            </div>
        </div>


    <div id="bottomfoot">
        <div class="row">
            <hr/>
            <div class="large-9 medium-9 small-12 columns">
                <p>
                    <span>© Copyright 2011-<?php echo date('Y'); ?> INZ, </span>
                    <span class="translateHtml" data-translateHtml="text_sistory"></span>
                </p>
            </div>
            <div class="large-3 medium-3 small-12 columns"></div>
        </div>

    </div>

    </footer>

</main>

@endsection
