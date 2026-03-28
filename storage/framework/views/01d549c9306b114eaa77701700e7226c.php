<?php
$rituals = [
  ['name'=>'The Gold Leaf Ritual','tag'=>'Signature','duration'=>'120 min','price'=>'₹12,000','desc'=>'24-karat gold-infused facial + scalp therapy + champagne welcome.','emoji'=>'🥂'],
  ['name'=>'Himalayan Salt Journey','tag'=>'Wellness','duration'=>'90 min','price'=>'₹8,500','desc'=>'Detoxifying salt cave exfoliation followed by deep-tissue massage.','emoji'=>'🏔️'],
  ['name'=>'Midnight Orchid Ritual','tag'=>'Exclusive','duration'=>'150 min','price'=>'₹18,000','desc'=>'Black orchid body wrap, hot stone therapy & luxury hair masque.','emoji'=>'🌙'],
];
?>

<?php if (isset($component)) { $__componentOriginal61141943053f09b1aa6378714ef2c661 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal61141943053f09b1aa6378714ef2c661 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.front-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('front-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal04f02f1e0f152287a127192de01fe241 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal04f02f1e0f152287a127192de01fe241 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.hero','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $attributes = $__attributesOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__attributesOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal04f02f1e0f152287a127192de01fe241)): ?>
<?php $component = $__componentOriginal04f02f1e0f152287a127192de01fe241; ?>
<?php unset($__componentOriginal04f02f1e0f152287a127192de01fe241); ?>
<?php endif; ?>
    
    <!-- Quick Book Section -->
    <section id="quick-book" class="py-8 bg-[var(--surface)] border-y border-[var(--border)] relative z-20">
      <div class="container mx-auto px-6 max-w-[1280px]">
        <div class="flex flex-wrap items-center gap-4 justify-between">
          <select class="bg-[var(--surface-alt)] border border-[var(--border)] text-[var(--text)] py-3 px-4 rounded-[var(--radius-md)] font-sans text-[14px] flex-1 min-w-[150px] outline-none transition-colors duration-200 focus:border-[var(--gold)] cursor-pointer">
            <option value="">Select Service</option>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($s->id); ?>"><?php echo e($s->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <select class="bg-[var(--surface-alt)] border border-[var(--border)] text-[var(--text)] py-3 px-4 rounded-[var(--radius-md)] font-sans text-[14px] flex-1 min-w-[150px] outline-none transition-colors duration-200 focus:border-[var(--gold)] cursor-pointer">
            <option value="">Select Therapist</option>
            <?php $__currentLoopData = $therapists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($t->id); ?>"><?php echo e($t->user->name ?? 'Specialist'); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <input type="date" class="bg-[var(--surface-alt)] border border-[var(--border)] text-[var(--text)] py-3 px-4 rounded-[var(--radius-md)] font-sans text-[14px] flex-1 min-w-[150px] outline-none transition-colors duration-200 focus:border-[var(--gold)] cursor-pointer" style="color-scheme: dark;">
          <select class="bg-[var(--surface-alt)] border border-[var(--border)] text-[var(--text)] py-3 px-4 rounded-[var(--radius-md)] font-sans text-[14px] flex-1 min-w-[150px] outline-none transition-colors duration-200 focus:border-[var(--gold)] cursor-pointer">
            <option value="">Select Time</option>
            <option>10:00 AM</option>
            <option>11:30 AM</option>
            <option>01:00 PM</option>
            <option>02:30 PM</option>
            <option>04:00 PM</option>
          </select>
          <button class="btn btn-primary whitespace-nowrap" onclick="handleQuickBook()">Check Availability</button>
        </div>
      </div>
    </section>

    <!-- Category Sections (Dynamic) -->
    <?php $__currentLoopData = $categorySections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($section->is_visible): ?>
        <?php echo $__env->make("partials.category-sections._{$section->layout}", ['section' => $section], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Services Section -->
    <section id="services" class="py-24 bg-[var(--bg)]">
      <div class="container mx-auto px-6 max-w-[1280px]">
        <div class="mb-12 text-center">
            <span class="text-[12px] tracking-[.25em] text-[var(--gold)] uppercase mb-4 inline-block">The Classics</span>
            <h2 class="h2 font-serif">Curated Services</h2>
        </div>
        
        <div class="flex justify-center flex-wrap gap-4 mb-12">
            <button class="px-6 py-2 border border-[var(--gold)] text-[var(--gold)] rounded-full text-[13px] tracking-wide bg-[rgba(200,168,93,.06)]">All</button>
            <button class="px-6 py-2 border border-[var(--border)] text-[var(--muted)] rounded-full text-[13px] tracking-wide hover:border-[var(--gold)] transition-colors">Hair</button>
            <button class="px-6 py-2 border border-[var(--border)] text-[var(--muted)] rounded-full text-[13px] tracking-wide hover:border-[var(--gold)] transition-colors">Skin</button>
            <button class="px-6 py-2 border border-[var(--border)] text-[var(--muted)] rounded-full text-[13px] tracking-wide hover:border-[var(--gold)] transition-colors">Body</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginale804957ecdb153e8c822de5ed47a4ace = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale804957ecdb153e8c822de5ed47a4ace = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.service-card','data' => ['service' => $service]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('service-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['service' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($service)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale804957ecdb153e8c822de5ed47a4ace)): ?>
<?php $attributes = $__attributesOriginale804957ecdb153e8c822de5ed47a4ace; ?>
<?php unset($__attributesOriginale804957ecdb153e8c822de5ed47a4ace); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale804957ecdb153e8c822de5ed47a4ace)): ?>
<?php $component = $__componentOriginale804957ecdb153e8c822de5ed47a4ace; ?>
<?php unset($__componentOriginale804957ecdb153e8c822de5ed47a4ace); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>

    <!-- Rituals Section -->
    <section id="rituals" class="py-24 bg-[var(--surface)] text-center">
      <div class="container mx-auto px-6 max-w-[1280px]">
        <div class="mb-12">
            <span class="text-[12px] tracking-[.25em] text-[var(--gold)] uppercase mb-4 inline-block">Immersive Experiences</span>
            <h2 class="h2 font-serif">Signature Rituals</h2>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-left">
            <?php $__currentLoopData = $rituals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ritual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-[var(--surface-alt)] rounded-[var(--radius-lg)] overflow-hidden border border-[var(--border)] flex flex-col group transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
                <div class="h-[220px] bg-gradient-to-br from-[var(--surface-alt)] to-[var(--bg)] flex items-center justify-center text-[4rem] group-hover:scale-110 transition-transform duration-500">
                    <?php echo e($ritual['emoji']); ?>

                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-[var(--bg)] border border-[var(--gold)] text-[var(--gold)] text-[11px] uppercase tracking-wider rounded-md"><?php echo e($ritual['tag']); ?></span>
                        <span class="text-[var(--muted)] text-[13px]"><?php echo e($ritual['duration']); ?></span>
                    </div>
                    <h3 class="h3 font-serif mb-3"><?php echo e($ritual['name']); ?></h3>
                    <p class="text-[var(--muted)] text-[14px] leading-relaxed mb-6"><?php echo e($ritual['desc']); ?></p>
                    <div class="mt-auto flex justify-between items-center">
                        <button class="btn btn-primary" onclick="openBooking()">Book Ritual</button>
                        <span class="font-serif text-[1.4rem] text-[var(--gold)]"><?php echo e($ritual['price']); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>

    <!-- Therapists Section -->
    <section id="therapists" class="py-24 bg-[var(--bg)]">
        <div class="container mx-auto px-6 max-w-[1280px]">
            <div class="mb-12 text-center">
                <span class="text-[12px] tracking-[.25em] text-[var(--gold)] uppercase mb-4 inline-block">The Artisans</span>
                <h2 class="h2 font-serif">Meet Our Therapists</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $therapists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $therapist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal457080b6bd17f70e0110fbd317b5f2f2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal457080b6bd17f70e0110fbd317b5f2f2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.therapist-card','data' => ['therapist' => $therapist]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('therapist-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['therapist' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($therapist)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal457080b6bd17f70e0110fbd317b5f2f2)): ?>
