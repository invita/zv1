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


    <div class="zrtevDetails">

        <div>
            <span class="attrName">Id: </span>
            <span class="attrValue">{{ $zrtev["ID"] }}</span>
        </div>
        <div>
            <span class="attrName">Priimek: </span>
            <span class="attrValue">{{ $zrtev["PRIIMEK"] }}</span>
        </div>
        <div>
            <span class="attrName">Priimek2: </span>
            <span class="attrValue">{{ $zrtev["PRIIMEK2"] }}</span>
        </div>
        <div>
            <span class="attrName">Ime: </span>
            <span class="attrValue">{{ $zrtev["IME"] }}</span>
        </div>
        <div>
            <span class="attrName">Starši: </span>
            <span class="attrValue">{{ $zrtev["STARSI"] }}</span>
        </div>
        <div>
            <span class="attrName">Rojstvo: </span>
            <span class="attrValue">{{ $zrtev["ROJSTVO"] }}</span>
		</div>
        <div>
            <span class="attrName">Kraj rojstva: </span>
            <span class="attrValue">{{ $zrtev["KRAJ_ROJSTVA"] }}</span>
		</div>
        <div>
            <span class="attrName">Župnija: </span>
            <span class="attrValue">{{ $zrtev["ZUPNIJA"] }}</span>
		</div>
        <div>
            <span class="attrName">Bivališče: </span>
            <span class="attrValue">{{ $zrtev["BIVALISCE"] }}</span>
		</div>
        <div>
            <span class="attrName">Občina: </span>
            <span class="attrValue">{{ $zrtev["OBCINA"] }}</span>
		</div>
        <div>
            <span class="attrName">Dežela: </span>
            <span class="attrValue">{{ $zrtev["DEZELA"] }}</span>
		</div>
        <div>
            <span class="attrName">Domovinska: </span>
            <span class="attrValue">{{ $zrtev["DOMOVINSKA"] }}</span>
		</div>
        <div>
            <span class="attrName">Stan: </span>
            <span class="attrValue">{{ $zrtev["STAN"] }}</span>
		</div>
        <div>
            <span class="attrName">Vpoklic: </span>
            <span class="attrValue">{{ $zrtev["VPOKLIC"] }}</span>
		</div>
        <div>
            <span class="attrName">Smrt: </span>
            <span class="attrValue">{{ $zrtev["SMRT"] }}</span>
		</div>
        <div>
            <span class="attrName">Kraj smrti: </span>
            <span class="attrValue">{{ $zrtev["KRAJ_SMRTI"] }}</span>
		</div>
        <div>
            <span class="attrName">Vzrok: </span>
            <span class="attrValue">{{ $zrtev["VZROK"] }}</span>
		</div>
        <div>
            <span class="attrName">Pokop: </span>
            <span class="attrValue">{{ $zrtev["POKOP"] }}</span>
		</div>
        <div>
            <span class="attrName">Čin: </span>
            <span class="attrValue">{{ $zrtev["CIN"] }}</span>
		</div>
        <div>
            <span class="attrName">Enota: </span>
            <span class="attrValue">{{ $zrtev["ENOTA"] }}</span>
		</div>
        <div>
            <span class="attrName">Ostalo: </span>
            <span class="attrValue">{{ $zrtev["OSTALO"] }}</span>
		</div>
        <div>
            <span class="attrName">Viri: </span>
            <span class="attrValue">{{ $zrtev["VIRI"] }}</span>
		</div>
        <div>
            <span class="attrName">Izvor: </span>
            <span class="attrValue">{{ $zrtev["IZVOR"] }}</span>
        </div>
        <div>
            <span class="attrName">Opombe: </span>
            <span class="attrValue">{{ $zrtev["OPOMBE"] }}</span>
		</div>
    </div>

</main>

@endsection
