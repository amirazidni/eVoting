<?php defined('BASEPATH') or exit('No direct script access allowed');

class Datarekap extends CI_Controller
{
  private $session_id;

  public function __construct()
  {
    parent::__construct();
    $this->session_id = $this->session->userdata();
  }

  public function index()
  {
    $status_id = $this->session_id['status'];
    if ($status_id == "loginadmin") {
      return redirect(base_url('operator'));
    }

    if ($status_id == "loginoperator") {
      return redirect(base_url('operator'));
    }

    redirect('welcome_admin');
  }

  public function get_data($data = "select")
  {
    $status_id = $this->session_id['status'];
    if ($status_id == "loginadmin" || $status_id == "operator") {
      if ($data == "select") {
        $this->select();
      } else if ($data == "update") {
        $this->update();
      }
    } else {
      redirect('welcome_admin');
    }
  }

  // private function view_admin()
  // {
  //   $this->load->view('pages/recap/view_admin', ['view' => 'admin']);
  // }

  // private function view_operator()
  // {
  //   $this->load->view('pages/recap/view_operator', ['view' => 'operator']);
  // }

  private function select()
  {
    $query = "SELECT 
      tbl_vote.*, 
      pemilih.nim, 
      pemilih.nama, 
      pemilih.kelas, 
      pemilih.suara, 
      pemilih.aktivasi 
    FROM tbl_vote LEFT JOIN pemilih ON tbl_vote.userId = pemilih.id";
    $search = ['ipAddress', 'userId', 'phone', 'status', 'recap', 'nama', 'nim', 'kelas'];
    $data = $this->db_select_all($query, $search);
    header('Content-type: application/json');
    echo $data;
  }

  private function update()
  {
  }

  private function db_select_all($query, $cari)
  {
    // Ambil data yang di ketik user pada textbox pencarian
    $search = preg_replace("/[^a-zA-Z0-9.]/", ' ', "{$_POST['search']['value']}");

    // Ambil data limit per page
    $limit = preg_replace("/[^a-zA-Z0-9.]/", ' ', "{$_POST['length']}");

    // Ambil data start
    $start = preg_replace("/[^a-zA-Z0-9.]/", ' ', "{$_POST['start']}");
    $sql = $this->db->query($query);
    $sql_count = $sql->num_rows();
    $cari = implode(" LIKE '%" . $search . "%' OR ", $cari) . " LIKE '%" . $search . "%'";

    // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $order_field = $_POST['order'][0]['column'];

    // Untuk menentukan order by "ASC" atau "DESC"
    $order_ascdesc = $_POST['order'][0]['dir'];
    $order = " ORDER BY " . $_POST['columns'][$order_field]['data'] . " " . $order_ascdesc;
    $sql_data = $this->db->query($query . " WHERE (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
    $sql_filter = $this->db->query($query);
    $sql_filter_count = $sql_filter->num_rows();
    $data = $sql_data->result_array();
    $callback = array(
      'draw' => $_POST['draw'], // Ini dari datatablenya    
      'recordsTotal' => $sql_count,
      'recordsFiltered' => $sql_filter_count,
      'data' => $data
    );
    return json_encode($callback, true); // Convert array $callback ke json
  }
}
