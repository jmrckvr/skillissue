<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="mb-8">
                    <h1 class="text-3xl font-semibold text-gray-900">{{ $job->title }}</h1>
                    <div class="mt-2 flex items-center justify-between">
                        <div>
                            <p class="text-xl text-gray-600">{{ $job->company->name }}</p>
                            <p class="text-gray-500">{{ $job->location }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($job->type) }}
                            </span>
                            <p class="mt-2 text-gray-600">
                                ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="prose max-w-none mb-8">
                    {{ $job->description }}
                </div>

                @if(!auth()->user()->hasApplied($job))
                    <form action="{{ route('jobs.apply', $job) }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Cover Letter</label>
                            <textarea name="cover_letter" rows="6" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Tell us why you're a great fit for this role..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Resume (PDF only)</label>
                            <input type="file" name="resume" accept=".pdf" required
                                class="mt-1 block w-full">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                                Submit Application
                            </button>
                        </div>
                    </form>
                @else
                    <div class="bg-gray-50 border rounded p-4 mt-8">
                        <p class="text-gray-600">You have already applied for this position.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
