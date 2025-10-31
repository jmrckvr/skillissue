<x-employer-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">{{ $company->name }} Dashboard</h1>
                <a href="{{ route('employer.companies.edit', $company) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Edit Company Profile
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900">Total Jobs</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_jobs'] }}</p>
                    <p class="mt-1 text-sm text-gray-600">Active: {{ $stats['active_jobs'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900">Applications</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['total_applications'] }}</p>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Recent Applications</h2>
                <div class="bg-white shadow overflow-hidden rounded-lg">
                    <ul class="divide-y divide-gray-200">
                        @foreach($stats['recent_applications'] as $application)
                        <li class="p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $application->applicant->name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Applied for: {{ $application->job->title }}
                                    </p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                        'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-employer-layout>
