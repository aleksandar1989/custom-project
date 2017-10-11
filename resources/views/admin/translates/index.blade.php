@extends('admin.app')
@section('title') Translates @endsection

@section('header')

@endsection

@section('content')
    <div class="translates_listing_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Translates
            <small>Here you can add and search some word for translate</small>
        </h1>
        <!-- END PAGE TITLE-->

        <div class="box-header with-border">
            <div class="search-bar">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(array('action' => ['Admin\TranslatesController@index'], 'method' => 'get', 'class' => 'pull-right')) !!}
                        <div class="input-group">
                            <input type="text" name="search" value="{{ isset($search) ? $search : '' }}" class="form-control" placeholder="Search key...">
                            <span class="input-group-btn">
                            <button class="btn blue uppercase bold" type="submit">Search</button>
                        </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <!-- form start -->
            {!! Form::open(['url' => 'admin/translate-words']) !!}

            <div class="form-group {{ $errors->has('key') ? 'has-error' : ''}}">
                <label for="code">Add Word Key</label>
                {!! Form::text('key', null, ['class' => 'form-control', 'id' => 'code', 'placeholder' => 'Enter word key...']) !!}
                @if($errors->first('key'))
                    <span class="help-block">{{ $errors->first('key') }}</span>
                @endif
            </div>

            <div class="form-group">

                <button type="submit" class="btn green"></i> Create</button>
            </div>

            {!! Form::close() !!}
        </div>

        <h3 class="box-title text-center">{{ $translateWords->count() ? 'All Word Keys' : 'No word keys' }}</h3>
        <br>
        <div class="box box-solid clearfix">

            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    @if($translateWords->count())
                        @foreach($translateWords as $word)
                            <div class="panel box box-primary clearfix">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" class="collapse-keys" data-parent="#accordion" href="#key_{{ $word->id }}">
                                            <i class="fa fa-angle-right"></i>
                                            {{ $word->key }}
                                        </a>
                                    </h4>
                                    <div class="delete_action">
                                        {!! Form::open(['route' => array('translate-words.destroy', $word->id), 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure you want to delete this key?");']) !!}&nbsp;
                                        <button class="btn red btn-xs">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div id="key_{{ $word->id }}" class="panel-collapse collapse {{ session('translate_word_id') == $word->id ? 'in' : '' }}">
                                    <div class="box-body">
                                        {!! Form::open(['url' => 'admin/languages/translates']) !!}
                                        {!! Form::hidden('translate_word_id', $word->id) !!}
                                        <div class="form-group {{ ($errors->has('language') && (session('translate_word_id') == $word->id)) ? 'has-error' : ''}}">
                                            <label for="language">Language</label>
                                            <select name="language" class="form-control" id="language_id">
                                                <option value="">Choose language...</option>
                                                @foreach(locales() as $code => $name)
                                                    @if(!in_array(languageIdByCode($code), $word->translates->pluck('language_id')->toArray())))
                                                    <option value="{{ $code }}">{{ $name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->first('language') && (session('translate_word_id') == $word->id))
                                                <span class="help-block">{{ $errors->first('language') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ ($errors->has('translate') && (session('translate_word_id') == $word->id)) ? 'has-error' : ''}}">
                                            <label for="translate">Translate</label>
                                            {!! Form::textarea('translate', null, ['class' => 'form-control', 'id' => 'translate', 'rows' => '1', 'placeholder' => 'Enter translate...']) !!}
                                            @if($errors->first('translate') && (session('translate_word_id') == $word->id))
                                                <span class="help-block">{{ $errors->first('translate') }}</span>
                                            @endif
                                        </div>

                                        <button class="btn green">Add</button>
                                        {!! Form::close() !!}




                                        <table class="translate_key_list_box">
                                            <tbody>
                                            @if($word->translates->count())
                                                <h4 class="key_list_title">Here you can update or delete translation key</h4>
                                                @foreach($word->translates as $translate)
                                                    <tr valign="top">
                                                        <td>
                                                            <label class="title">{{ languageById($translate->language_id)->name }} &nbsp;</label>
                                                        </td>
                                                        {!! Form::open(['method' => 'PATCH', 'action' => ['Admin\TranslatesController@update', $translate->id]]) !!}&nbsp;
                                                        <td>
                                                            {!! Form::hidden('translate_word_id', $word->id) !!}
                                                            <label>
                                                                {!! Form::textarea('translate', $translate->value, ['rows' => '1']) !!}
                                                            </label>&nbsp;
                                                        </td>
                                                        <td class="update_key">
                                                            <button class="btn btn-xs yellow">
                                                                <i class="fa fa-check"></i>
                                                                Update
                                                            </button>
                                                        </td>
                                                        {!! Form::close() !!}
                                                        <td class="delete_key">

                                                            {!! Form::open(['route' => array('translates.destroy', $translate->id), 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure you want to delete this translation?");']) !!}&nbsp;
                                                            <button class="btn red btn-xs">
                                                                <i class="fa fa-remove"></i>
                                                                Delete
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
    <script>
        $('.collapse-keys').click(function() {
            var fa = $(this).find('i');

            if(fa.hasClass('fa-angle-right')) {
                $('.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-right');

                fa.removeClass('fa-angle-right');
                fa.addClass('fa-angle-down');
            } else {
                fa.addClass('fa-angle-right');
                fa.removeClass('fa-angle-down');
            }
        });
    </script>
@endsection