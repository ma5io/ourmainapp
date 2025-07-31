<x-layout>
  <div class="container py-md-5 container--narrow">
      <div class="d-flex justify-content-between">
        <h2>{{$post->title}}</h2>
        @can('update', $post) {{-- check if user is authorized to update using Policies --}}
        <span class="pt-2">
          <a href="/post/{{$post->id}}/edit" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
          <form class="delete-post-form d-inline" action="/post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE') {{-- html dont support delete, so we have to specify it --}}
            <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
          </form>
        </span>
        @endcan
      </div>

      <p class="text-muted small mb-4"> 
        <a href="#"><img class="avatar-tiny" src="{{$post->user->avatar}}" /></a>
        Posted by <a href="#">{{$post->user->username}}</a> on {{$post->created_at->format('j/n/Y')}}
      </p>

      <div class="body-content">
        {!! $post->body !!} {{-- use double curly with exclamation {!! !!} to output raw HTML --}}
      </div>
    </div>
</x-layout>