<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Assignment') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.assignments.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="file" :value="__('Upload File (optional)')" />
                <input id="file" name="file" type="file" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-primary-button>{{ __('Submit Assignment') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-admin-app-layout>
