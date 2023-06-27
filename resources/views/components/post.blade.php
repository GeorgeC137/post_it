@props(['post' => $post])

<div>
    <div class="mb-4">
        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->username }}</a>
        <span class="text-gray text-sm">{{ $post->created_at->diffForHumans() }}</span>

        <p class="mb-2">{{ $post->body }}</p>

        @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="post">
                @csrf
                @method('delete')
                <button class="text-red-500" type="submit">Delete</button>
            </form>
        @endcan

        <div class="flex items-center">
            @auth

                @if (!$post->likedBy(auth()->user()))

                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>

                @else

                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    @method('delete')
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
                @endif

            @endauth

            <span class="font-bold">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
        </div>

    </div>
</div>