<?php $attributes = $__attributesOriginal457080b6bd17f70e0110fbd317b5f2f2; ?>
<?php unset($__attributesOriginal457080b6bd17f70e0110fbd317b5f2f2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal457080b6bd17f70e0110fbd317b5f2f2)): ?>
<?php $component = $__componentOriginal457080b6bd17f70e0110fbd317b5f2f2; ?>
<?php unset($__componentOriginal457080b6bd17f70e0110fbd317b5f2f2); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Boutique Section -->
    <section id="boutique" class="py-24 bg-[var(--surface)]">
        <div class="container mx-auto px-6 max-w-[1280px]">
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
                <div>
                    <span class="text-[12px] tracking-[.25em] text-[var(--gold)] uppercase mb-4 inline-block">At Home Care</span>
                    <h2 class="h2 font-serif">The AURUM Boutique</h2>
                </div>
                <a href="/shop" class="btn btn-ghost">View Full Catalogue</a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $attributes = $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $component = $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Offers Section -->
    <section id="offers" class="py-24 bg-[var(--bg)]">
        <div class="container mx-auto px-6 max-w-[1280px]">
            <div class="mb-12 text-center">
                <span class="text-[12px] tracking-[.25em] text-[var(--gold)] uppercase mb-4 inline-block">Exclusive Privileges</span>
                <h2 class="h2 font-serif">Current Offers</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="relative bg-[var(--surface)] p-8 rounded-[var(--radius-lg)] border border-[var(--border)] overflow-hidden">
                    <!-- Decor element -->
                    <div class="absolute -top-[10px] -right-[10px] w-12 h-12 bg-gradient-to-br from-[var(--gold)] to-[var(--gold-light)] opacity-20 rotate-45"></div>
                    
                    <span class="text-[11px] tracking-[.15em] text-[var(--gold)] uppercase"><?php echo e($offer->title); ?></span>
                    <div class="font-serif text-[2.5rem] mt-2 mb-4 leading-none"><?php echo e($offer->discount_percentage); ?>% OFF</div>
                    <div class="text-[12px] text-[var(--muted)] mb-4 flex items-center gap-2"><span>🗓️</span> <?php echo e(Carbon\Carbon::parse($offer->valid_until)->format('j M Y')); ?></div>
                    
                    <div class="flex items-center gap-4 bg-[var(--surface-alt)] p-3 rounded-[var(--radius-md)] border border-[var(--border)] justify-between">
                        <code class="text-[var(--gold)] tracking-widest"><?php echo e($offer->discount_code); ?></code>
                        <button class="btn btn-outline py-2 px-4 text-[11px]" onclick="navigator.clipboard.writeText('<?php echo e($offer->discount_code); ?>'); alert('Copied!');">Copy</button>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal61141943053f09b1aa6378714ef2c661)): ?>
<?php $attributes = $__attributesOriginal61141943053f09b1aa6378714ef2c661; ?>
<?php unset($__attributesOriginal61141943053f09b1aa6378714ef2c661); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal61141943053f09b1aa6378714ef2c661)): ?>
<?php $component = $__componentOriginal61141943053f09b1aa6378714ef2c661; ?>
<?php unset($__componentOriginal61141943053f09b1aa6378714ef2c661); ?>
<?php endif; ?>
<?php /**PATH C:\Users\akm96\Downloads\New folder (5)\aurum\resources\views/welcome.blade.php ENDPATH**/ ?>