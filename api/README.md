NOTE: databasenya ada yg beda antara native sama CI
aku belum cek yg versi CI DBnya kaya gimana, bawah ini masih DB versi native, sorry...

GET
1. Read tabel calon
    - utk halaman pemilihan tampil semua calon
    - parameter: (ga pake karena tampil semua)
    - struktur JSON:
        - records
            - nomor_urut
            - nama1
            - nama2
            - foto
            - vote
            - visi_misi
    - address: evoting/api/calon/read.php

2. Read tabel pemilih
    - utk halaman login pemilih cek nama dan status aktivasi
    - parameter: nim
    - struktur JSON:
        - nim
        - nama
        - kelas
        - nomor_urut
        - status
    - address: evoting/api/pemilih/read_one.php

3. Read tabel pilihan
    - utk halaman proses pemilihan, mengecek apakah suara sudah masuk atau belum
    - parameter: nim
    - struktur JSON:
        - nim
    - address: evoting/api/pilihan/read.php

POST
4. Update
    - utk update ke tabel pilihan dan tabel calon setelah pemilihan berhasil
    - parameter: none
    - struktur JSON yg dikirim:
        - nim
        - nomor_urut
        - vote
    - address: evoting/api/pemilih/update.php


Footnote:
yg di folder object itu object semua tabel
yg di folder config itu koneksi (bisa diganti pakai koneksi yg udah dipasang di CI)
yg di folder contoh_api_client itu contoh akses API server dari client (PHP)
