</div><!-- /.container -->

<footer class="site-footer mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="nav-logo fs-4 mb-2"><i class="fas fa-box-open me-1"></i>RentalMarket</div>
                <p class="small mb-3">Platform sewa barang P2P terpercaya di Indonesia. Sewa alat foto, outdoor, kendaraan, dan lainnya dengan mudah, aman, dan terjangkau.</p>
                <div class="d-flex gap-2">
                    <a href="#" class="nav-icon" style="background:rgba(255,255,255,.1);color:#fff;"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="nav-icon" style="background:rgba(255,255,255,.1);color:#fff;"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="nav-icon" style="background:rgba(255,255,255,.1);color:#fff;"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <h6>Belanja</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="<?= BASEURL; ?>/home/explore">Katalog Barang</a></li>
                    <li class="mb-2"><a href="<?= BASEURL; ?>/home/explore?category=1">Kamera & Lensa</a></li>
                    <li class="mb-2"><a href="<?= BASEURL; ?>/home/explore?category=2">Peralatan Camping</a></li>
                    <li class="mb-2"><a href="<?= BASEURL; ?>/home/explore?category=3">Kendaraan</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <h6>Penyedia</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="<?= BASEURL; ?>/useritem/create">Pasang Iklan</a></li>
                    <li class="mb-2"><a href="<?= BASEURL; ?>/useritem/index">Kelola Barang</a></li>
                    <li class="mb-2"><a href="<?= BASEURL; ?>/user/dashboard">Dashboard</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <h6>Bantuan</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#">Cara Sewa</a></li>
                    <li class="mb-2"><a href="#">Syarat & Ketentuan</a></li>
                    <li class="mb-2"><a href="#">Kebijakan Privasi</a></li>
                    <li class="mb-2"><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <h6>Kontak</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><i class="fas fa-envelope me-1"></i> halo@rentalmarket.id</li>
                    <li class="mb-2"><i class="fas fa-phone me-1"></i> 0800-123-456</li>
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-1"></i> Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,.12);">
        <div class="d-flex flex-wrap justify-content-between small">
            <span>&copy; <?= date('Y'); ?> RentalMarket. All rights reserved.</span>
            <span>Metode pembayaran: <i class="fab fa-cc-visa me-1"></i><i class="fab fa-cc-mastercard me-1"></i> BCA &middot; Mandiri &middot; GoPay &middot; OVO</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.fav').forEach(function(btn){
    btn.addEventListener('click', function(){
        var id = btn.getAttribute('data-item');
        if(!id) return;
        fetch('<?= BASEURL; ?>/item/toggle_wishlist', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'item_id='+id})
        .then(r=>r.json()).then(res=>{
            if(res.status==='success'){
                var on = res.action==='added';
                btn.innerHTML = on ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>';
                btn.style.color = on ? '#ef4444' : '#ef4444';
            } else if(res.status==='error'){ window.location.href='<?= BASEURL; ?>/auth/login'; }
        }).catch(()=>{});
    });
});
</script>
</body>
</html>
