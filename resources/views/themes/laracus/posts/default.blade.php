@extends('app')

@section('content')


    <div class="inner_wrapper">

        <div class="container post_default_wrapper">

            <div class="row">

                <div class="col-md-12">

                    <div class="inner">

                        {!! $render->compile($post->content) !!}

                    </div>

                </div>

            </div>

        </div>
    </div>

    @include('partials.newsletter')

    @if($post->hasMeta('sidebar_download_1') || $post->hasMeta('sidebar_contact_1'))
        @include('partials.right_sidebar')
    @endif

@endsection

@section('title'){{ $post->seo_title ? $post->seo_title : $post->title }}@endsection

@section('description'){{ $post->seo_description }}@endsection

@section('footer')
    <script src="{{ themeAssets('js/right-sidebar.js') }}"></script>
@endsection