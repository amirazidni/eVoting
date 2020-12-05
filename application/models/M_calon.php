<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_calon extends CI_Model
{

	private $_table = "calon";

	public $id;
	public $nomorurut;
	public $nama1;
	public $nama2;
	public $visi;
	public $misi;
	public $foto = "default.jpg";
	private $delete_at;

	public function __construct()
	{
		$this->delete_at = date('Y-m-d H:i:s');
	}

	public function gets()
	{
		return $this->db->from('calon')->get()->result_array();
	}

	public function getsCadidate()
	{
		$res = $this->db->from('calon')->get()->result_array();
		return $res;
	}

	public function getCount()
	{
		$res = $this->db->query('select count(id) as count from calon')->result();
		return $res[0]->count;
	}

	function jumlah_calon()
	{

		$totalcalon = $this->db->query("SELECT * FROM calon WHERE delete_at IS NULL");
		if ($totalcalon->num_rows() > 0) {
			return $totalcalon->num_rows();
		} else {
			return 0;
		}
	}

	function show_calon($where = null)
	{
		if ($where == null) {
			$hasil = $this->db->query("SELECT * FROM calon WHERE delete_at IS NULL");
			return $hasil;
		} else {
			$hasil = $this->db->get_where('calon', ['id' => $where, 'delete_at' => null])->row_array();
			return $hasil;
		}
	}

	public function insert_data()
	{
		$this->id = (new DateTime('now', null))->format('YmdHis');
		$data = [
			'id' 		=> $this->id,
			'nomorurut'	=> $this->db->escape_str($this->input->post('nomorurut', true)),
			'nama1'		=> $this->db->escape_str($this->input->post('nama1', true)),
			'nama2'		=> $this->db->escape_str($this->input->post('nama2', true)),
			'visi'		=> $this->db->escape_str($this->input->post('visi', true)),
			'misi'		=> $this->db->escape_str($this->input->post('misi', true)),
			'foto'		=> $this->_uploadImage()
		];
		// $post = $this->input->post();
		// $this->id = uniqid();
		// $this->nomorurut = $post["nomorurut"];
		// $this->nama1 = $post["nama1"];
		// $this->nama2 = $post["nama2"];
		// $this->visi = $post["visi"];
		// $this->misi = $post["misi"];
		// $this->foto = $this->_uploadImage();
		$this->db->insert('calon', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletecalon($id)
	{
		$hasil = $this->db->query("SELECT *  FROM pemilih WHERE delete_at IS NULL");
		foreach ($hasil->result_array() as $i) :
			$r = $i['id'];
			$k = $i['suara'];
			if ($k == $id) {
				//$this->db->query("UPDATE pemilih set suara='0' where id='$r'"); <-- kurang safety
				$this->db->update('pemilih', ["suara" => "0"], ["id" => $r]);
			};
		endforeach;

		$get_data = $this->db->select("foto")
			->from("calon")
			->where("id", $id)
			->where('delete_at', null)
			->get()
			->row();

		unlink("upload/" . $get_data->foto);

		$this->db->where('id', $id);
		$this->db->update('calon', ['delete_at' => $this->delete_at]);
		// $this->_deleteImage($id);
		if (file_exists(FCPATH . '/upload/' . $id . '.jpg') || file_exists(FCPATH . '/upload/' . $id . '.jpeg') || file_exists(FCPATH . '/upload/' . $id . '.png') || file_exists(FCPATH . '/upload/' . $id . '.gif')) {
			unlink(FCPATH . '/upload/' . $id . '.jpg');
			unlink(FCPATH . '/upload/' . $id . '.jpeg');
			unlink(FCPATH . '/upload/' . $id . '.png');
			unlink(FCPATH . '/upload/' . $id . '.gif');
		}
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// public function truncate(){
	// 	$hasil=$this->db->query("SELECT *  FROM pemilih");
	// 	foreach($hasil->result_array() as $i):
	//                                $b=$i['id'];
	//        $this->db->query("UPDATE pemilih set suara='0' where id='$b'");
	//        endforeach;

	// 	$this->db->query('TRUNCATE TABLE calon');
	// 	if($this->db->affected_rows()>0){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }

	public function editcalon($id)
	{
		$this->id = $id;
		$data = [
			// 'id' 		=> uniqid(),
			'nomorurut'	=> $this->db->escape_str($this->input->post('nomorurut', true)),
			'nama1'		=> $this->db->escape_str($this->input->post('nama1', true)),
			'nama2'		=> $this->db->escape_str($this->input->post('nama2', true)),
			'visi'		=> $this->db->escape_str($this->input->post('visi', true)),
			'misi'		=> $this->db->escape_str($this->input->post('misi', true)),
			'foto'		=> $this->_uploadImage('edit', $id)
		];
		// $post = $this->input->post();
		// $this->id = uniqid();
		// $this->nomorurut = $post["nomorurut"];
		// $this->nama1 = $post["nama1"];
		// $this->nama2 = $post["nama2"];
		// $this->visi = $post["visi"];
		// $this->misi = $post["misi"];

		$get_data = $this->db->select("foto")
			->from("calon")
			->where("id", $id)
			->get()
			->row();

		unlink("upload/" . $get_data->foto);

		$this->db->where('id', $id);
		$this->db->update('calon', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function pilihcalon($id)
	{

		$hasil = $this->db->query("SELECT vote FROM calon where id='$id' AND 'delete_at' IS NULL");
		foreach ($hasil->result_array() as $i) :
			$k = $i['vote'];
			$k = $k + 1;
			$this->db->query("UPDATE calon set vote='$k' where id='$id' AND 'delete_at' IS NULL");
		endforeach;


		$loginnim = $this->session->userdata('nim');
		$field2 = array(
			'suara' => $id
		);
		$this->db->where('nim', $loginnim);
		$this->db->update('pemilih', $field2);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// 	private function _uploadImage()
	// {
	// 	$data=$this->input->post();
	//     $config['upload_path']          = './upload';
	//     $config['allowed_types']        = 'gif|jpg|png';
	//     $config['file_name']            = $data['upfoto'];
	//     $config['overwrite']			= true;

	//     $this->load->library('upload', $config);
	//     $hasil=$this->upload->do_upload('upfoto');

	//     if ($hasil) {
	//         return $this->upload->$hasil("file_name");
	//     }else
	//     return "default.jpg";


	// 	}
	private function _uploadImage(String $action = 'add', String $filename = '')
	{
		if ($action == 'add') {
			$config['upload_path']          = './upload/';
			$config['allowed_types']        = 'gif|jpeg|jpg|png';
			$config['file_name']            = $this->id;
			$config['overwrite']			= true;
			// $config['max_size']             = 1024; // 1MB
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('upfoto')) {
				return $this->upload->data("file_name");
			}

			return "default.jpg";
		} else if ($action == 'edit') {
			$config['upload_path']          = './upload/';
			$config['allowed_types']        = 'gif|jpeg|jpg|png';
			$config['file_name']            = $filename;
			$config['overwrite']			= true;
			// $config['max_size']             = 1024; // 1MB
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('upfoto')) {
				return $this->upload->data("file_name");
			}

			return "default.jpg";
		}

		// private function _deleteImage($id)
		// {
		// 	$product = $this->$id;
		// 	if ($product->image != "default.jpg") {
		// 		$filename = explode(".", $product->image)[0];
		// 		return array_map('unlink', glob(FCPATH."upload/$filename.*"));
		// 	}
		// }
	}
}
