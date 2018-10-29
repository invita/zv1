@extends("layout")

@section("content")

<main>

    <div id="searchbar">
        <div class="row collapse">

            <div class="large-3 medium-3 small-12 columns">
                <a href="/" title="Žrtve 1. svetovne vojne">
                    <img id="logoImg" alt="Zgodovina Slovenije - SIstory" src="/img/logo-sl.png">
                </a>
            </div>


            <div class="search large-9 medium-9 small-12 columns" style="height: 7em;">
                <div class="searchTitle">
                    Išči žrtve:
                </div>
                <div class="content katSearch active" id="pnlZrtve">
                    <form id="searchFormZrtve" action="/search/" method="GET">
                        <div class="row collapse">
                            <div class="large-10 medium-10 small-8 columns">
                                <input name="search" value="{{$search}}" type="text" placeholder="Iskalni niz...">
                            </div>
                            <div class="large-2 medium-2 small-4 columns">
                                <a href="#" id="searchButtonZrtve" class="postfix button expand split">
                                    <div class="searchicon"></div>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="zrtevSearchTable">
        <table class="tableResultsView" style="width: 100%">
            <thead>
                <tr>
                    <th>Ime in priimek</th>
                    <th>Datum rojstva</th>
                    <th>Datum smrti</th>
                    <th>Kraj bivanja</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($zrtve as $zrtev): ?>
                <tr class="sisgrid11" onclick="window.location.href='/zrtev/?search={{$search}}&id={{$zrtev["ID"]}}'">
                    <td style="width: 20%;">{{ $zrtev["IME"] }} {{ $zrtev["PRIIMEK"] }}</td>
                    <td style="width: 20%;">{{ $zrtev["ROJSTVO"] }}</td>
                    <td style="width: 20%;">{{ $zrtev["SMRT"] }}</td>
                    <td style="width: 20%;">{{ $zrtev["BIVALISCE"] }}</td>
                </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>

</main>

@endsection
