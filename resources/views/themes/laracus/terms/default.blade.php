@extends('themes.laracus.layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <h1 class="page-header">
                    Subcategories list
                </h1>

                @if($term->children->count())
                    <ul>
                        @foreach($term->children as $child)
                            <li>
                                <a href="{{ $child->url() }}">{{ $child->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>

        </div>

    </div>

@endsection

@section('title'){{ $term->name }}@endsection

@section('description'){{ $term->taxonomy->description }}@endsection