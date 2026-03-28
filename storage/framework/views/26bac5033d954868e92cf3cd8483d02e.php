# <?php echo e($identity->get('brand_name', 'AURUM')); ?>


## About
<?php echo e($identity->get('tagline', 'Luxury Unisex Salon & Spa')); ?>


<?php if($seo && $seo->llm_summary): ?>
<?php echo e($seo->llm_summary); ?>

<?php else: ?>
<?php echo e($seo->description ?? 'Premium salon and spa services in ' . $identity->get('city', 'Gurugram')); ?>

<?php endif; ?>

## Contact
- Location: <?php echo e($identity->get('address', '')); ?>, <?php echo e($identity->get('city', 'Gurugram')); ?>

- Phone: <?php echo e($identity->get('phone', '')); ?>

- Email: <?php echo e($identity->get('email', '')); ?>


## Services
We offer luxury salon and spa services including haircare, skincare, massage therapy, and wellness treatments.

<?php if($seo && $seo->llm_keywords): ?>
## Keywords
<?php echo e($seo->llm_keywords); ?>

<?php endif; ?>

## Social Media
<?php if($identity->get('social_instagram')): ?>
- Instagram: <?php echo e($identity->get('social_instagram')); ?>

<?php endif; ?>
<?php if($identity->get('social_facebook')): ?>
- Facebook: <?php echo e($identity->get('social_facebook')); ?>

<?php endif; ?>
<?php if($identity->get('social_twitter')): ?>
- Twitter: <?php echo e($identity->get('social_twitter')); ?>

<?php endif; ?>

---
This content is optimized for LLM indexing and summarization.
<?php /**PATH C:\Users\akm96\Downloads\New folder (5)\aurum\resources\views/llms.blade.php ENDPATH**/ ?>