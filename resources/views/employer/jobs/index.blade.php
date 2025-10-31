<x-employer-layout>
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Job Listings</h1>
            <a href="{{ route('employer.jobs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                Post New Job
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applications</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posted</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expires</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($jobs as $job)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $job->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $job->applications_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $job->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($job->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                    'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($job->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $job->posted_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $job->expires_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('employer.jobs.edit', $job) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
    </div>
</x-employer-layout>
