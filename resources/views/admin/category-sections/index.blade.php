<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category Sections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Homepage Category Sections') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Drag to reorder sections. Only visible sections appear on the homepage.') }}
                            </p>
                        </div>
                    </div>

                    <div 
                        x-data="{
                            sections: {{ Js::from($sections->pluck('id')->toArray()) }},
                            reordering: false,
                            async reorder() {
                                this.reordering = true;
                                try {
                                    const response = await fetch('{{ route('admin.category-sections.reorder') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ ids: this.sections })
                                    });
                                    if (!response.ok) throw new Error('Reorder failed');
                                } catch (error) {
                                    console.error('Reorder error:', error);
                                    alert('Failed to reorder sections');
                                } finally {
                                    this.reordering = false;
                                }
                            }
                        }"
                        class="space-y-3"
                    >
                        @forelse ($sections as $section)
                            <div 
                                x-data="{ id: {{ $section->id }} }"
                                draggable="true"
                                @dragstart="$event.dataTransfer.effectAllowed = 'move'; $event.dataTransfer.setData('text/plain', id)"
                                @dragover.prevent="$event.dataTransfer.dropEffect = 'move'"
                                @drop.prevent="
                                    const draggedId = parseInt($event.dataTransfer.getData('text/plain'));
                                    const droppedOnId = id;
                                    const draggedIndex = sections.indexOf(draggedId);
                                    const droppedOnIndex = sections.indexOf(droppedOnId);
                                    sections.splice(draggedIndex, 1);
                                    sections.splice(droppedOnIndex, 0, draggedId);
                                    reorder();
                                "
                                class="p-4 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-move hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                            >
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4 flex-1">
                                        <div class="text-gray-400 dark:text-gray-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3">
                                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $section->heading }}
                                                </h4>
                                                @if (!$section->is_visible)
                                                    <span class="px-2 py-1 text-xs font-medium bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded">
                                                        Hidden
                                                    </span>
                                                @endif
                                                <span class="px-2 py-1 text-xs font-medium bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded">
                                                    {{ ucfirst($section->layout) }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                {{ $section->sub_heading }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                Category: <span class="font-medium">{{ $section->category->name }}</span> 
                                                | Services: <span class="font-medium">{{ $section->services->count() }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a 
                                            href="{{ route('admin.category-sections.edit', $section) }}" 
                                            class="px-3 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                        >
                                            Edit
                                        </a>
                                        <form 
                                            method="POST" 
                                            action="{{ route('admin.category-sections.destroy', $section) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this section?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="px-3 py-2 text-sm font-medium text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                                No category sections found. Create one to get started.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
