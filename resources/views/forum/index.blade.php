<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold">Community Forum</h1>
                    <button onclick="window.location.href='{{ route('forum.threads.create') }}'" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                        New Thread
                    </button>
                </div>

                <div class="space-y-4">
                    @foreach($threads as $thread)
                    <div class="border rounded-lg p-4 hover:shadow-sm transition">
                        <div class="flex justify-between">
                            <div>
                                <h2 class="text-lg font-medium">
                                    <a href="{{ route('forum.threads.show', $thread) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $thread->title }}
                                    </a>
                                </h2>
                                <p class="text-sm text-gray-500">
                                    Posted by {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="text-sm text-gray-500">
                                <span>{{ $thread->comments_count }} comments</span>
                                <span class="mx-2">•</span>
                                <span>{{ $thread->reactions_count }} reactions</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $threads->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
