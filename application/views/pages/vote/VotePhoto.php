<style>
    .hidden {
        display: none !important;
    }
</style>

<div class="card mx-auto mb-3 mt-3 pt-2" style="max-width: 800px;">
    <h4 class="card-title text-center">Foto kamu atau kartu KTM mu</h4>
    <div class="card-body" id="body-inform">
        <p class="text-center mb-0">Foto digunakan untuk verifikasi saat dilakukan rekapitulasi</p>
        <p class="text-center mb-0">Pastikan foto yang diambil tidak rusak dan jelas</p>
        <p class="text-center mb-0">Foto yang rusak saat rekapitulasi berkemungkinan tidak dihitung</p>
        <p class="text-center mt-3"><b>Jangan lupa untuk mengaktifkan dan mengizinkan akses kamera!</b></p>
        <button class="btn btn-primary mx-auto px-5 d-block mt-3" onclick="agreeCaptureImage()">Setuju</button>
    </div>
    <video class="px-4 hidden" autoplay="true" id="video-webcam">
        Browser yang anda gunakan tidak support. Update terlebih dahulu browsermu!.
    </video>
    <button class="btn hidden btn-primary mx-auto d-block mt-3 mb-3" id="button-video-webcam" onclick="location.href='<?= base_url('voter/vote/4'); ?>'">Ambil Foto Sekarang</button>
    <!-- <button class="btn hidden btn-primary mx-auto d-block mt-3 mb-3" id="button-video-webcam" onclick="captureImage()">Ambil Foto Sekarang</button> -->
</div>