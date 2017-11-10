<!-- Left Side Of Navbar -->
<ul class="nav navbar-nav navbar-right language_box">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <img src="{{ asset('front/img/' . Translate::key('language_flag')) }}" class="img-responsive language_flag">
            <span id="lanNavSel">
               @foreach(locales() as $code => $name)
                    @if($code == locale())
                        {{ Translate::key($name) }}
                    @endif
                @endforeach
            </span> <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            @foreach(locales() as $code => $name)
                {{--@if($code != locale() && $code != 'rs')--}}
                @if($code != locale() )
                    <li class="icl-sr">
                        <a href="/{{ isset($post) && $post->hasRelation($code) ? $code . $post->relation($code)->url() : $code }}">
                            <span>{{ Translate::key($name) }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
</ul>