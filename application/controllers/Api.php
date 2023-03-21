<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'file'));
    }

	public function register(){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$telp = $this->input->post('telp');
		$gender = $this->input->post('gender');
		$sekolah = $this->input->post('sekolah');
		$alamat = $this->input->post('alamat');
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$cek = $this->db->select('*')->from('ref_user')->where('user_username', $username)->get()->row();
		if($cek){
			echo json_encode(array(
				'status'	=> false,
				'message'	=> 'Username sudah terdaftar!'
			));
		}else{
			$data = array(
				'user_name' => $nama,
				'user_username' => $username,
				'user_phone' => $telp,
				'user_gender' => $gender,
				'user_school' => $sekolah,
				'user_address' => $alamat,
				'user_password' => $password,
				'user_created_at' => date('Y-m-d H:i:s'),
			);

			$this->db->insert('ref_user', $data);
			echo json_encode(array(
				'status'	=> true,
				'message'	=> 'Pendaftaran berhasil!'
			));
		}
	}

	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// $token = $this->input->post('token');

		if ($username != "" || $password != "") {
			$this->db->select('*');
			$this->db->from('ref_user');
			$this->db->where('user_username', $username);
			$user = $this->db->get();
			if ($user->num_rows() == 0) {
				echo json_encode(array(
					'success'	=> false,
					'message'	=> 'Username atau password salah!',
					'data'		=> array(
						'user_id'		=> null,
					'user_name' => null,
					'user_username' => null,
					'user_phone' => null,
					'user_gender' => null,
					'user_photo' => null,
					'user_address' => null,
					'user_school' => null,
					)
				));
			} else {
				if (password_verify($password, $user->row()->user_password)) {
					if ($user->row()) {
						// $data_login = array('user_login_at' => date('Y-m-d H:i:s'));
						// $where = array('user_id', $user->row()->user_id, 'user_fcm', $token);
						// $this->db->update('ref_user', $data_login, $where);
						
						echo json_encode(array(
							'success'	=> true,
							'message'	=> 'Berhasil masuk!',
							'data'		=>  array(
								'user_id'		=> $user->row()->user_id,
							'user_name'		=> $user->row()->user_name,
							'user_username' => $user->row()->user_username,
							'user_phone' => $user->row()->user_phone,
							'user_gender' => $user->row()->user_gender,
							'user_address' => $user->row()->user_address,
							'user_photo' => $user->row()->user_photo,
							'user_school' => $user->row()->user_school,
							)
						));
					} else {
						echo json_encode(array(
							'success'	=> false,
							'message'	=> 'Username atau password salah!',
							'data'		=> array(
								'user_id'		=> null,
							'user_name' => null,
							'user_username' => null,
							'user_phone' => null,
							'user_gender' => null,
							'user_photo' => null,
							'user_address' => null,
							'user_school' => null,
							)
						));				
					}
				} else {
					echo json_encode(array(
						'success'	=> false,
						'message'	=> 'Username atau password salah!',
						'data'		=> array(
							'user_id'		=> null,
						'user_name' => null,
						'user_username' => null,
						'user_phone' => null,
						'user_gender' => null,
						'user_photo' => null,
						'user_address' => null,
						'user_school' => null,
						)
					));
				}
			}
		} else {
			echo json_encode(array(
				'success'	=> false,
				'message'	=> 'Username atau password salah!',
				'data'		=> array(
					'user_id'		=> null,
				'user_name' => null,
				'user_username' => null,
				'user_phone' => null,
				'user_gender' => null,
				'user_photo' => null,
				'user_address' => null,
				'user_school' => null,
				)
			));
		}
	}

	public function get_app(){
		$data = $this->db->select('*')->from('ref_app')->where('app_id', 1)->get()->row();
		echo json_encode($data);
	}

	public function get_cerita_all()
    {
		$no_of_records_per_page = 10;
        $offset = (intval($this->input->post('pageno'))-1) * $no_of_records_per_page;

		$data = $this->db->select('*')->from('ref_cerita')
		->like('cerita_judul', htmlspecialchars($this->input->post('judul')))->order_by('cerita_id', 'asc')->limit($no_of_records_per_page, $offset)->get()->result();
        echo json_encode(array(
			'status'	=> true,
			'message'	=> "Berhasil",
			'pageno'	=> intval($this->input->post('pageno')),
			'data'		=> $data
		));
    }

	public function get_praktek_all()
    {
		$no_of_records_per_page = 10;
        $offset = (intval($this->input->post('pageno'))-1) * $no_of_records_per_page;

		$data = $this->db->select('*')->from('ref_praktek')
		// ->join('ref_kode', 'ref_kode.kode_kode=ref_praktek.praktek_kode', 'left')
		->like('praktek_kode', htmlspecialchars($this->input->post('kode')))->order_by('praktek_id', 'asc')->limit($no_of_records_per_page, $offset)->get()->result();
        echo json_encode(array(
			'status'	=> true,
			'message'	=> "Berhasil",
			'pageno'	=> intval($this->input->post('pageno')),
			'data'		=> $data
		));
    }

	public function get_soal_all()
    {
		
		$d = $this->db->select('*')->from('ref_soal')->get()->result();
		shuffle($d);
		foreach ($d as $key => $value) {
			$d[$key]->jawaban = $this->db->select("*")->from("ref_jawab")->where("jawab_soal_id", $value->soal_id)->get()->result();
		}

        echo json_encode(array(
			'status'	=> true,
			'message'	=> "Berhasil",
			'data'		=> $d
		));
    }

	public function tambah_soal_praktek()
    {
		$data = array(
			"praktek_user_id" => $this->input->post('praktek_user_id'),
			"praktek_catatan" => $this->input->post('praktek_catatan'),
			"praktek_link" => $this->input->post('praktek_link'),
			"praktek_kode" => $this->input->post('praktek_kode'),
		);

		$cek = $this->db->select('*')->from("ref_kode")->where('kode_kode', $this->input->post('praktek_kode'))->get()->row();
		if($cek){
			$in = $this->db->insert('ref_praktek', $data);
			if($in){
				echo json_encode(array(
					'status'	=> true,
					'message'	=> "Submit Soal Prakter Berhasil!",
				));
			}else{
				echo json_encode(array(
					'status'	=> false,
					'message'	=> "Gagal! Silahkan coba beberapa saat lagiaaa",
				));
			}
		}else{
			echo json_encode(array(
				'status'	=> false,
				'message'	=> "Kode pelajaran tidak terdaftar",
			));
		}
    }

	public function change_password(){
			$data = array(
				'user_password' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT)
			);
			$this->db->where("user_id", $this->input->post("user_id"));
			if($this->db->update('ref_user', $data)){
				echo json_encode(array(
					'status'	=> true,
					'message'	=> 'Password berhasil diubah'
				));
			}else{
				echo json_encode(array(
					'status'	=> false,
					'message'	=> 'Gagal! silahkan coba beberapa saat lagi'
				));
			}
	}

	public function change_profile(){
			$data2 = array(
				'user_name' => $this->input->post('user_name'),
				'user_phone' => $this->input->post('user_phone'),
				'user_address' => $this->input->post('user_address'),
				'user_school' => $this->input->post('user_school'),

			);
			$this->db->where("user_id", $this->input->post("user_id"));
			$this->db->update('ref_user', $data2);

			$data = $this->db->select('*')->from('ref_user')
				->where('user_id', $this->input->post("user_id"))->get()->row();
				echo json_encode(array(
					'status'	=> true,
					'message'	=> 'Successfully!',
					'data'=>$data));
	}

	public function get_profile()
    {
		$data = $this->db->select('*')->from('ref_user')
		->where('user_id', $this->input->post("user_id"))->get()->row();
        echo json_encode(array(
			'status'	=> true,
			'message'	=> 'Successfully!',
			'data'=>$data));
    }

	public function update_image(){
		if(!empty($_FILES["image"]["name"])){
			$file_ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
			$file_name = 'profile-' . date('YmdHis') . '.' . $file_ext;
			$target_dir = "assets/img/profile/";
			$target_dir = $target_dir . basename($file_name);
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir)) {
				$data2 = array(
					'user_photo' => $file_name,
				);
				$this->db->where('user_id', $this->input->post('user_id'));
				$this->db->update('ref_user', $data2);
				echo json_encode(array(
					'status'	=> true,
					'message'	=> 'Successfully!'
				));
			} else {
				echo json_encode(array(
							'status'	=> false,
							'message'	=> 'Failed!'
						));						
			}
		}

	}













	public function create_farm(){
		if($this->input->post('farm_type_id') == '1' || $this->input->post('farm_type_id') == '4'){
			$data = array(
				'farm_name' => $this->input->post('farm_name'),
				'farm_description' => $this->input->post('farm_description'),
				'farm_size' => $this->input->post('farm_size'),
				'farm_total_trees' => $this->input->post('farm_total_trees'),
				'farm_planting' => $this->input->post('farm_planting'),
				'farm_harvesting' => $this->input->post('farm_harvesting'),
				'farm_created_at' => date('Y-m-d H:i:s'),
				'farm_user_id' => $this->input->post('farm_user_id'),
				'farm_type_id' => $this->input->post('farm_type_id'),
			);

			$this->db->insert('ref_farm', $data);
			echo json_encode(array(
				'status'	=> true,
				'message'	=> 'Create a New Farm is Successfully!'
			));
		}else if($this->input->post('farm_type_id') == '2' || $this->input->post('farm_type_id') == '3'){
			$data = array(
				'farm_name' => $this->input->post('farm_name'),
				'farm_description' => $this->input->post('farm_description'),
				'farm_size' => $this->input->post('farm_size'),
				'farm_planting' => $this->input->post('farm_planting'),
				'farm_harvesting' => $this->input->post('farm_harvesting'),
				'farm_created_at' => date('Y-m-d H:i:s'),
				'farm_user_id' => $this->input->post('farm_user_id'),
				'farm_type_id' => $this->input->post('farm_type_id'),
			);

			$this->db->insert('ref_farm', $data);
			echo json_encode(array(
				'status'	=> true,
				'message'	=> 'Create a New Farm is Successfully!'
			));
		}else if($this->input->post('farm_type_id') == '5' || $this->input->post('farm_type_id') == '7'){
			$data = array(
				'farm_name' => $this->input->post('farm_name'),
				'farm_description' => $this->input->post('farm_description'),
				'farm_number_animal' => $this->input->post('farm_number_animal'),
				'size_of_house_animal' => $this->input->post('size_of_house_animal'),
				'farm_putting_animal' => $this->input->post('farm_putting_animal'),
				'farm_created_at' => date('Y-m-d H:i:s'),
				'farm_user_id' => $this->input->post('farm_user_id'),
				'farm_type_id' => $this->input->post('farm_type_id'),
			);

			$this->db->insert('ref_farm', $data);
			echo json_encode(array(
				'status'	=> true,
				'message'	=> 'Create a New Farm is Successfully!'
			));
		}else{
			$data = array(
				'farm_name' => $this->input->post('farm_name'),
				'farm_description' => $this->input->post('farm_description'),
				'farm_number_animal' => $this->input->post('farm_number_animal'),
				'size_of_house_animal' => $this->input->post('size_of_house_animal'),
				'farm_putting_animal' => $this->input->post('farm_putting_animal'),
								'farm_grass_size' => $this->input->post('farm_grass_size'),

				'farm_created_at' => date('Y-m-d H:i:s'),
				'farm_user_id' => $this->input->post('farm_user_id'),
				'farm_type_id' => $this->input->post('farm_type_id'),
			);

			$this->db->insert('ref_farm', $data);
			echo json_encode(array(
				'status'	=> true,
				'message'	=> 'Create a New Farm is Successfully!'
			));
		}
		
	}

	

	public function delete_farm()
    {
		$data = array(
			'farm_deleted' => 1
		);
		$this->db->where('farm_id', $this->input->post('farm_id'));
		$this->db->update('ref_farm', $data);

		$data2 = array(
			'task_deleted' => 1
		);
		$this->db->where('task_farm_id', $this->input->post('farm_id'));
		$this->db->update('ref_task', $data2);
		
        echo json_encode(array(
			'status'	=> true,
			'message'	=> 'Successfully!'
		));
    }

	public function delete_task()
    {
		$data2 = array(
			'task_deleted' => 1
		);
		$this->db->where('task_id', $this->input->post('task_id'));
		$this->db->update('ref_task', $data2);
        echo json_encode(array(
			'status'	=> true,
			'message'	=> 'Successfully!'
		));
    }

	public function update_farm()
    {
		if($this->input->post('farm_type_id') == '1' || $this->input->post('farm_type_id') == '4'){
			$data = array(
				'farm_name' => $this->input->post('farm_name'),
				'farm_description' => $this->input->post('farm_description'),
				'farm_size' => $this->input->post('farm_size'),
				'farm_total_trees' => $this->input->post('farm_total_trees'),
				'farm_planting' => $this->input->post('farm_planting'),
				'farm_harvesting' => $this->input->post('farm_harvesting'),
				'farm_created_at' => date('Y-m-d H:i:s'),
				'farm_user_id' => $this->input->post('farm_user_id'),
				'farm_type_id' => $this->input->post('farm_type_id'),
			);

			$this->db->where('farm_id', $this->input->post('farm_id'));
			$this->db->update('ref_farm', $data);
			echo json_encode(array(
				'status'	=> true,
				'message'	=> 'Update Farm is Successfully!'
			));
		}
		else if($this->input->post('farm_type_id') == '2' || $this->input->post('farm_type_id') == '3'){
			$data = array(
				'farm_name' => $this->input->post('farm_name'),
				'farm_description' => $this->input->post('farm_description'),
				'farm_size' => $this->input->post('farm_size'),
				'farm_planting' => $this->input->post('farm_planting'),
				'farm_harvesting' => $this->input->post('farm_harvesting'),
				'farm_created_at' => date('Y-m-d H:i:s'),
				'farm_user_id' => $this->input->post('farm_user_id'),
				'farm_type_id' => $this->input->post('farm_type_id'),
			);

			$this->db->where('farm_id', $this->input->post('farm_id'));
			$this->db->update('ref_farm', $data);
			echo json_encode(array(
				'status'	=> true,
				'message'	=> 'Update Farm is Successfully!'
			));
		}else if($this->input->post('farm_type_id') == '5' || $this->input->post('farm_type_id') == '7'){
			$data = array(
				'farm_name' => $this->input->post('farm_name'),
				'farm_description' => $this->input->post('farm_description'),
				'farm_number_animal' => $this->input->post('farm_number_animal'),
				'size_of_house_animal' => $this->input->post('size_of_house_animal'),
				'farm_putting_animal' => $this->input->post('farm_putting_animal'),
				'farm_created_at' => date('Y-m-d H:i:s'),
				'farm_user_id' => $this->input->post('farm_user_id'),
				'farm_type_id' => $this->input->post('farm_type_id'),
			);

			$this->db->where('farm_id', $this->input->post('farm_id'));
			$this->db->update('ref_farm', $data);
			echo json_encode(array(
				'status'	=> true,
				'message'	=> 'Update Farm is Successfully!'
			));
		}else{
			$data = array(
				'farm_name' => $this->input->post('farm_name'),
				'farm_description' => $this->input->post('farm_description'),
				'farm_number_animal' => $this->input->post('farm_number_animal'),
				'size_of_house_animal' => $this->input->post('size_of_house_animal'),
				'farm_putting_animal' => $this->input->post('farm_putting_animal'),
								'farm_grass_size' => $this->input->post('farm_grass_size'),

				'farm_created_at' => date('Y-m-d H:i:s'),
				'farm_user_id' => $this->input->post('farm_user_id'),
				'farm_type_id' => $this->input->post('farm_type_id'),
			);

			$this->db->where('farm_id', $this->input->post('farm_id'));
			$this->db->update('ref_farm', $data);
			echo json_encode(array(
				'status'	=> true,
				'message'	=> 'Update Farm is Successfully!'
			));
		}
    }

	public function update_task()
    {
		$data2 = array(
			'task_name' => $this->input->post('task_name'),
			'task_date' => $this->input->post('task_date'),
			'task_description' => $this->input->post('task_description'),
		);
		$this->db->where('task_id', $this->input->post('task_id'));
		$this->db->update('ref_task', $data2);
        echo json_encode(array(
			'status'	=> true,
			'message'	=> 'Successfully!'
		));
    }

	public function create_task()
    {
		$data2 = array(
			'task_farm_id' => $this->input->post('farm_id'),
			'task_name' => $this->input->post('task_name'),
			'task_date' => $this->input->post('task_date'),
			'task_description' => $this->input->post('task_description'),
		);
		$this->db->insert('ref_task', $data2);

        echo json_encode(array(
			'status'	=> true,
			'message'	=> 'Successfully!'
		));
    }


	public function get_task_all()
    {
		$no_of_records_per_page = 10;
        $offset = (intval($this->input->post('pageno'))-1) * $no_of_records_per_page;

		$data = $this->db->select('*')->from('ref_task')
		->join('ref_farm', 'ref_farm.farm_id=ref_task.task_farm_id', 'left')
		->join('ref_farm_type', 'ref_farm_type.farm_type_id=ref_farm.farm_type_id', 'left')
		->where('farm_user_id', htmlspecialchars($this->input->post('farm_user_id')))
		->where('task_deleted', 0)
		->like('task_name', htmlspecialchars($this->input->post('task_name')))->order_by('task_id', 'desc')->limit($no_of_records_per_page, $offset)->get()->result();
        echo json_encode(array(
			'pageno'	=> intval($this->input->post('pageno')),
			'data'		=> $data
		));
    }

	public function get_task()
    {
		$no_of_records_per_page = 10;
        $offset = (intval($this->input->post('pageno'))-1) * $no_of_records_per_page;

		$data = $this->db->select('*')->from('ref_task')
		->join('ref_farm', 'ref_farm.farm_id=ref_task.task_farm_id', 'left')
		->join('ref_farm_type', 'ref_farm_type.farm_type_id=ref_farm.farm_type_id', 'left')
		->where('task_farm_id', htmlspecialchars($this->input->post('farm_id')))
		->where('task_deleted', 0)
		->like('task_name', htmlspecialchars($this->input->post('task_name')))->order_by('task_id', 'desc')->limit($no_of_records_per_page, $offset)->get()->result();
        echo json_encode(array(
			'pageno'	=> intval($this->input->post('pageno')),
			'data'		=> $data
		));
    }

	public function get_farm()
    {
		$data = $this->db->select('*')->from('ref_farm')->join('ref_farm_type', 'ref_farm_type.farm_type_id=ref_farm.farm_type_id', 'left')
		->where('farm_id', htmlspecialchars($this->input->post('farm_id')))
		->where('farm_deleted', 0)->get()->row();
        echo json_encode(array('data'=>$data));
    }

	public function get_farm_type()
    {
		$data = $this->db->select('*')->from('ref_farm_type')->get()->result();
        echo json_encode(array(
			'pageno'	=> 1,
			'data'		=> $data
		));
    }

	public function create_document(){
			$data = array(
				'document_content' => $this->input->post('document_content'),
				'document_farm_type' => $this->input->post('document_farm_type'),
				'document_user_id' => $this->input->post('document_user_id'),
				'document_created_at' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('ref_document', $data);
			$id = $this->db->insert_id();
			if((int)$this->input->post('banyak') != 0){
				for ($i=0; $i < (int)$this->input->post('banyak'); $i++) { 
					if(!empty($_FILES["image".$i]["name"])){
						$file_ext = pathinfo($_FILES["image".$i]["name"], PATHINFO_EXTENSION);
						$file_name = 'doc-' . date('YmdHis') . '.' . $file_ext;
						$target_dir = "assets/doc/";
						$target_dir = $target_dir . basename($file_name);
						if (move_uploaded_file($_FILES["image".$i]["tmp_name"], $target_dir)) {
							$data2 = array(
								'document_file_name' => $file_name,
								'document_file_path' => $file_name,
								'document_file_document_id' => $id,
							);
							$this->db->insert('ref_document_file', $data2);
							// $this->doUpload('./assets/doc/', 'doc', $file_name_upload);
							echo json_encode(array(
								'status'	=> true,
								'message'	=> 'Successfully!'
							));
						} else {
							echo json_encode(array(
										'status'	=> false,
										'message'	=> 'Failed!'
									));						
						}
					}
				}
			}
			
	}

	public function get_all_document()
    {
		$no_of_records_per_page = 10;
        $offset = (intval($this->input->post('pageno'))-1) * $no_of_records_per_page;

		if($this->input->post('type') == '0'){
			$data = $this->db->select('*')->from('ref_document')
			->join('ref_user', 'ref_user.user_id=ref_document.document_user_id', 'left')
			->join('ref_farm_type', 'ref_farm_type.farm_type_id=ref_document.document_farm_type', 'left')
			->where('document_deleted', 0)
			->like('document_content', htmlspecialchars($this->input->post('document_content')))->order_by('document_id', 'desc')->limit($no_of_records_per_page, $offset)->get()->result();

			foreach ($data as $key => $value) {
				$data[$key]->file = $this->db->select('*')->from('ref_document_file')->where('document_file_document_id', $value->document_id)->get()->result();
								$data[$key]->comment = $this->db->select('*')->from('ref_comment')->where('comment_document_id', $value->document_id)->get()->num_rows();

			}
			echo json_encode(array(
				'pageno'	=> intval($this->input->post('pageno')),
				'data'		=> $data
			));
		}
    }

	public function get_task_home()
    {
		$data = $this->db->select('*')->from('ref_task')
		->join('ref_farm', 'ref_farm.farm_id=ref_task.task_farm_id', 'left')
		->join('ref_farm_type', 'ref_farm_type.farm_type_id=ref_farm.farm_type_id', 'left')
		->where('farm_user_id', $this->input->post('farm_user_id'))
		->where('task_deleted', 0)
		->order_by('task_id', 'desc')->limit(7)->get()->result();
        echo json_encode(array(
			'pageno'	=> 1,
			'data'		=> $data
		));
    }

	public function get_about()
    {
		$data = $this->db->select('*')->from('ref_about')
		->where('about_id', 1)->get()->row();
        echo json_encode(array(
				'status'	=> true,
				'message'	=> $data->about_text			
			));
    }

	private function doUpload($upload_path, $key, $file_name)
	{
		$config['upload_path']   = $upload_path;
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';
		$config['file_name']     = $file_name;
		$config['overwrite']     = 'TRUE';
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload($key)) {
			return $this->upload->display_errors();
		}else{
			return "okkk";
		}
    }





	public function index()
    {
		$data = $this->db->select('*')->from('ref_home')->where('id', 1)->get()->row();
        echo json_encode($data);
    }

	public function get_home()
    {	
		$slider = [];

		$data = $this->db->select('*')->from('ref_home')->where('id', 1)->get()->row();
		
		array_push($slider, array(
			"title" => $data->slider1_title,
			"path" => $data->slider1,
		));

		array_push($slider, array(
			"title" => $data->slider2_title,
			"path" => $data->slider2,
		));

		array_push($slider, array(
			"title" => $data->slider3_title,
			"path" => $data->slider3,
		));

		$data->slider = $slider;
        echo json_encode($data);
    }

	public function get_how()
    {
		// $slider = [];
		$data = $this->db->select('*')->from('ref_how')->where('id', 1)->get()->row();
		// array_push($slider, array(
		// 	"image" => "https://img.youtube.com/vi/".$data->related_video1."/0.jpg",
		// 	"link" => $data->related_video1_link,
		// ));

		// array_push($slider, array(
		// 	"image" => "https://img.youtube.com/vi/".$data->related_video2."/0.jpg",
		// 	"link" => $data->related_video2_link,
		// ));

		// array_push($slider, array(
		// 	"image" => "https://img.youtube.com/vi/".$data->related_video3."/0.jpg",
		// 	"link" => $data->related_video3_link,
		// ));

		$data->step = $this->db->select('*')->from('ta_step')->order_by('step_number', 'asc')->get()->result();
		$data->youtube = $this->db->select('*')->from('ta_youtube')->order_by('youtube_id', 'desc')->get()->result();
        echo json_encode($data);
    }

	public function get_product()
    {
		$data = $this->db->select('*')->from('ref_product')->where('id', 1)->get()->row();

		$data->newest = $this->db->select('*')->from('ta_product')
		->order_by('product_id', 'asc')
		->limit(5)->get()->result();

		foreach ($data->newest as $key => $value) {
			$data->newest[$key]->product_photos = $this->db->select('*')->from('ta_det_product')->where('det_product_id', $value->product_id)->get()->result();
		}

		$data->product = $this->db->select('*')->from('ta_product')
		->order_by('product_id', 'RANDOM')
		->limit(5)->get()->result();

		foreach ($data->product as $key => $value) {
			$data->product[$key]->product_photos = $this->db->select('*')->from('ta_det_product')->where('det_product_id', $value->product_id)->get()->result();
		}

        echo json_encode($data);
    }

	public function get_product_detail()
    {
		$act = array(
			'act_user_id'	=> $this->input->post('user_id'),
			'act_product_id'	=> $this->input->post('product_id'),
			'act_flag'	=> 1,
			'act_date'	=> date('Y-m-d H:i:s'),
			'date'	=> date('Y-m-d')
		);

		$this->db->insert('ta_activity', $act);

		$data = $this->db->select('*')->from('ta_product')->where('product_id', $this->input->post('product_id'))->get()->row();
		$data->product_photos = $this->db->select('*')->from('ta_det_product')->where('det_product_id', $this->input->post('product_id'))->get()->result();

        echo json_encode($data);
    }

	public function get_product_all()
    {
		$no_of_records_per_page = 10;
        $offset = (intval($this->input->post('pageno'))-1) * $no_of_records_per_page;

		$data = $this->db->select('*')->from('ta_product')
		->like('product_name', htmlspecialchars($this->input->post('product_name')))->order_by('product_id', 'desc')->limit($no_of_records_per_page, $offset)->get()->result();
        echo json_encode(array(
			'pageno'	=> intval($this->input->post('pageno')),
			'data'		=> $data
		));
    }

	public function get_event()
    {
		$data = $this->db->select('*')->from('ref_event')->where('id', 1)->get()->row();

		$data->categories = $this->db->select('*')->from('ref_categories')->get()->result();
		$data->newest = $this->db->select('*')->from('ta_newest_event')->join('ta_event','new_event_id=event_id', 'left')->join('ref_categories','cat_id=event_cat_id', 'left')->where('event_flag', 1)->get()->result();
		// $data->events = $this->db->select('*')->from('ta_event')
		// ->where('event_flag', 1)
		// ->order_by('event_id', 'random')
		// ->limit(3)->get()->result();

		// foreach ($data->events as $key => $value) {
		// 	$data->events[$key]->event_photos = $this->db->select('*')->from('ta_det_event')->where('det_event_id', $value->event_id)->get()->result();
		// }

		// $data->appeal = $this->db->select('*')->from('ta_event')
		// ->where('event_flag', 2)
		// ->order_by('event_id', 'random')
		// ->limit(3)->get()->result();

		// foreach ($data->appeal as $key => $value) {
		// 	$data->appeal[$key]->event_photos = $this->db->select('*')->from('ta_det_event')->where('det_event_id', $value->event_id)->get()->result();
		// }

        echo json_encode($data);
    }

	public function get_event_detail()
    {
		$act = array(
			'act_user_id'	=> $this->input->post('user_id'),
			'act_event_id'	=> $this->input->post('event_id'),
			'act_flag'	=> 1,
			'date'	=> date('Y-m-d'),
			'act_date'	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('ta_activity', $act);

		$data = $this->db->select('*')->from('ta_event')->where('event_id', $this->input->post('event_id'))->get()->row();
		$data->event_photos = $this->db->select('*')->from('ta_det_event')->where('det_event_id', $this->input->post('event_id'))->get()->result();

        echo json_encode($data);
    }

	public function get_event_all()
    {
		$no_of_records_per_page = 10;
        $offset = (intval($this->input->post('pageno'))-1) * $no_of_records_per_page;

		$data = $this->db->select('*')->from('ta_event')
		->where('event_flag', $this->input->post('event_flag'))
		->where('event_cat_id', $this->input->post('event_cat_id'))
		->like('event_name', htmlspecialchars($this->input->post('event_name')))->order_by('event_id', 'desc')->limit($no_of_records_per_page, $offset)->get()->result();
        echo json_encode(array(
			'pageno'	=> intval($this->input->post('pageno')),
			'data'		=> $data
		));
    }

	

}
