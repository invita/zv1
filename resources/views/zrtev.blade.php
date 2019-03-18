@extends("layout")

@section("content")

<div id="initView">
    <div class="zrtevCDiv">
        <a class="zrtevPdfButton noHover" href="/zrtevPdf?id={{$zrtevId}}" target="_blank"><img src="/img/icon/pdf.png" class="imgPdf"></a>
    </div>

    <div class="zrtevDetails">
        @foreach($fields as $fieldName)
            @if ($zrtev[$fieldName])
                <div class="attrRow row collapse">
                    <span class="attrName large-2 medium-2 small-12 columns">{{ __("zrtve1.field_".$fieldName) }}:</span>
                    <span class="attrValue large-10 medium-10 small-12 columns">{{ $zrtev[$fieldName] }}</span>
                </div>
            @endif
        @endforeach
    </div>

    <div class="zrtevCDiv">
        <a class="zrtevPdfButton noHover" href="/zrtevPdf?id={{$zrtevId}}" target="_blank"><img src="/img/icon/pdf.png" class="imgPdf"></a>
    </div>

</div>

@endsection
