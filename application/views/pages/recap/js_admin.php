<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    $("#tbl_admin").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "order": [
        [0, "asc"]
      ],
      "processing": true,
      "serverSide": true,
      "ajax": {
        url: `<?= base_url('datarekap/get_data/select'); ?>`,
        type: "POST",
      },
      "columns": [{
          data: 'userId'
        },
        {
          data: "ipAddress"
        },
        {
          data: "nim"
        },
        {
          data: "nama"
        },
        {
          data: "kelas"
        },
        {
          data: "suara"
        },
        {
          data: "aktivasi",
          render: function(data, type, row) {
            if (data == 0 || data == null) {
              return `<span class="badge badge-pill badge-danger">Belum Teraktivasi</span>`;
            } else {
              return `<span class="badge badge-pill badge-success">Teraktivasi</span>`;
            }
          }
        },
        {
          data: "phone"
        },
        {
          data: "status",
          render: function(data, type, row) {
            if (data == 0 || data == null) {
              return `<span class="badge badge-pill badge-danger">Belum Valid</span>`;
            } else {
              return `<span class="badge badge-pill badge-success">Valid</span>`;
            }
          }
        },
        {
          data: "recap",
          render: function(data, type, row) {
            if (data == 0 || data == null) {
              return `<button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menkonfirmasi nim ${row.nim} untuk terverifikasi voting?');">Belum Terekap</button>`;
            } else {
              return `<button type="button" class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin menkonfirmasi nim ${row.nim} untuk tidak terverifikasi voting?');">Telah Terkap</button>`;
            }
          }
        }
      ]
    });
  });
</script>