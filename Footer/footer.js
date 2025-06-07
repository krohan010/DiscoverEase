<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Thank you for subscribing!');
        form.reset();
    });
</script>
