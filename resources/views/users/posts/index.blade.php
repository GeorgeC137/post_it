@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8-12">

        <div class="p-6">
            <h1 class="text-2xl font-medium text-blue-500 mb-1">{{ $user->username }}</h1>
            <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and received {{ $user->receivedLikes->count() }} likes</p>
        </div>

        <div class="bg-white p-6 rounded-lg">
            @if ($posts->count())
            @foreach ($posts as $post)
                <x-post :post='$post' />
            @endforeach

            {{-- Outputing pagination links  --}}
            {{ $posts->links() }}

            @else
                <p class="tetx-red-500">{{ $user->name }} does not have ny posts</p>
            @endif
        </div>

    </div>
</div>
@endsection
