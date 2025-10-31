<x-admin-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-semibold mb-6">Dashboard Overview</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h3 class="text-lg font-medium text-blue-800">Total Users</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_users'] }}</p>
                    <div class="mt-2 text-sm text-blue-600">
                        <span>Employers: {{ $stats['total_employers'] }}</span>
                        <span class="mx-2">|</span>
                        <span>Applicants: {{ $stats['total_applicants'] }}</span>
                    </div>
                </div>

                <div class="bg-green-50 p-6 rounded-lg">
                    <h3 class="text-lg font-medium text-green-800">Jobs Posted</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['total_jobs'] }}</p>
                    <p class="mt-2 text-sm text-green-600">
                        Pending approval: {{ $stats['pending_jobs'] }}
                    </p>
                </div>

                <div class="bg-purple-50 p-6 rounded-lg">
                    <h3 class="text-lg font-medium text-purple-800">Total Applications</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['total_applications'] }}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
