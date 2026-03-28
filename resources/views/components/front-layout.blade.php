<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-seo-head :seo="$seo ?? null" :identity="$identity ?? null" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--bg)] text-[var(--text)] antialiased font-sans min-h-screen overflow-x-hidden" x-data="{
    cartOpen: false, 
    bookingOpen: false,
    drawerOpen: false,
    toastMessage: '',
    toastType: 'info'
}">

    <div id="toast-container" class="fixed top-20 right-5 z-[2000] flex flex-col gap-2">
        <!-- Toast logic will live here -->
    </div>

    <!-- Header -->
    <x-header />

    <!-- Mobile Drawer -->
    <div x-show="drawerOpen" style="display: none;" class="relative z-[1000]" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" @keydown.escape="drawerOpen = false">
        <div x-show="drawerOpen" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-60 transition-opacity" @click="drawerOpen = false"></div>
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <div x-show="drawerOpen" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="pointer-events-auto w-screen max-w-md" x-trap.inert.noscroll="drawerOpen">
                        <div class="flex h-full flex-col overflow-y-scroll bg-[var(--surface)] py-6 shadow-xl">
                            <div class="px-4 sm:px-6 flex justify-between items-center">
                                <span class="font-serif text-[1.3rem] font-light tracking-[.25em] uppercase">{{ $identity?->get('brand_name') ?? 'AURUM' }}</span>
                                <button type="button" @click="drawerOpen = false" class="text-[var(--muted)] text-[1.4rem]" aria-label="Close menu">✕</button>
                            </div>
                            <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                <nav class="flex flex-col gap-1">
                                    <a href="#services" class="drawer-link" @click="drawerOpen = false">Services</a>
                                    <a href="#rituals" class="drawer-link" @click="drawerOpen = false">Rituals</a>
                                    <a href="#therapists" class="drawer-link" @click="drawerOpen = false">Team</a>
                                    <a href="#boutique" class="drawer-link" @click="drawerOpen = false">Boutique</a>
                                    <a href="#offers" class="drawer-link" @click="drawerOpen = false">Offers</a>
                                    <a href="#membership" class="drawer-link" @click="drawerOpen = false">Membership</a>
                                    <a href="#journal" class="drawer-link" @click="drawerOpen = false">Journal</a>
                                    <a href="#contact" class="drawer-link" @click="drawerOpen = false">Contact</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />
    
    <!-- Alpine Cart Sidebar -->
    <div x-show="cartOpen" style="display: none;" class="relative z-[1000]" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div x-show="cartOpen" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-60 transition-opacity" @click="cartOpen = false"></div>
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <div x-show="cartOpen" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col bg-[var(--surface)] shadow-xl relative border-l border-[var(--border)]">
                            <div class="flex-1 overflow-y-auto px-6 py-6 sm:px-8">
                                <div class="flex items-start justify-between">
                                    <h2 class="h4" id="slide-over-title">Your Cart</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button" class="relative -m-2 p-2 text-[var(--muted)] hover:text-white" @click="cartOpen = false">
                                            <span class="absolute -inset-0.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            ✕
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <div class="flow-root text-center py-10 opacity-70">
                                        <div class="text-[3rem] mb-2">🛍️</div>
                                        <p class="text-[var(--text)]">Your cart is empty</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-[var(--border)] px-4 py-6 sm:px-6">
                                <div class="flex justify-between text-base font-medium text-[var(--text)]">
                                    <p>Subtotal</p>
                                    <p class="font-serif text-[1.2rem] text-[var(--gold)]">₹0</p>
                                </div>
                                <p class="mt-0.5 text-sm text-[var(--muted)]">Shipping calculated at checkout.</p>
                                <div class="mt-6">
                                    <button class="btn btn-primary w-full justify-center" @click="toastMessage='Proceeding to checkout'; toastType='info'">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine Booking Modal -->
    <div x-show="bookingOpen" style="display: none;" class="relative z-[2000]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div x-show="bookingOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-70 transition-opacity" @click="bookingOpen = false"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="bookingOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-lg bg-[var(--surface)] text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl border border-[var(--border)]">
                    <div class="px-6 py-6 pb-4 sm:p-8 sm:pb-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="h4" id="modal-title">Book an Appointment</h3>
                                <p class="text-sm text-[var(--muted)] mt-1">Select your preferences below</p>
                            </div>
                            <button @click="bookingOpen = false" class="text-[var(--muted)] hover:text-white transition-colors">✕</button>
                        </div>
                        <div class="mt-2 text-center py-10 text-[var(--muted)] border border-dashed border-[var(--border)] rounded-[var(--radius-md)] bg-[var(--surface-alt)]">
                            Multi-step Booking Form Placeholder <br>
                            <span class="text-[12px] opacity-70">(Integrates with Livewire/Alpine)</span>
                        </div>
                    </div>
                    <div class="bg-[var(--surface-alt)] border-t border-[var(--border)] px-4 py-3 flex flex-row-reverse sm:px-6 gap-3">
                        <button type="button" class="btn btn-primary w-full sm:w-auto" @click="bookingOpen = false; showToast('Appointment requested', 'success')">Confirm</button>
                        <button type="button" class="btn btn-ghost w-full sm:w-auto" @click="bookingOpen = false">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JS Helpers -->
    <script>
        function openBooking() { 
            const el = document.querySelector('[x-data]');
            if (el && el.__x) el.__x.$data.bookingOpen = true;
        }
        function openCart() { 
            const el = document.querySelector('[x-data]');
            if (el && el.__x) el.__x.$data.cartOpen = true;
        }
        function handleQuickBook() { openBooking(); }
        
        function showToast(msg, type = 'info') { 
            const container = document.getElementById('toast-container');
            if (!container) return;
            
            const toast = document.createElement('div');
            toast.className = `px-6 py-4 rounded-lg border shadow-lg transition-all duration-300 ${
                type === 'success' ? 'bg-green-900/90 border-green-700 text-green-100' :
                type === 'error' ? 'bg-red-900/90 border-red-700 text-red-100' :
                'bg-[var(--surface)] border-[var(--border)] text-[var(--text)]'
            }`;
            toast.textContent = msg;
            
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
        
        function addToCart(event, id) {
            event.preventDefault();
            event.stopPropagation();
            
            // Get cart from localStorage
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Add product to cart
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity = (existingItem.quantity || 1) + 1;
            } else {
                cart.push({ id, quantity: 1 });
            }
            
            // Save to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            
            // Update cart count badge
            const cartCount = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
            const badge = document.getElementById('cart-count');
            if (badge) badge.textContent = cartCount;
            
            showToast('Added product to cart', 'success');
        }
        
        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', () => {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const cartCount = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
            const badge = document.getElementById('cart-count');
            if (badge) badge.textContent = cartCount;
        });
    </script>
</body>
</html>
