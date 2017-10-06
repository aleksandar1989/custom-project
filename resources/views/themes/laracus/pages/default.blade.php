@extends('themes.laracus.layouts.app')
@section('title'){{ $post->seo_title ? $post->seo_title : $post->title }}@endsection
@section('description'){{ $post->seo_description }}@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $post->title }}</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
