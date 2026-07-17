</div> <!-- Penutup dari <div class="p-4 flex-grow-1"> -->
    </div> <!-- Penutup dari <div id="main-content"> -->
</div> <!-- Penutup dari <div class="d-flex"> -->

<!-- Script Javascript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script Pintar: Otomatis mendeteksi menu aktif berdasarkan URL -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentUrl = window.location.href;
        const menuLinks = document.querySelectorAll('.menu-link');
        
        menuLinks.forEach(link => {
            // Jika URL saat ini cocok dengan link di sidebar, nyalakan warnanya
            if(currentUrl.includes(link.getAttribute('href'))) {
                link.classList.add('active');
            }
        });
    });
</script>
</body>
</html>