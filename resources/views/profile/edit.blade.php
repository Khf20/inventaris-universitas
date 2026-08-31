<x-app-layout>
    <div class="min-h-[calc(100vh-5rem)] bg-[#f3f5f9] px-4 py-8 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-5xl space-y-5">
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
