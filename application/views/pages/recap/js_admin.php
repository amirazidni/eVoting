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
          data: "nim"
        },
        {
          data: "nama"
        },
        {
          data: "kelas"
        }
      ]
    });
  });
</script>