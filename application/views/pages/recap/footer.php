      </section>
      </div>

      <!--Modal Keluar -->
      <div class="modal fade" id="konfirmkeluar" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticModalLabel">Apakah anda yakin ingin keluar?</h5>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
              <form action="<?= site_url('welcome_admin/logout'); ?>">
                <input type="submit" class="btn btn-primary" value="Ya">
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
          <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
      </footer>
      </div>
      <!-- jQuery -->
      <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- DataTables -->
      <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <!-- AdminLTE App -->
      <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
      <?php

      print_r("VIEW");
      print_r($view);

      if ($view == 'admin') {
        $this->load->view('pages/recap/js_admin');
      } else if ($view == 'operator') {
        $this->load->view('pages/recap/js_operator');
      }
      ?>
      </body>

      </html>