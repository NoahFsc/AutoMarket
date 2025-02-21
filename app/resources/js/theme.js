document.addEventListener('DOMContentLoaded', function () {
    const theme = localStorage.getItem('theme');
    if (theme) {
        document.documentElement.setAttribute('data-theme', theme);
    }
});

document.addEventListener('livewire:load', function () {
    if (typeof Alpine === 'undefined') {
        let script = document.createElement('script');
        script.src = '//unpkg.com/alpinejs';
        script.defer = true;
        document.head.appendChild(script);
    }
});