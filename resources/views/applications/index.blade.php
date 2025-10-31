<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-semibold mb-6">My Applications</h1>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Position</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applied Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($applications as $application)
                            <tr>
                                <td class="px-6 py-4">{{ $application->job->title }}</td>
                                <td class="px-6 py-4">{{ $application->job->company->name }}</td>
                                <td class="px-6 py-4">{{ $application->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $application->status === 'hired' ? 'bg-green-100 text-green-800' : 
                                           ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                            'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
