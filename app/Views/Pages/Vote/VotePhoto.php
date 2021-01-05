<?php $this->load->view('pages/vote/Header'); ?>
<?php $this->load->view('pages/vote/VoteStepper'); ?>

<style>
    .hidden {
        display: none !important;
    }
</style>


<div class="card mx-auto mb-3 mt-3 pt-2" style="max-width: 800px;">
    <h4 class="card-title text-center">Foto kamu dan kartu KTM mu</h4>
    <div class="card-body" id="body-inform">
        <p class="text-center mb-0">Foto digunakan untuk verifikasi saat dilakukan rekapitulasi</p>
        <p class="text-center mb-0">Pastikan foto yang diambil tidak rusak dan jelas</p>
        <p class="text-center mb-0">Foto yang rusak saat rekapitulasi berkemungkinan tidak dihitung</p>
        <p class="text-center mb-0">Jangan lupa untuk mengaktifkan dan mengizinkan akses kamera!</p>
        <p class="text-center mb-0">Refresh jika kamera tidak juga muncul!</p>

        <?php
        if (!$isMobile) {
        ?>
            <p class="text-center mt-3"><b>Anda tertedeksi menggunakan dekstop. Gunakan link <a onclick="window.open('<?= base_url('voter/insecureissues'); ?>')" style="color: blue;" class="pointer">INI</a> jika terhambat saat mengambil foto!</b></p>
            <button class="btn btn-primary mx-auto px-5 d-block mt-3" onclick="agreeCaptureImage()">Setuju</button>
        <?php
        }
        ?>
    </div>

    <?php
    if ($isMobile) {
    ?>
        <img style="width: 100%;" class="px-4" id="imgVoter">
        <form action="<?= base_url('voter/uploadPhotoMobile'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input accept="image/*" id="captureImageMobileId" type="file" name="image" capture="camera" hidden />
            <button type="button" class="btn btn-primary mx-auto d-block mt-3 mb-3" onclick="captureImageMobile()">Ambil Foto</button>
            <button class="btn hidden btn-success mx-auto d-block mt-3 mb-3" id="submitPhotoMobileId">Submit Foto</button>
        </form>
    <?php
    }
    ?>

    <video class="px-4 hidden" autoplay="true" id="video-webcam">
        Browser yang anda gunakan tidak support. Update terlebih dahulu browsermu!.
    </video>
    <button class="btn hidden btn-success mx-auto d-block mt-3 mb-3" id="button-video-webcam" onclick="captureImage()">Submit Foto</button>
</div>


<!-- MODAL For Error Upload -->
<div class="modal fade" id="errorUpload" tabindex="-1" role="dialog" aria-labelledby="errorUpload" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Error saat mencoba mengupload gambar.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script>
    $("#form-photo").submit(function(e) {
        e.preventDefault()
        captureImage()
    })

    <?php
    if ($isMobile) {
    ?>
        $('#captureImageMobileId').change(() => {
            $('#body-inform').addClass('hidden')
            $('#submitPhotoMobileId').removeClass('hidden')
            document.getElementById('imgVoter').src = window.URL.createObjectURL(this.event.target.files[0])
        })
    <?php
    }
    ?>

    function captureImageMobile() {
        $('#captureImageMobileId').click()
    }

    function agreeCaptureImage() {
        let videos = $('#video-webcam')
        videos.removeClass('hidden')

        // Get User Media
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia

        if (navigator.getUserMedia) {
            navigator.getUserMedia({
                video: true
            }, (stream) => {
                videos[0].srcObject = stream

                $('#button-video-webcam').removeClass('hidden')
                $('#body-inform').addClass('hidden')
            }, (err) => {
                videos.addClass('hidden')
                alert("Izinkan menggunakan kamera untuk melanjutkan voting!.\nLalu Refresh Halaman setelah mengizinkan akses kamera!.")
            })
        }
    }

    function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

        var blob = new Blob(byteArrays, {
            type: contentType
        });
        return blob;
    }

    function captureImage() {
        let video = $('#video-webcam')[0]

        // ambil ukuran video
        let width = video.offsetWidth
        let height = video.offsetHeight

        // buat elemen canvas
        canvas = document.createElement('canvas')
        canvas.width = width
        canvas.height = height

        // ambil gambar dari video dan masukan 
        // ke dalam canvas
        let context = canvas.getContext('2d')
        context.drawImage(video, 0, 0, width, height)

        // render hasil dari canvas ke elemen img
        let imageURL = canvas.toDataURL('image/png')

        // Form
        let block = imageURL.split(";")
        let contentType = block[0].split(":")[1]
        let realData = block[1].split(",")[1]

        // Convert it to a blob to upload
        let blob = b64toBlob(realData, contentType)

        // Create a FormData and append the file with "image" as parameter name
        let formData = new FormData()
        formData.append("image", blob)

        $.ajax({
            url: 'uploadPhoto',
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            error: function(err) {
                $('#errorUpload').modal('show')
            },
            success: function(data) {
                if (!data['ok']) {
                    $('#errorUpload').modal('show')
                } else {
                    location.reload()
                }
            },
        })
    }
</script>

<?php $this->load->view('pages/vote/Footer'); ?>