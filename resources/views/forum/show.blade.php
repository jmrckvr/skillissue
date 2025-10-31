<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="space-y-6">
            <!-- Thread -->
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-2xl font-semibold mb-4">{{ $thread->title }}</h1>
                <div class="prose max-w-none">
                    {{ $thread->content }}
                </div>
                
                <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                    <div>
                        Posted by {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}
                    </div>
                    <div class="flex space-x-4">
                        <button onclick="toggleReaction('{{ $thread->id }}')" 
                            class="reaction-btn {{ auth()->user()->hasReacted($thread) ? 'text-blue-600' : '' }}">
                            👍 <span>{{ $thread->reactions->count() }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Comments -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Comments</h2>
                
                <form action="{{ route('forum.threads.comments.store', $thread) }}" method="POST" class="mb-6">
                    @csrf
                    <textarea name="content" rows="3" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Add a comment..."></textarea>
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Post Comment
                        </button>
                    </div>
                </form>

                <div class="space-y-4">
                    @foreach($thread->comments as $comment)
                    <div class="border-t pt-4">
                        <div class="prose max-w-none">
                            {{ $comment->content }}
                        </div>
                        <div class="mt-2 flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}</span>
                            <button onclick="toggleReaction('{{ $comment->id }}')"
                                class="reaction-btn {{ auth()->user()->hasReacted($comment) ? 'text-blue-600' : '' }}">
                                👍 <span>{{ $comment->reactions->count() }}</span>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleReaction(id) {
            fetch(`/forum/reactions`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ id })
            }).then(() => window.location.reload());
        }
    </script>
    @endpush
</x-app-layout>
