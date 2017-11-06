<div class="sidebar_item clearfix">
    <div class="form-group">
        <h3>Relations</h3>
        @foreach(locales() as $code => $name)
            @if($code != language('code'))
                <div class="form-group">
                    <h3>{{ $name }}</h3>
                    <select name="relation[{{ $code }}]" class="form-control relation-posts">
                        <option value="">No relation...</option>
                        @if($postsLeveled = App\Post::getPosts($postType, languageIdByCode($code)))
                            @foreach($postsLeveled as $postLeveled)
                                <option value="{{ $postLeveled['id'] }}"
                                        {{ App\PostRelation::where('post_id', $postLeveled['id'])->where('language', language('code'))->count() ? ( isset($post) && $post->hasRelation($code) && $post->relation($code)->id == $postLeveled['id'] ? '' : 'disabled' ) : '' }}
                                        {{ Input::old('relation.' . $code) == $postLeveled['id'] || (isset($post) && $post->hasRelation($code) && $post->relation($code)->id == $postLeveled['id']) ? 'selected' : '' }}>
                                    @for($i = 0; $i < $postLeveled['level']; $i++)&nbsp;&nbsp;&nbsp;&nbsp;@endfor
                                    {{ $postLeveled['title'] }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <button type="button" class="btn btn-block btn-primary btn-xs pull-right fill-data" data-lng="{{ $code }}">Fill data from selected post</button>
                </div>
            @endif
        @endforeach
    </div>
</div>