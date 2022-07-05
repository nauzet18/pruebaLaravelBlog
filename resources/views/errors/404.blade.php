@extends('layouts.app')

@section('content')
  <div class="px-4 py-2 bg-red-600 text-white mb-2">
    <ul class="list-disc mb-2 mx-4">
      <li class="mt-2">{{ $exception->getMessage() }}</li>
    </ul>
  </div>
@endsection
