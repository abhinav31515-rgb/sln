<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Category Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Section Details') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Configure the category section that will appear on the homepage.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('admin.category-sections.update', $categorySection) }}" class="mt-6 space-y-6" x-data="{
                            selectedServices: {{ Js::from($categorySection->services->pluck('id')->toArray()) }},
                            toggleService(serviceId) {
                                const index = this.selectedServices.indexOf(serviceId);
                                if (index > -1) {
                                    this.selectedServices.splice(index, 1);
                                } else {
                                    this.selectedServices.push(serviceId);
                                }
                            },
                            isSelected(serviceId) {
                                return this.selectedServices.includes(serviceId);
                            }
                        }">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="category_id" :value="__('Category')" />
                                <select 
                                    id="category_id" 
                                    name="category_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required
                                >
                                    @foreach (\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $categorySection->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            <div>
                                <x-input-label for="heading" :value="__('Heading')" />
                                <x-text-input 
                                    id="heading" 
                                    name="heading" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    :value="old('heading', $categorySection->heading)" 
                                    required
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('heading')" />
                            </div>

                            <div>
                                <x-input-label for="sub_heading" :value="__('Sub-heading (optional)')" />
                                <x-text-input 
                                    id="sub_heading" 
                                    name="sub_heading" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    :value="old('sub_heading', $categorySection->sub_heading)" 
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('sub_heading')" />
                            </div>

                            <div>
                                <x-input-label for="layout" :value="__('Layout Style')" />
                                <select 
                                    id="layout" 
                                    name="layout"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="grid" {{ old('layout', $categorySection->layout) === 'grid' ? 'selected' : '' }}>Grid</option>
                                    <option value="carousel" {{ old('layout', $categorySection->layout) === 'carousel' ? 'selected' : '' }}>Carousel</option>
                                    <option value="list" {{ old('layout', $categorySection->layout) === 'list' ? 'selected' : '' }}>List</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('layout')" />
                            </div>

                            <div>
                                <label class="inline-flex items-center">
                                    <input 
                                        type="checkbox" 
                                        name="is_visible" 
                                        value="1"
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" 
                                        {{ old('is_visible', $categorySection->is_visible) ? 'checked' : '' }}
                                    >
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Visible on homepage') }}</span>
                                </label>
                                <x-input-error class="mt-2" :messages="$errors->get('is_visible')" />
                            </div>

                            <!-- Services Multi-Select -->
                            <div>
                                <x-input-label :value="__('Featured Services')" />
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    {{ __('Select which services to feature in this section. Services are grouped by category.') }}
                                </p>

                                <div class="mt-2 space-y-4 max-h-96 overflow-y-auto border border-gray-300 dark:border-gray-700 rounded-md p-4">
                                    @foreach (\App\Models\Category::with('services')->get() as $category)
                                        @if ($category->services->count() > 0)
                                            <div class="border-b border-gray-200 dark:border-gray-700 pb-3 last:border-b-0">
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                                    {{ $category->name }}
                                                </h4>
                                                <div class="space-y-2 ml-4">
                                                    @foreach ($category->services as $service)
                                                        <label class="flex items-center">
                                                            <input 
                                                                type="checkbox" 
                                                                :checked="isSelected({{ $service->id }})"
                                                                @change="toggleService({{ $service->id }})"
                                                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                                            >
                                                            <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">
                                                                {{ $service->name }}
                                                                <span class="text-gray-500 dark:text-gray-400">
                                                                    (₹{{ number_format($service->price, 2) }})
                                                                </span>
                                                            </span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Hidden inputs for selected services -->
                                <template x-for="(serviceId, index) in selectedServices" :key="serviceId">
                                    <input type="hidden" :name="'service_ids[' + index + ']'" :value="serviceId">
                                </template>

                                <x-input-error class="mt-2" :messages="$errors->get('service_ids')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                <a href="{{ route('admin.category-sections.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
