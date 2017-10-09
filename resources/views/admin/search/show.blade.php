@extends('admin.app')
@section('title') Search @endsection

@section('header')

@endsection

@section('content')
    <div class="search_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Search Results {{ $posts->count() }}
            <small>for <b class="laracus_color">{{ $text }}</b></small>
        </h1>
        <!-- END PAGE TITLE-->

        <div class="search-bar ">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['url' => '/admin/search', 'method' => 'get', 'class' => 'sidebar-search']) !!}
                    <div class="input-group">
                        <input type="text"  name="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn blue uppercase bold" type="submit">Search</button>
                        </span>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="search-container">
            <ul class="search-container">
                @if($posts->count())
                    @foreach($posts as $post)
                    <li class="search-item clearfix">
                        <div class="search-content text-left">
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-xs-9">
                                    <h2 class="search-title">
                                        <a href="{{ $post->url() }}" target="_blank">{{ $post->title }}</a>
                                    </h2>
                                </div>
                                <div class="col-md-4 col-sm-5 col-xs-3 action">
                                    <span> {{ $post->created_at->format('d M Y') }}</span>
                                    <a href="{{ url("admin/posts/$post->id/edit") }}" class="btn btn-xs yellow">
                                        <i class="fa fa-edit"></i>Edit
                                    </a>
                                </div>
                            </div>
                            @if($post->seo_description)
                            <p class="search-desc">{{ $post->seo_description }}</p>
                            @endif
                        </div>
                    </li>

                    @endforeach
                @else
                    <li class="search-item clearfix">
                        <div class="search-content text-center">
                            No search results for: <b>{{ $text }}</b>
                        </div>
                    </li>

                @endif
            </ul>
        </div>



    </div>

@endsection

@section('footer')

@endsection