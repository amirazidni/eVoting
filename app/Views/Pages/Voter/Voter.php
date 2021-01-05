<?= $this->extend('Layout/Template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="row mb-2">
            <div class="col-12 d-flex">
                <div style="flex-grow: 1;"></div>
                <a type="button" class="ml-2 btn btn-info" href="<?= base_url('voter/templateExcel') ?>">
                    <i class="fa fa-file"></i>
                    Download Template Excel
                </a>
                <button type="button" class="ml-2 btn btn-success" data-toggle="modal" data-target="#importVoter">
                    <i class="fa fa-envelope"></i>
                    Import Data Excel
                </button>
                <a class="ml-2 btn btn-primary" href="<?= base_url('voter/create') ?>">
                    <i class="fa fa-plus"></i>
                    Tambah Pemilih
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <button class="btn btn-primary mb-2" type="button" onclick="checkValidVoter()">Cek kelengkapan surat suara</button>
                <!-- <div class="row mb-2">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="selection" class="form-control-label" style="padding-top: 8px;">Vote Type</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control" id="selection" required>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> -->
                <table class="w-100 table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Pemilih</th>
                            <th>Kelas</th>
                            <th>Surat Suara</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Import Voter -->
<div class="modal fade" id="importVoter" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Pemilih</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Voter/import') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-12 col-sm-12 col-md-3 col-xl-3">
                            <label for="upload_excel" class="form-control-label">Upload file excel</label>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-xl-9">
                            <input type="file" id="upload_excel" name="dataExcel" placeholder="Pilih file" class="form-control" accept=".xls, .xlsx" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_upload">Upload Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<!-- SCRIPT -->
<?= $this->section('script'); ?>

<script>
    $(document).ready(() => {
        $(".table").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            responsive: true,
            // "order": [
            //     [0, "asc"]
            // ],
            processing: true,
            serverSide: true,
            ajax: {
                url: `<?= base_url('voter/getsPaged'); ?>`,
                type: "POST",
            },
            "columns": [{
                data: "nim"
            }, {
                data: "name"
            }, {
                data: "class"
            }, {
                data: 'votetypes',
                render: function(data, type, row) {
                    let types = row.votetypes.split(',')
                    return (types.slice(0, 3)).join(',') + " ..."
                }
            }, {
                data: "action",
                orderable: false,
                render: function(data, type, row) {
                    const btnEdit = `
                    <a class="btn btn-success" href="<?= base_url('voter/update?voterId=') ?>${row.id}">
                        <i class="fa fa-edit"></i>
                        Edit
                    </a>`
                    const btnRemove = `
                    <a class="btn btn-danger ml-2" href="<?= base_url('/voter/deleteAction?voterId='); ?>${row.id}" onclick="return confirm('Yakin ingin menghapus pemilih dengan nim ${row.nim}?');">
                        <i class="fa fa-trash"></i>
                        Hapus
                    </a>`

                    return `${btnEdit}${btnRemove}`;
                },
            }]
        })
    })

    function checkValidVoter() {
        let startTime = (new Date()).getTime()
        $('#loadingModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        })
        $.get('<?= base_url('voter/checkValid') ?>', async (data) => {
            let endTime = (new Date()).getTime()
            let diff = endTime - startTime

            if (diff < 750) {
                await new Promise(r => setTimeout(r, 750 - diff));
            }

            $('#loadingModal').modal('hide')
            $('#infoDetailModal').empty()
            data = JSON.parse(data)

            if (data.count == 0) {
                $('#infoContentModal').text('Semua surat suara lengkap')
            } else {
                $('#infoContentModal').text(`Terdapat ${data.count} pemilih yang surat suaranya belum lengkap`)

                data.data.forEach(item => {
                    let elem = `<div>${item.nim} ${item.name} jumlah surat suara ${item.voteCount}</div>`
                    $('#infoDetailModal').append(elem)
                })
            }

            $('#infoModal').modal('show')
        })
    }
</script>

<?= $this->endSection(); ?>