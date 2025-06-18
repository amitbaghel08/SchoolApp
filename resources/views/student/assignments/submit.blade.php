<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Submit Assignment: {{ $assignment->title }}</h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto">
        <form method="POST" action="{{ route('submission.store', $assignment->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf

            <div>
                <x-input-label for="file" :value="__('Upload File')" />
                <input id="file" name="file" type="file" class="block mt-1 w-full" required />
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-primary-button>{{ __('Submit') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
