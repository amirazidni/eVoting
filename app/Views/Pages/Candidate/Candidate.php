<?= $this->extend('Layout/Template'); ?>

<?= $this->section('content'); ?>

<div class="mb-2">
    <div class="d-flex">
        <div style="flex-grow: 1;"></div>
        <!-- <a type="button" class="ml-2 btn btn-info" href="<?= base_url('candidate/templateExcel') ?>">
                    <i class="fa fa-file"></i>
                    Download Template Excel
                </a>
                <button type="button" class="ml-2 btn btn-success" data-toggle="modal" data-target="#importVoter">
                    <i class="fa fa-envelope"></i>
                    Import Data Excel
                </button> -->
        <a class="ml-2 btn btn-primary" href="<?= base_url('candidate/create') ?>">
            <i class="fa fa-plus"></i>
            Tambah Calon
        </a>
    </div>
</div>
<div class="card">
    <div class="card-body table-responsive">
        <table id="example1" class="w-100 table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No. Urut</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Tipe Suara</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item) { ?>
                    <tr>
                        <td><?= $item['candidateOrder'] ?></td>
                        <td><?= strlen($item['name']) >= 32 ? substr($item['name'], 0, 28) . ' ...' : $item['name'] ?></td>
                        <td><?= strlen($item['description']) >= 32 ? substr($item['description'], 0, 28) . ' ...' : $item['description'] ?></td>
                        <td><?= $item['voteTypeName'] ?></td>
                        <td>
                            <a class="btn btn-sm btn-info text-white" onclick="onShowPhoto(this)" data-photoName="<?= $item['photoName'] ?>">
                                Lihat Foto
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success text-white" onclick="onShowDetail(this)" data-photoName="<?= $item['photoName'] ?>" data-name="<?= $item['name'] ?>" data-description="<?= $item['description'] ?>" data-voteTypeName="<?= $item['voteTypeName'] ?>">
                                <i class="fas fa-eye"></i>
                                <span>Detail</span>
                            </a>
                            <a class="btn btn-sm btn-primary" href="<?= base_url('candidate/update?candidateId=' . $item['id']) ?>">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <a class="btn btn-sm btn-danger" href="<?= base_url('candidate/delete?candidateId=' . $item['id']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus nomor urut <?= $item['candidateOrder'] ?> ?');">
                                <i class="fa fa-trash"></i>
                                <span>Hapus</span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<?= $this->endSection(); ?>


<!-- SCRIPT -->
<?= $this->section('script'); ?>

<script>
    let photoDetail = $('#photoDetail')
    let photoModal = $('#photoDetailModal')

    $(document).ready(() => {
        $(".table").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            responsive: true,
            "order": [
                [3, "asc"],
                [0, "asc"]
            ],
            processing: true,
            serverSide: false,
        })
    })

    function onShowPhoto(event) {
        let photoPath = '<?= base_url('assets/candidate') ?>' + '/' + $(event).data('photoname')

        photoDetail.attr('src', photoPath)
        photoModal.modal('show')
    }

    function onShowDetail(e) {
        let elem = $(e)
        let description = elem.data('description')
        let name = elem.data('name')
        let voteTypeName = elem.data('votetypename')
        let photoName = elem.data('photoname')
        let photoPath = '<?= base_url('assets/candidate') ?>' + '/' + photoName

        let newElem = `
        <img width="100%" src="${photoPath}">
        <table class="mt-2">
            <thead>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td style="vertical-align:top">Nama</td>
                    <td style="width: 16px; font-weight: 700;vertical-align:top;">:</td>
                    <td><pre>${name}</pre></td>
                </tr>
                <tr>
                    <td>Tipe Suara</td>
                    <td style="width: 16px; font-weight: 700;">:</td>
                    <td>${voteTypeName}</td>
                </tr>
                <tr>
                    <td style="vertical-align:top">Deskripsi</td>
                    <td style="width: 16px; font-weight: 700;vertical-align:top">:</td>
                    <td><pre>${description}</pre></td>
                </tr>
            </tbody>
        </table>
        `

        $('#infoDetailModal').empty()
        $('#infoDetailModal').append(newElem)
        $('#infoContentModal').text('')
        $('#infoModal').modal('show')
    }
</script>

<?= $this->endSection(); ?>