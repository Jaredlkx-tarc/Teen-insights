<script>
  const toggleBtn = document.querySelector('.sidebar-toggle');
  const sidebar = document.querySelector('nav.sidebar'); // more specific

  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('open');
    });
  }
</script>
