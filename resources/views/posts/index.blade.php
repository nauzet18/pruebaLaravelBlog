@extends('layouts.app')

@section('content')
  <div class="container mx-auto">
    <div class="bg-blue-100 px-3 pt-4 pb-2">
      <h1 class="text-3xl">
          Últimos Posts
      </h1>
    </div>
    <div class="bg-white p-2 mb-2">
      @foreach ($posts as $post)
        <div class="bg-green-100 px-3 pt-4 pb-2 mb-2">

          <div class="flex justify-between">
            <span class="text-2xl normal-case">
              <a class="post-link" href="/posts/{{$post['id']}}">
                {{ $post['title'] }}
              </a>
            </span>
            <span class="text-xl normal-case">
                {{$post['user']['name'] }}
              </a>
            </span>
          </div>
          <p class="mt-2">
            {{ $post['body'] }}
          </p>
        </div>
      @endforeach
      {{ $posts->links() }}
    </div>
  </div>
@endsection
