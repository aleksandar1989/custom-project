@extends('admin.app')
@section('title') Translates @endsection

@section('header')

@endsection

@section('content')
    <div class="translates_listing_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Translates
            <small>Here you can add some word for translate</small>
        </h1>
        <!-- END PAGE TITLE-->

        <div class="box-body">
            <!-- form start -->
            {!! Form::open(['url' => 'admin/translate-words']) !!}

            <div class="form-group">
                <label for="code">Word Key</label>
                {!! Form::text('key', null, ['class' => 'form-control', 'id' => 'code', 'placeholder' => 'Enter word key...']) !!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn green pull-right">Create</button>
            </div>

            {!! Form::close() !!}
        </div>


        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">All Word Keys</h3>

                {!! Form::open(array('action' => ['Admin\TranslatesController@index'], 'method' => 'get', 'class' => 'pull-right')) !!}
                <input type="text" name="search" value="{{ isset($search) ? $search : '' }}" placeholder="Search key...">
                {!! Form::close() !!}
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    @if($translateWords->count())
                        @foreach($translateWords as $word)
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" class="collapse-keys" data-parent="#accordion" href="#key_{{ $word->id }}">
                                            <i class="fa fa-arrow-circle-down"></i>
                                            {{ $word->key }}
                                        </a>
                                    </h4>
                                    <div class="pull-right">
                                        {!! Form::open(['route' => array('translate-words.destroy', $word->id), 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure you want to delete this key?");']) !!}&nbsp;
                                        <button class="btn btn-danger btn-xs">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div id="key_{{ $word->id }}" class="panel-collapse collapse {{ session('translate_word_id') == $word->id ? 'in' : '' }}">
                                    <div class="box-body">
                                        {!! Form::open(['url' => 'admin/languages/translates']) !!}
                                        {!! Form::hidden('translate_word_id', $word->id) !!}
                                        <div class="form-group">
                                            <label for="language">Language</label>

                                            <select name="language" class="form-control" id="language_id">
                                                <option value="">Choose language...</option>
                                                {{--<?php print_r(locales()); ?>--}}
                                                {{--@foreach(locales() as $code => $name)--}}
                                                    {{--@if(!in_array(languageIdByCode($code), $word->translates->pluck('language_id')->toArray())))--}}
                                                    {{--<option value="{{ $code }}">{{ $name }}</option>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="translate">Translate</label>
                                            {!! Form::textarea('translate', null, ['class' => 'form-control', 'id' => 'translate', 'rows' => '1', 'placeholder' => 'Enter translate...']) !!}
                                        </div>

                                        <button class="btn btn-primary pull-right">Add</button>
                                        {!! Form::close() !!}

                                        <table>
                                            <tbody>
                                            @if($word->translates->count())
                                                @foreach($word->translates as $translate)
                                                    <tr valign="top">
                                                        <td>
                                                            <label>{{ languageById($translate->language_id)->name }} &nbsp;</label>
                                                        </td>
                                                        <td>
                                                            <i class="fa fa-angle-double-right"></i>&nbsp;
                                                        </td>
                                                        {!! Form::open(['method' => 'PATCH', 'action' => ['Admin\TranslatesController@update', $translate->id]]) !!}&nbsp;
                                                        <td>
                                                            {!! Form::hidden('translate_word_id', $word->id) !!}
                                                            <label>
                                                                {!! Form::textarea('translate', $translate->value, ['rows' => '1']) !!}
                                                            </label>&nbsp;
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-warning btn-xs">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        </td>
                                                        {!! Form::close() !!}
                                                        <td>
                                                            {!! Form::open(['route' => array('languages.translates.destroy', $translate->id), 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure you want to delete this translation?");']) !!}&nbsp;
                                                            <button class="btn btn-danger btn-xs">
                                                                <i class="fa fa-remove"></i>
                                                            </button>
                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h4>No word keys</h4>
                    @endif
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer text-right">
                {!! $translateWords->render() !!}
            </div>
        </div><!-- /.box -->

    </div>

@endsection

@section('footer')

@endsection