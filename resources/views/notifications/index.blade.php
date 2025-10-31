<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold">Notifications</h1>
                    @if($notifications->where('read_at', null)->count() > 0)
                        <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                                Mark all as read
                            </button>
                        </form>
                    @endif
                </div>

                <div class="space-y-4">
                    @forelse($notifications as $notification)
                        <div class="flex items-center justify-between p-4 {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }} rounded-lg">
                            <div>
                                <p class="text-gray-800">{{ $notification->data['message'] }}</p>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            
                            @unless($notification->read_at)
                                <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                                        Mark as read
                                    </button>
                                </form>
                            @endunless
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No notifications</p>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
