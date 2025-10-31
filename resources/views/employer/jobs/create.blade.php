<x-employer-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-semibold mb-6">Post New Job</h1>

        <form action="{{ route('employer.jobs.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="6" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Employment Type</label>
                        <select name="type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="full-time">Full Time</option>
                            <option value="part-time">Part Time</option>
                            <option value="contract">Contract</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Minimum Salary</label>
                        <input type="number" name="salary_min" value="{{ old('salary_min') }}" required min="0" step="1000"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Maximum Salary</label>
                        <input type="number" name="salary_max" value="{{ old('salary_max') }}" required min="0" step="1000"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" name="expires_at" value="{{ old('expires_at') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                        Post Job
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-employer-layout>
