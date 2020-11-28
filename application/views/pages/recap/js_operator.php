<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    $("#tbl_operator").DataTable({
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
              return `<button type="button" class="btn btn-sm btn-danger">Belum Diaktivasi</button>`;
            } else {
              return `<button type="button" class="btn btn-sm btn-success">Telah Diaktivasi</button>`;
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
              return `<button type="button" class="btn btn-sm btn-danger">Belum Valid</button>`;
            } else {
              return `<button type="button" class="btn btn-sm btn-success">Valid</button>`;
            }
          }
        },
        {
          data: "recap",
          render: function(data, type, row) {
            if (data == 0 || data == null) {
              return `<button type="button" class="btn btn-sm btn-danger">Belum Terekap</button>`;
            } else {
              return `<button type="button" class="btn btn-sm btn-success">Telah Terekap</button>`;
            }
          }
        }
      ]
    });
  });
</script>