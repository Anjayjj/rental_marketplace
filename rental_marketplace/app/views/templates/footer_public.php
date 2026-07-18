</div><!-- /.container -->

<footer class="site-footer mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="nav-logo fs-4 mb-2"><i class="fas fa-box-open me-1"></i>RentalMarket</div>
                <p class="small mb-3">Platform sewa barang P2P terpercaya di Indonesia. Sewa alat foto, outdoor, kendaraan, dan lainnya dengan mudah, aman, dan terjangkau.</p>
                <div class="footer-social d-flex gap-2">
                    <a href="#" class="nav-icon" style="background:rgba(255,255,255,.1);color:#fff;"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="nav-icon" style="background:rgba(255,255,255,.1);color:#fff;"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="nav-icon" style="background:rgba(255,255,255,.1);color:#fff;"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="nav-icon" style="background:rgba(255,255,255,.1);color:#fff;"><i class="fab fa-youtube"></i></a>
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
                    <li class="mb-2"><a href="<?= BASEURL; ?>/home/explore">Cara Sewa</a></li>
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

<!-- Toast stack + scroll top -->
<div class="toast-stack" id="toastStack"></div>
<button class="scroll-top" id="scrollTop" aria-label="Ke atas"><i class="fas fa-arrow-up"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* Navbar scrolled shadow */
window.addEventListener('scroll', function(){
    var n = document.querySelector('.site-nav'); if(n) n.classList.toggle('scrolled', window.scrollY > 8);
    var st = document.getElementById('scrollTop'); if(st) st.classList.toggle('show', window.scrollY > 320);
});
document.getElementById('scrollTop')?.addEventListener('click', function(){ window.scrollTo({top:0, behavior:'smooth'}); });
/* Reveal on scroll */
var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){ if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); } });
}, {threshold:.12});
document.querySelectorAll('.reveal').forEach(function(el){ io.observe(el); });
/* Toast helper */
function rmToast(msg, type){
    type = type || 'info';
    var stack = document.getElementById('toastStack');
    var icons = {success:'fa-check', error:'fa-times', info:'fa-info'};
    var el = document.createElement('div');
    el.className = 'rm-toast ' + type;
    el.innerHTML = '<div class="ic"><i class="fas '+icons[type]+'"></i></div><div><div style="font-weight:700">'+msg+'</div></div>';
    stack.appendChild(el);
    setTimeout(function(){ el.style.opacity='0'; el.style.transform='translateX(120%)'; setTimeout(function(){ el.remove(); }, 300); }, 2800);
}
/* Wishlist toggle */
document.querySelectorAll('.fav').forEach(function(btn){
    btn.addEventListener('click', function(e){
        e.preventDefault();
        var id = btn.getAttribute('data-item');
        if(!id) return;
        fetch('<?= BASEURL; ?>/item/toggle_wishlist', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'item_id='+id})
        .then(function(r){ return r.json(); }).then(function(res){
            if(res.status==='success'){
                var on = res.action==='added';
                btn.classList.toggle('active', on);
                btn.innerHTML = on ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>';
                rmToast(on ? 'Ditambahkan ke wishlist' : 'Dihapus dari wishlist', 'success');
            } else if(res.status==='error'){ window.location.href='<?= BASEURL; ?>/auth/login'; }
        }).catch(function(){});
    });
});
</script>
</body>
</html>
