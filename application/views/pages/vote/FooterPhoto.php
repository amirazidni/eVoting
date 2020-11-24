<button class="btn btn-large btn-primary" style="position: fixed; bottom: 10%; right: 3.5%;" type="button">Hubungi Operator</button>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script>
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

    function captureImage() {
        let img = document.createElement('img')
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
        img.src = canvas.toDataURL('image/png')
        document.body.appendChild(img)
    }
</script>

</html>