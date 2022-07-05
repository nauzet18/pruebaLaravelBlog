@extends('layouts.app')

@section('content')
@if( !empty($post))
  <div class="container mx-auto">
    <div class="bg-blue-100 px-3 pt-4 pb-2">
      <h1 class="text-3xl">
          {{ $post['title'] }}
      </h1>
    </div>
    <div class="bg-white p-2 mb-2">

      <div class="xl:flex xl:space-x-8">
          <div class="xl:w-9/12 sm:w-full w-full my-4 px-4">
            <p class="mt-2">
              {!! $post['body'] !!}
            </p>
          </div>
          <div class="xl:w-3/12 sm:w-full w-full my-4 px-4">
              <div class="bg-green-100 p-4">
                <span class="text-2xl">
                  Autor
                </span>
                <p>
                  <span class="font-bold">
                    Nombre:
                  </span>
                  {{$post['user']['name'] }}
                </p>
                <p>
                  <span class="font-bold">
                    Email:
                  </span>
                  {{$post['user']['email'] }}
                </p>
                <p>
                  <span class="font-bold">
                    Teléfono:
                  </span>
                  {{$post['user']['phone'] }}
                </p>
                <p>
                  <span class="font-bold">
                    Web:
                  </span>
                  {{$post['user']['website'] }}
                </p>
                <p>
                  <span class="font-bold">
                    Compañia:
                  </span>
                  {{$post['user']['company']['name'] }}
                </p>

              </div>
          </div>
      </div>

    </div>
  </div>
@endif
@endsection
