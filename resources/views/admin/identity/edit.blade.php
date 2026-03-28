<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Site Identity') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Site Identity Settings') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Update your site\'s brand identity, contact information, and social media links.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('admin.identity.update') }}" class="mt-6 space-y-8" x-data="{
                            brandName: '{{ old('values.brand_name', $identity->get('brand_name')->value ?? '') }}'
                        }">
                            @csrf

                            <!-- Brand Section -->
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Brand</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="brand_name" :value="__('Brand Name')" />
                                        <x-text-input 
                                            id="brand_name" 
                                            name="values[brand_name]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            x-model="brandName"
                                            :value="old('values.brand_name', $identity->get('brand_name')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.brand_name')" />
                                        
                                        <!-- Live Preview -->
                                        <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-900 rounded-md border border-gray-200 dark:border-gray-700">
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Preview in header:</p>
                                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100" x-text="brandName || 'Your Brand Name'"></p>
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label for="tagline" :value="__('Tagline')" />
                                        <x-text-input 
                                            id="tagline" 
                                            name="values[tagline]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.tagline', $identity->get('tagline')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.tagline')" />
                                    </div>

                                    <div>
                                        <x-input-label for="logo_url" :value="__('Logo URL')" />
                                        <x-text-input 
                                            id="logo_url" 
                                            name="values[logo_url]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.logo_url', $identity->get('logo_url')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.logo_url')" />
                                    </div>
                                </div>
                            </div>

                            <!-- Hero Section -->
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Hero</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="hero_title" :value="__('Hero Title')" />
                                        <x-text-input 
                                            id="hero_title" 
                                            name="values[hero_title]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.hero_title', $identity->get('hero_title')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.hero_title')" />
                                    </div>

                                    <div>
                                        <x-input-label for="hero_subtitle" :value="__('Hero Subtitle')" />
                                        <x-text-input 
                                            id="hero_subtitle" 
                                            name="values[hero_subtitle]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.hero_subtitle', $identity->get('hero_subtitle')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.hero_subtitle')" />
                                    </div>

                                    <div>
                                        <x-input-label for="hero_cta_text" :value="__('Hero CTA Text')" />
                                        <x-text-input 
                                            id="hero_cta_text" 
                                            name="values[hero_cta_text]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.hero_cta_text', $identity->get('hero_cta_text')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.hero_cta_text')" />
                                    </div>

                                    <div>
                                        <x-input-label for="hero_cta_url" :value="__('Hero CTA URL')" />
                                        <x-text-input 
                                            id="hero_cta_url" 
                                            name="values[hero_cta_url]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.hero_cta_url', $identity->get('hero_cta_url')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.hero_cta_url')" />
                                    </div>

                                    <div>
                                        <x-input-label for="hero_image_url" :value="__('Hero Image URL')" />
                                        <x-text-input 
                                            id="hero_image_url" 
                                            name="values[hero_image_url]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.hero_image_url', $identity->get('hero_image_url')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.hero_image_url')" />
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Section -->
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Contact</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="contact_email" :value="__('Contact Email')" />
                                        <x-text-input 
                                            id="contact_email" 
                                            name="values[contact_email]" 
                                            type="email" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.contact_email', $identity->get('contact_email')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.contact_email')" />
                                    </div>

                                    <div>
                                        <x-input-label for="contact_phone" :value="__('Contact Phone')" />
                                        <x-text-input 
                                            id="contact_phone" 
                                            name="values[contact_phone]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.contact_phone', $identity->get('contact_phone')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.contact_phone')" />
                                    </div>

                                    <div>
                                        <x-input-label for="address_street" :value="__('Street Address')" />
                                        <x-text-input 
                                            id="address_street" 
                                            name="values[address_street]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.address_street', $identity->get('address_street')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.address_street')" />
                                    </div>

                                    <div>
                                        <x-input-label for="address_city" :value="__('City')" />
                                        <x-text-input 
                                            id="address_city" 
                                            name="values[address_city]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.address_city', $identity->get('address_city')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.address_city')" />
                                    </div>

                                    <div>
                                        <x-input-label for="address_state" :value="__('State/Province')" />
                                        <x-text-input 
                                            id="address_state" 
                                            name="values[address_state]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.address_state', $identity->get('address_state')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.address_state')" />
                                    </div>

                                    <div>
                                        <x-input-label for="address_zip" :value="__('ZIP/Postal Code')" />
                                        <x-text-input 
                                            id="address_zip" 
                                            name="values[address_zip]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.address_zip', $identity->get('address_zip')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.address_zip')" />
                                    </div>

                                    <div>
                                        <x-input-label for="address_country" :value="__('Country')" />
                                        <x-text-input 
                                            id="address_country" 
                                            name="values[address_country]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.address_country', $identity->get('address_country')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.address_country')" />
                                    </div>
                                </div>
                            </div>

                            <!-- Social Section -->
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Social Media</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="social_facebook" :value="__('Facebook URL')" />
                                        <x-text-input 
                                            id="social_facebook" 
                                            name="values[social_facebook]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.social_facebook', $identity->get('social_facebook')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.social_facebook')" />
                                    </div>

                                    <div>
                                        <x-input-label for="social_instagram" :value="__('Instagram URL')" />
                                        <x-text-input 
                                            id="social_instagram" 
                                            name="values[social_instagram]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.social_instagram', $identity->get('social_instagram')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.social_instagram')" />
                                    </div>

                                    <div>
                                        <x-input-label for="social_twitter" :value="__('Twitter/X URL')" />
                                        <x-text-input 
                                            id="social_twitter" 
                                            name="values[social_twitter]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.social_twitter', $identity->get('social_twitter')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.social_twitter')" />
                                    </div>

                                    <div>
                                        <x-input-label for="social_linkedin" :value="__('LinkedIn URL')" />
                                        <x-text-input 
                                            id="social_linkedin" 
                                            name="values[social_linkedin]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.social_linkedin', $identity->get('social_linkedin')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.social_linkedin')" />
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Section -->
                            <div class="pb-6">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4">Footer</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="footer_text" :value="__('Footer Text')" />
                                        <textarea 
                                            id="footer_text" 
                                            name="values[footer_text]" 
                                            rows="3"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        >{{ old('values.footer_text', $identity->get('footer_text')->value ?? '') }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('values.footer_text')" />
                                    </div>

                                    <div>
                                        <x-input-label for="footer_copyright" :value="__('Copyright Text')" />
                                        <x-text-input 
                                            id="footer_copyright" 
                                            name="values[footer_copyright]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            :value="old('values.footer_copyright', $identity->get('footer_copyright')->value ?? '')" 
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('values.footer_copyright')" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>

                                @if (session('status') === 'identity-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
