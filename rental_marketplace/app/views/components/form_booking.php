<form action="<?= BASEURL; ?>/cart/add" method="POST" id="form_booking">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? ''; ?>">
    <input type="hidden" name="item_id" value="<?= $data['item']['id']; ?>">
    <input type="hidden" id="daily_price" value="<?= $data['item']['price_daily']; ?>">

    <?php $is_owner = (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $data['item']['owner_id']); ?>

    <?php if($is_owner): ?>
        <div class="alert alert-warning p-2 small mb-3 border-0">
            <i class="fas fa-exclamation-triangle text-dark"></i> <strong>Mode Pemilik:</strong> Blokir jadwal barang Anda sendiri.
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="start_date" class="form-label fw-semibold text-secondary">Tanggal Mulai</label>
        <input type="date" class="form-control" id="start_date" name="start_date" required min="<?= date('Y-m-d'); ?>">
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label fw-semibold text-secondary">Tanggal Selesai</label>
        <input type="date" class="form-control" id="end_date" name="end_date" required disabled>
    </div>

    <div id="price_summary" class="d-none bg-light border p-3 rounded mb-3">
        <div class="d-flex justify-content-between mb-1"><span class="text-muted small">Durasi Sewa:</span><span id="display_duration" class="fw-bold small">0 Hari</span></div>
        <div class="d-flex justify-content-between align-items-center"><span class="text-muted small">Total Tagihan:</span><span id="display_total" class="fw-bold text-brand fs-5">Rp 0</span></div>
        <div class="text-muted small mt-1">+ Biaya admin Rp 5.000</div>
    </div>

    <?php if($is_owner): ?>
        <div class="form-check mb-3 bg-light p-2 rounded border">
            <input class="form-check-input ms-1" type="checkbox" id="tnc_owner" required>
            <label class="form-check-label small text-muted ms-2" for="tnc_owner">Saya setuju dengan S&K Marketplace untuk penggunaan pribadi.</label>
        </div>
    <?php endif; ?>

    <div class="d-grid gap-2">
        <button type="submit" class="btn <?= $is_owner ? 'btn-warning text-dark' : 'btn-brand'; ?> fw-bold py-2" id="btn_submit" disabled>
            <i class="fas fa-cart-plus me-1"></i> <?= $is_owner ? 'Blokir Jadwal' : 'Masukkan Keranjang Sewa'; ?>
        </button>
        <?php if(!$is_owner): ?>
        <a href="<?= BASEURL; ?>/item/detail/<?= $data['item']['slug']; ?>" class="btn btn-outline-brand btn-sm">Beli Langsung (sewa)</a>
        <?php endif; ?>
    </div>
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const s = document.getElementById('start_date'), e = document.getElementById('end_date');
    const sum = document.getElementById('price_summary'), dur = document.getElementById('display_duration'), tot = document.getElementById('display_total');
    const btn = document.getElementById('btn_submit');
    const dp = parseFloat(document.getElementById('daily_price').value);
    const tnc = document.getElementById('tnc_owner');
    s.addEventListener('change', function(){ e.disabled=false; e.min=this.value; calc(); });
    e.addEventListener('change', calc);
    if(tnc) tnc.addEventListener('change', calc);
    function calc(){
        if(s.value && e.value){
            const d = Math.ceil((new Date(e.value)-new Date(s.value))/(86400000))+1;
            if(d>0){ const t=d*dp; dur.innerText=d+" Hari"; tot.innerText='Rp '+new Intl.NumberFormat('id-ID').format(t);
                sum.classList.remove('d-none');
                btn.disabled = (tnc && !tnc.checked);
            } else { sum.classList.add('d-none'); btn.disabled=true; }
        }
    }
});
</script>
