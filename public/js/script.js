// Basic JavaScript untuk aplikasi
document.addEventListener('DOMContentLoaded', function() {
    console.log('Smartphone Recommendation App loaded');
    
    // Function untuk smooth scroll
    function smoothScroll(target) {
        document.querySelector(target).scrollIntoView({
            behavior: 'smooth'
        });
    }
    
    // Function untuk show/hide loading
    function showLoading() {
        document.body.style.cursor = 'wait';
    }
    
    function hideLoading() {
        document.body.style.cursor = 'default';
    }
    
    // Global functions
    window.showLoading = showLoading;
    window.hideLoading = hideLoading;
    window.smoothScroll = smoothScroll;
});