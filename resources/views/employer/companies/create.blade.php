<x-employer-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-semibold mb-6">Create Company Profile</h1>

        <form action="{{ route('employer.companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700">Company Logo</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                        class="mt-1 block w-full">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                        Create Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-employer-layout>
