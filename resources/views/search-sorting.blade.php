@forelse($posts as $post)
<a class="nav-blog" href="{{route('details',$post->slug)}}">
    <div class="card mb-3">
        <div class="card-header">
            {{$post->title}}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <small>Editor: {{$post->user->name}} | Date: {{$post->created_at->diffForHumans()}}</small>
                    <p>{{$post->description}}</p>
                </div>
            </div>
        </div>
    </div>
</a>
@empty
    <p>No matching records found <b>"{{$keyword}}"</b></p>
@endforelse