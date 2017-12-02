@extends(themeView('layouts.app'))

@section('content')


    <div class="inner_wrapper">

        <div class="container post_default_wrapper">

            <div class="row">

                <div class="col-md-12">

                    <div class="inner">

                        {!! $post->content !!}

                    </div>

                </div>

            </div>

        </div>
    </div>




@endsection

@section('title'){{ $post->seo_title ? $post->seo_title : $post->title }}@endsection

@section('description'){{ $post->seo_description }}@endsection

@section('footer')
    <script src="{{ asset('front/js/custom.js') }}" type="text/javascript"></script>
@endsection