<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <!-- Search and Filter Form -->
                <form method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Search jobs...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Types</option>
                            <option value="full-time" {{ request('type') === 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ request('type') === 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ request('type') === 'contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Min Salary</label>
                        <input type="number" name="salary_min" value="{{ request('salary_min') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Apply Filters
                        </button>
                    </div>
                </form>

                <h1 class="text-2xl font-semibold mb-6">Available Jobs</h1>

                <div class="grid gap-6">
                    @foreach($jobs as $job)
                    <div class="border rounded-lg p-6 hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">{{ $job->title }}</h2>
                                <p class="text-gray-600">{{ $job->company->name }}</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $job->location }}
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($job->type) }}
                                </span>
                                <p class="mt-2 text-sm text-gray-600">
                                    ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('jobs.show', $job) }}" class="text-blue-600 hover:text-blue-800">
                                View Details & Apply →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
