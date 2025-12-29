</div><!-- #content -->

    <footer id="colophon" class="site-footer bg-gray-900 text-white">
        
        <?php get_template_part('template-parts/footer/widgets'); ?>

        <?php get_template_part('template-parts/footer/copyright'); ?>

        <button id="back-to-top" 
                class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-white rounded-full shadow-lg opacity-0 pointer-events-none transition-all hover:scale-110 hover:bg-primary-dark z-40"
                aria-label="<?php esc_attr_e('Back to top', 'blaze'); ?>">
            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>

    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Back to Top Button
    const backToTop = document.getElementById('back-to-top');
    
    if (backToTop) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTop.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                backToTop.classList.add('opacity-0', 'pointer-events-none');
            }
        });
        
        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Sticky Header
    let lastScroll = 0;
    const header = document.getElementById('masthead');
    
    if (header) {
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > lastScroll && currentScroll > 100) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            
            lastScroll = currentScroll;
        });
    }

    // Dark Mode from localStorage
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    }
});
</script>

</body>
</html>