<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit SEO') }} - {{ $seo->route_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('SEO Settings') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Update SEO metadata for this page including Open Graph, Twitter Card, and JSON-LD structured data.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('admin.seo.update', $seo->route_name) }}" class="mt-6 space-y-8">
                            @csrf
                            @method('PUT')

                            <!-- Basic SEO -->
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Basic SEO</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="title" :value="__('Page Title')" />
                                        <x-text-input 
                                            id="title" 
                                            name="title" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('title', $seo->title)" 
                                            required
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 50-60 characters</p>
                                    </div>

                                    <div>
                                        <x-input-label for="description" :value="__('Meta Description')" />
                                        <textarea 
                                            id="description" 
                                            name="description" 
                                            rows="3"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                            required
                                        >{{ old('description', $seo->description) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 150-160 characters</p>
                                    </div>

                                    <div>
                                        <x-input-label for="canonical_url" :value="__('Canonical URL')" />
                                        <x-text-input 
                                            id="canonical_url" 
                                            name="canonical_url" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('canonical_url', $seo->canonical_url)" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('canonical_url')" />
                                    </div>

                                    <div>
                                        <x-input-label for="robots" :value="__('Robots Meta Tag')" />
                                        <x-text-input 
                                            id="robots" 
                                            name="robots" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('robots', $seo->robots)" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('robots')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">e.g., "index, follow" or "noindex, nofollow"</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Open Graph -->
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Open Graph (Facebook)</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="og_title" :value="__('OG Title')" />
                                        <x-text-input 
                                            id="og_title" 
                                            name="og_title" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('og_title', $seo->og_title)" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('og_title')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to use page title</p>
                                    </div>

                                    <div>
                                        <x-input-label for="og_description" :value="__('OG Description')" />
                                        <textarea 
                                            id="og_description" 
                                            name="og_description" 
                                            rows="3"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        >{{ old('og_description', $seo->og_description) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('og_description')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to use meta description</p>
                                    </div>

                                    <div>
                                        <x-input-label for="og_image" :value="__('OG Image URL')" />
                                        <x-text-input 
                                            id="og_image" 
                                            name="og_image" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('og_image', $seo->og_image)" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('og_image')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 1200x630px</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Twitter Card -->
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Twitter Card</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="twitter_card" :value="__('Twitter Card Type')" />
                                        <select 
                                            id="twitter_card" 
                                            name="twitter_card"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        >
                                            <option value="summary" {{ old('twitter_card', $seo->twitter_card) === 'summary' ? 'selected' : '' }}>Summary</option>
                                            <option value="summary_large_image" {{ old('twitter_card', $seo->twitter_card) === 'summary_large_image' ? 'selected' : '' }}>Summary Large Image</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('twitter_card')" />
                                    </div>

                                    <div>
                                        <x-input-label for="twitter_title" :value="__('Twitter Title')" />
                                        <x-text-input 
                                            id="twitter_title" 
                                            name="twitter_title" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('twitter_title', $seo->twitter_title)" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('twitter_title')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to use page title</p>
                                    </div>

                                    <div>
                                        <x-input-label for="twitter_description" :value="__('Twitter Description')" />
                                        <textarea 
                                            id="twitter_description" 
                                            name="twitter_description" 
                                            rows="3"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        >{{ old('twitter_description', $seo->twitter_description) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('twitter_description')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to use meta description</p>
                                    </div>
                                </div>
                            </div>

                            <!-- LLM Optimization -->
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">LLM Optimization</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="llm_summary" :value="__('LLM Summary')" />
                                        <textarea 
                                            id="llm_summary" 
                                            name="llm_summary" 
                                            rows="4"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        >{{ old('llm_summary', $seo->llm_summary) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('llm_summary')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">2-4 sentence plain-language description optimized for AI summarization</p>
                                    </div>

                                    <div>
                                        <x-input-label for="llm_keywords" :value="__('LLM Keywords')" />
                                        <x-text-input 
                                            id="llm_keywords" 
                                            name="llm_keywords" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('llm_keywords', $seo->llm_keywords)" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('llm_keywords')" />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Comma-separated semantic entities and topics</p>
                                    </div>
                                </div>
                            </div>

                            <!-- JSON-LD Structured Data -->
                            <div class="pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">JSON-LD Structured Data</h3>
                                
                                <div>
                                    <x-input-label for="json_ld" :value="__('JSON-LD Schema')" />
                                    <textarea 
                                        id="json_ld" 
                                        name="json_ld" 
                                        rows="10"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm font-mono text-sm"
                                    >{{ old('json_ld', $seo->json_ld ? json_encode($seo->json_ld, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('json_ld')" />
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Valid JSON object for structured data (e.g., LocalBusiness, Service schema)</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                <a href="{{ route('admin.seo.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
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
