<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use \PhpOffice\PhpWord\TemplateProcessor,
    \PhpOffice\PhpWord\Shared\Html,
    \PhpOffice\PhpWord\Element\Table,
    \PhpOffice\PhpWord\PhpWord;

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Dashboard_model', 'model');
        $this->load->helper(array('url', 'file'));

        if ($this->authentication->is_loggedin() === false) redirect('logout');
    }

    public function index()
    {
		$data['title'] = 'Dashboard';
        $data['content'] = 'dashboard';

        $this->load->view('layouts/master', $data);
	}

	public function user(){
		$data['title'] = 'Kode List';
        $data['content'] = 'kode';

        $this->load->view('layouts/master', $data);
	}

	public function user_list(){
		$data = $this->db->select('*')->from('ref_kode')->where("kode_user_id", $this->session->userdata("admin_id"))->order_by('kode_id', 'desc')->get()->result();
		foreach ($data as $key => $value) {
			$data[$key]->terkumpul = $this->db->select('*')->from("ref_praktek")->where("praktek_kode", $value->kode_kode)->get()->num_rows();
		}
		echo json_encode($data);
	}

	public function add_kode(){
		$cek = $this->db->select("*")->from("ref_kode")->where("kode_kode", $this->input->post('kode'))->get()->row();
		if($cek){
			echo json_encode(false);
		}else{
			$data = array(
				'kode_judul' => $this->input->post('judul'),
				'kode_deskripsi' => $this->input->post('deskripsi'),
				'kode_user_id' => $this->session->userdata('admin_id'),

				'kode_kode' => $this->input->post('kode'),
				'kode_created_at'	=> date('Y-m-d H:i:s')
			);

			echo json_encode($this->db->insert('ref_kode', $data));
		}
		
	}

	public function kode_kode($kode){
		$data['title'] = 'Kode List - '.$kode;
		$data['kode'] = $kode;
        $data['content'] = 'kode_kode';

        $this->load->view('layouts/master', $data);
	}

	public function kode_kode_nilai($kode){
		$data = $this->db->select('*')->from('ref_praktek')->join("ref_user", "ref_user.user_id=ref_praktek.praktek_user_id")->where("praktek_kode", $kode)->get()->result();

		echo json_encode($data);
	}

	public function update_nilai(){
			$data = array(
				'praktek_nilai' => $this->input->post('nilai'),
				'praktek_catatan_penilai' => $this->input->post('catatan'),
			);
			$this->db->where("praktek_id", $this->input->post('id'));
			echo json_encode($this->db->update('ref_praktek', $data));
	}

	public function edit_kode(){
			$data = array(
				'kode_judul' => $this->input->post('judul'),
				'kode_deskripsi' => $this->input->post('deskripsi'),
			);
			$this->db->where("kode_id", $this->input->post('id'));
			echo json_encode($this->db->update('ref_kode', $data));
	}

	public function delete_kode(){
		$id = $this->input->post("kode");
		$this->db->where('kode_kode', $id);
		$this->db->delete('ref_kode');

		$this->db->where('praktek_kode', $id);
		$this->db->delete('ref_praktek');

		echo json_encode(true);
	}





	public function how_page()
    {
		  
        $data['title'] = 'How Page';
        $data['content'] = 'how_page';
		$data['home'] = $this->db->select('*')->from('ref_how')->where('id', 1)->get()->row();

        $this->load->view('layouts/master', $data);
    }

	public function get_list_youtube()
    {
		$data = $this->db->select('*')->from('ta_youtube')->order_by('youtube_id', 'desc')->get()->result();
        echo json_encode($data);
    }

	public function add_new_youtube(){
		$data = array(
			'youtube_image' => substr($this->input->post('youtube_link'), strpos($this->input->post('youtube_link'), "=") + 1),
            'youtube_link' => $this->input->post('youtube_link'),
			'youtube_created_at'	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('ta_youtube', $data);

		redirect('how-page');
	}

	public function delete_youtube()
    {
        $id = $this->input->post('youtube_id');

		$this->db->where('youtube_id', $id);
		$this->db->delete('ta_youtube');
        echo json_encode(true);       
    }

	public function post_edit_youtube(){
        $id = $this->input->post('youtube_id');
        $data = array(
            'youtube_link' => $this->input->post('youtube_link_edit'),
			'youtube_image' => substr($this->input->post('youtube_link_edit'), strpos($this->input->post('youtube_link_edit'), "=") + 1),
		);

		$this->db->where('youtube_id', $id);
        $this->db->update('ta_youtube', $data);

		redirect('how-page');
    }

	public function add_step()
    {
        $data['title'] = 'Add Step';
        $data['content'] = 'add_step';
        $this->load->view('layouts/master', $data);
    }

	public function get_list_step()
    {
		$data = $this->db->select('*')->from('ta_step')->order_by('step_number', 'asc')->get()->result();
        echo json_encode($data);
    }

	public function delete_step()
    {
        $id = $this->input->post('step_id');

		$this->db->where('step_id', $id);
		$this->db->delete('ta_step');
        echo json_encode(true);       
    }
	
	public function edit_step($id)
    {
        $data['title'] = 'Edit Step';
        $data['content'] = 'update_step';
		$data['product'] = $this->db->select('*')->from('ta_step')->where('step_id', $id)->get()->row();
        $this->load->view('layouts/master', $data);
    }

	public function post_edit_step(){
        $id = $this->input->post('step_id');
        $data = array(
            'step_title' => $this->input->post('step_title'),
            'step_number' => $this->input->post('step_number'),
            'step_desc' => $this->input->post('step_desc'),
		);

		if (!empty($_FILES["step_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["step_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'step_pic-' . date('YmdHis');
            $file_name = 'step_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'step_pic' => $file_name,
			);
			$this->db->where('step_id', $id);
        	$this->db->update('ta_step', $data1);

            $this->doUpload('./assets/img/how/', 'step_pic', $file_name_upload);
        }

		$this->db->where('step_id', $id);
        $this->db->update('ta_step', $data);

		redirect('how-page');
    }

	public function add_new_step(){
		$data = array(
			            'step_number' => $this->input->post('step_number'),

            'step_title' => $this->input->post('step_title'),
            'step_desc' => $this->input->post('step_desc'),
			'step_created_at'	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('ta_step', $data);
		$id =  $this->db->insert_id();

		if (!empty($_FILES["step_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["step_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'step_pic-' . date('YmdHis');
            $file_name = 'step_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'step_pic' => $file_name,
			);
			$this->db->where('step_id', $id);
        	$this->db->update('ta_step', $data1);

            $this->doUpload('./assets/img/how/', 'step_pic', $file_name_upload);
        }

		redirect('how-page');
	}

	public function update_how_page()
    {
        $data = array(
            'how_title' => $this->input->post('how_title'),
            'how_desc' => $this->input->post('how_desc'),
			'updated_at' => $this->input->post('updated_at'),
        );

		if (!empty($_FILES["how_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["how_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'how_pic-' . date('YmdHis');
            $file_name = 'how_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'how_pic' => $file_name,
			);
			$this->db->where('id', 1);
        	$this->db->update('ref_how', $data1);

            $this->doUpload('./assets/img/how/', 'how_pic', $file_name_upload);
        }

		$this->db->where('id', 1);
        $this->db->update('ref_how', $data);
        
        redirect('how-page');
    }

    public function update_how_page_related()
    {
        $data = array(
			'related_title' => $this->input->post('related_title'),
            'related_desc' => $this->input->post('related_desc'),
			'updated_at' => $this->input->post('updated_at'),
        );

		$this->db->where('id', 1);
        $this->db->update('ref_how', $data);
        
        redirect('how-page');
    }


	public function categories()
    {
		  
        $data['title'] = 'Categories Page';
        $data['content'] = 'categories';

        $this->load->view('layouts/master', $data);
    }

	public function get_categories()
    {
		  
        echo json_encode($this->db->select('*')->from('ref_categories')->get()->result());
    }

	public function add_category(){
		$data = array(
            'cat_name' => $this->input->post('cat_name'),
            'cat_color' => $this->input->post('cat_color'),
			'cat_created_at'	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('ref_categories', $data);

		redirect('event/categories');
	}

	public function edit_category()
    {
		$id = $this->input->post('cat_id');
        $data = array(
            'cat_name' => $this->input->post('cat_name_edit'),
            'cat_color' => $this->input->post('cat_color_edit'),
			'cat_updated_at'	=> date('Y-m-d H:i:s')
        );

		$this->db->where('cat_id', $id);
        $this->db->update('ref_categories', $data);
        
        redirect('event/categories');
    }

	public function event_page()
    {
		  
        $data['title'] = 'Event Page';
        $data['content'] = 'event_page';
		$data['home'] = $this->db->select('*')->from('ref_event')->where('id', 1)->get()->row();
		$data['event'] = $this->db->select('*')->from('ta_event')->join('ref_categories','cat_id=event_cat_id', 'left')->where('event_flag', 1)->order_by('event_id', 'desc')->get()->result();


        $this->load->view('layouts/master', $data);
    }

	public function add_newest_event(){
		$data = array(
            'new_event_id' => $this->input->post('new_event_id'),
		);

		$this->db->insert('ta_newest_event', $data);

		redirect('event/page');
	}

	public function update_event_page()
    {
        $data = array(
            'event_title' => $this->input->post('event_title'),
            'event_desc' => $this->input->post('event_desc'),
        );

		$this->db->where('id', 1);
        $this->db->update('ref_event', $data);
        
        redirect('event/page');
    }

	public function add_event()
    {
        $data['title'] = 'Add Event';
        $data['content'] = 'add_event';
		$data['categories'] = $this->db->select('*')->from('ref_categories')->get()->result();
        $this->load->view('layouts/master', $data);
    }

	public function event_list(){
		$data = $this->db->select('*')->from('ta_event')->join('ref_categories','cat_id=event_cat_id', 'left')->where('event_flag', 1)->order_by('event_id', 'desc')->get()->result();
		echo json_encode($data);
	}

	public function event_list_newest(){
		$data = $this->db->select('*')->from('ta_newest_event')->join('ta_event','new_event_id=event_id', 'left')->join('ref_categories','cat_id=event_cat_id', 'left')->where('event_flag', 1)->get()->result();
		echo json_encode($data);
	}

	public function delete_category()
    {
        $id = $this->input->post('cat_id');

		$this->db->where('cat_id', $id);
		$this->db->delete('ref_categories');

		$this->db->where('event_cat_id', $id);
		$this->db->delete('ta_event');
        echo json_encode(true);       
    }

	public function delete_event()
    {
        $id = $this->input->post('event_id');

		$this->db->where('event_id', $id);
		$this->db->delete('ta_event');

		$this->db->where('det_event_id', $id);
		$this->db->delete('ta_det_event');
        echo json_encode(true);       
    }

	public function delete_newest_event()
    {
        $id = $this->input->post('new_id');

		$this->db->where('new_id', $id);
		$this->db->delete('ta_newest_event');
        echo json_encode(true);       
    }

	public function add_new_event(){
		$data = array(
            'event_name' => $this->input->post('event_name'),
            'event_date' => $this->input->post('event_date'),
            'event_desc' => $this->input->post('event_desc'),
			'event_cat_id' => $this->input->post('event_cat_id'),
			'event_flag' => 1,
			'event_created_at'	=> date('Y-m-d H:i:s'),
			'event_updated_at'	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('ta_event', $data);
		$id =  $this->db->insert_id();

		if (!empty($_FILES["event_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["event_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'event_pic-' . date('YmdHis');
            $file_name = 'event_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'event_pic' => $file_name,
			);
			$this->db->where('event_id', $id);
        	$this->db->update('ta_event', $data1);

            $this->doUpload('./assets/img/event/', 'event_pic', $file_name_upload);
        }

		redirect('event/page');
	}

	public function edit_event($id)
    {
        $data['title'] = 'Edit Event';
        $data['content'] = 'update_event';
		$data['product'] = $this->db->select('*')->from('ta_event')->where('event_id', $id)->get()->row();
		$data['categories'] = $this->db->select('*')->from('ref_categories')->get()->result();
        $this->load->view('layouts/master', $data);
    }

	public function event_photos($id){
		$data['title'] = 'Event Photos';
        $data['content'] = 'event_photos';
		$data['product'] = $this->db->select('*')->from('ta_event')->where('event_id', $id)->get()->row();

        $this->load->view('layouts/master', $data);
	}

	public function event_photos_list($id){
        $data = $this->db->select('*')->from('ta_det_event')->where('det_event_id', $id)->get()->result();
		echo json_encode($data);
	}

	function remove_event_foto(){
		$id = $this->input->post('det_id');

		$this->db->where('det_id', $id);
		$this->db->delete('ta_det_event');
        echo json_encode(true); 
	}

	function add_event_foto(){
		$id = $this->input->post('det_event_id');
		$data = array(
			'det_event_id' => $id,
			'det_title' => $this->input->post('det_title'),
			'det_created_at'	=> date('Y-m-d H:i:s')
        );

		$this->db->insert('ta_det_event', $data);
		$ids =  $this->db->insert_id();

		if (!empty($_FILES["det_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["det_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'det_pic-' . date('YmdHis');
            $file_name = 'det_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'det_pic' => $file_name,
			);
			$this->db->where('det_id', $ids);
        	$this->db->update('ta_det_event', $data1);

            $this->doUpload('./assets/img/event/', 'det_pic', $file_name_upload);
        }

		redirect('event/photos/'.$id);
	}

	

	public function analytic(){
		$data['title'] = 'Analytic';
        $data['content'] = 'analytic';
		$data['today'] = $this->db->select('*')->from('ta_activity')->like('act_date', date('Y-m-d'))->get()->num_rows();
		$data['all'] = $this->db->select('*')->from('ta_activity')->get()->num_rows();
        $this->load->view('layouts/master', $data);
	}


	public function analytic_list(){
		$data = $this->db->select('*')->from('ta_activity')->join('ref_user','user_id=act_user_id','left')->order_by('act_date', 'desc')->get()->result();
		foreach ($data as $key => $value) {
			if($value->act_event_id != null){
				$data[$key]->event = $this->db->select('*')->from('ta_event')->where('event_id', $value->act_event_id)->get()->row();
				$data[$key]->product = null;
			}else{
				$data[$key]->product = $this->db->select('*')->from('ta_product')->where('product_id', $value->act_product_id)->get()->row();
				$data[$key]->event = null;
			}
		}

		echo json_encode($data);
	}

	public function get_excel($tgl1, $tgl2){
		$data = $this->db->select('*')->from('ta_activity')->join('ref_user','user_id=act_user_id','left')->where('date >=', $tgl1)
                    ->where('date <=', $tgl2)->order_by('act_date', 'desc')->get()->result();
		foreach ($data as $key => $value) {
			if($value->act_event_id != null){
				$data[$key]->event = $this->db->select('*')->from('ta_event')->where('event_id', $value->act_event_id)->get()->row();
				$data[$key]->product = null;
			}else{
				$data[$key]->product = $this->db->select('*')->from('ta_product')->where('product_id', $value->act_product_id)->get()->row();
				$data[$key]->event = null;
			}
		}

		
		$this->generate_excel($tgl1, $tgl2, $data);
	}

	public function generate_excel($tgl1, $tgl2, $data){
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Data Export '.$tgl1.' - '. $tgl2);
		$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);

        $spreadsheet->getActiveSheet()->mergeCells('A1:C1');
        $sheet->setCellValue('A2', 'Customer Name');
		 $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
        $sheet->getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
        $sheet->getStyle('A2')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A2')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A2')->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A2')->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);

        $sheet->setCellValue('B2', 'DateTime');
		 $sheet->getStyle('B2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
        $sheet->getStyle('B2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
        $sheet->getStyle('B2')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('B2')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('B2')->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('B2')->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		
        $sheet->setCellValue('C2', 'Note');
		$sheet->getStyle('C2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
        $sheet->getStyle('C2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
        $sheet->getStyle('C2')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('C2')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('C2')->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

        $firstRow = 2;
        $i = $firstRow;
        $index = 0;
        foreach ($data as $key => $row) {
            $i = $i + 1;
            $index = $index + 1;
            $sheet->getRowDimension($i)->setRowHeight(20);
            $sheet->setCellValue('A' . $i, $row->user_name);
            $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
            $sheet->getStyle('A' . $i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
            $sheet->getStyle('A' . $i)->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('A' . $i)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('A' . $i)->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('A' . $i)->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);

			$sheet->setCellValue('B' . $i, $row->act_date);
            $sheet->getStyle('B' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
            $sheet->getStyle('B' . $i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
            $sheet->getStyle('B' . $i)->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B' . $i)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B' . $i)->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B' . $i)->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);

			if($row->event != null){
				$sheet->setCellValue('C' . $i, $row->user_name.' has opened the page '.$row->event->event_name);
				$sheet->getStyle('C' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
				$sheet->getStyle('C' . $i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
				$sheet->getStyle('C' . $i)->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
				$sheet->getStyle('C' . $i)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
				$sheet->getStyle('C' . $i)->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
				$sheet->getStyle('C' . $i)->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);

			}else{
				$sheet->setCellValue('C' . $i, $row->user_name.' has opened the page '.$row->product->product_name);
				$sheet->getStyle('C' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
				$sheet->getStyle('C' . $i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
				$sheet->getStyle('C' . $i)->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
				$sheet->getStyle('C' . $i)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
				$sheet->getStyle('C' . $i)->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
				$sheet->getStyle('C' . $i)->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);

			}
			
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'Data Export '.$tgl1.' - '. $tgl2;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
	}
	
	// function tgl_indo($tanggal)
    // {
    //     $day = date('D', strtotime($tanggal));
    //     $dayList = array(
    //         'Sun' => 'Minggu',
    //         'Mon' => 'Senin',
    //         'Tue' => 'Selasa',
    //         'Wed' => 'Rabu',
    //         'Thu' => 'Kamis',
    //         'Fri' => 'Jumat',
    //         'Sat' => 'Sabtu'
    //     );

    //     $bulan = array(
    //         1 =>   'Januari',
    //         'Februari',
    //         'Maret',
    //         'April',
    //         'Mei',
    //         'Juni',
    //         'Juli',
    //         'Agustus',
    //         'September',
    //         'Oktober',
    //         'November',
    //         'Desember'
    //     );
    //     $pecahkan = explode('-', $tanggal);

    //     return $dayList[$day] . ', ' . $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    // }

	public function post_edit_event(){
        $id = $this->input->post('event_id');
        $data = array(
            'event_name' => $this->input->post('event_name'),
            'event_date' => $this->input->post('event_date'),
            'event_desc' => $this->input->post('event_desc'),
			'event_cat_id' => $this->input->post('event_cat_id'),
			'event_updated_at'	=> date('Y-m-d H:i:s')
		);

		if (!empty($_FILES["event_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["event_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'event_pic-' . date('YmdHis');
            $file_name = 'event_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'event_pic' => $file_name,
			);
			$this->db->where('event_id', $id);
        	$this->db->update('ta_event', $data1);

            $this->doUpload('./assets/img/event/', 'event_pic', $file_name_upload);
        }

		$this->db->where('event_id', $id);
        $this->db->update('ta_event', $data);

		redirect('event/page');
    }

	//end event
	public function product_page()
    {
		  
        $data['title'] = 'Product Page';
        $data['content'] = 'product_page';
		$data['home'] = $this->db->select('*')->from('ref_product')->where('id', 1)->get()->row();

        $this->load->view('layouts/master', $data);
    }

	public function add_product()
    {
        $data['title'] = 'Add Product';
        $data['content'] = 'add_product';
        $this->load->view('layouts/master', $data);
    }

	public function update_product_page()
    {
        $data = array(
            'newest_title' => $this->input->post('newest_title'),
            'newest_desc' => $this->input->post('newest_desc'),
			'our_title' => $this->input->post('our_title'),
            'our_desc' => $this->input->post('our_desc'),
			'updated_at' => $this->input->post('updated_at'),
        );

		$this->db->where('id', 1);
        $this->db->update('ref_product', $data);
        
        redirect('product-page');
    }

	public function product_list(){
		$data = $this->db->select('*')->from('ta_product')->order_by('product_id', 'desc')->get()->result();
		echo json_encode($data);
	}

	public function delete_product()
    {
        $id = $this->input->post('product_id');

		$this->db->where('product_id', $id);
		$this->db->delete('ta_product');

		$this->db->where('det_product_id', $id);
		$this->db->delete('ta_det_product');
        echo json_encode(true);       
    }

	public function add_new_product(){
		$data = array(
            'product_name' => $this->input->post('product_name'),
            'product_price' => $this->input->post('product_price'),
            'product_desc' => $this->input->post('product_desc'),
			'product_created_at'	=> date('Y-m-d H:i:s'),
			'product_updated_at'	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('ta_product', $data);
		$id =  $this->db->insert_id();

		if (!empty($_FILES["product_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["product_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'product_pic-' . date('YmdHis');
            $file_name = 'product_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'product_pic' => $file_name,
			);
			$this->db->where('product_id', $id);
        	$this->db->update('ta_product', $data1);

            $this->doUpload('./assets/img/product/', 'product_pic', $file_name_upload);
        }

		redirect('product-page');
	}

	public function edit_product($id)
    {
        $data['title'] = 'Edit Product';
        $data['content'] = 'update_product';
		$data['product'] = $this->db->select('*')->from('ta_product')->where('product_id', $id)->get()->row();
        $this->load->view('layouts/master', $data);
    }

	public function product_photos($id){
		$data['title'] = 'Product Photos';
        $data['content'] = 'product_photos';
		$data['product'] = $this->db->select('*')->from('ta_product')->where('product_id', $id)->get()->row();

        $this->load->view('layouts/master', $data);
	}

	public function product_photos_list($id){
        $data = $this->db->select('*')->from('ta_det_product')->where('det_product_id', $id)->get()->result();
		echo json_encode($data);
	}

	function remove_product_foto(){
		$id = $this->input->post('det_id');

		$this->db->where('det_id', $id);
		$this->db->delete('ta_det_product');
        echo json_encode(true); 
	}

	function add_product_foto(){
		$id = $this->input->post('det_product_id');
		$data = array(
			'det_product_id' => $id,
			'det_title' => $this->input->post('det_title'),
			'det_created_at'	=> date('Y-m-d H:i:s')
        );

		$this->db->insert('ta_det_product', $data);
		$ids =  $this->db->insert_id();

		if (!empty($_FILES["det_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["det_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'det_pic-' . date('YmdHis');
            $file_name = 'det_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'det_pic' => $file_name,
			);
			$this->db->where('det_id', $ids);
        	$this->db->update('ta_det_product', $data1);

            $this->doUpload('./assets/img/product/', 'det_pic', $file_name_upload);
        }

		redirect('product/photos/'.$id);
	}


	public function post_edit_product(){
        $id = $this->input->post('product_id');
        $data = array(
            'product_name' => $this->input->post('product_name'),
            'product_price' => $this->input->post('product_price'),
            'product_desc' => $this->input->post('product_desc'),
			'product_updated_at'	=> date('Y-m-d H:i:s')
		);

		if (!empty($_FILES["product_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["product_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'product_pic-' . date('YmdHis');
            $file_name = 'product_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'product_pic' => $file_name,
			);
			$this->db->where('product_id', $id);
        	$this->db->update('ta_product', $data1);

            $this->doUpload('./assets/img/product/', 'product_pic', $file_name_upload);
        }

		$this->db->where('product_id', $id);
        $this->db->update('ta_product', $data);

		redirect('product-page');
    }

	public function home_page()
    {
        $data['title'] = 'Home Page';
        $data['content'] = 'home_page';
		$data['home'] = $this->db->select('*')->from('ref_home')->where('id', 1)->get()->row();

        $this->load->view('layouts/master', $data);
    }

	public function update_home_page()
    {
        $data = array(
            'mission_title' => $this->input->post('mission_title'),
            'mission_desc' => $this->input->post('mission_desc'),
			'intro_title' => $this->input->post('intro_title'),
            'intro_desc' => $this->input->post('intro_desc'),
			'updated_at' => $this->input->post('updated_at'),
        );

		if (!empty($_FILES["intro_pic"]["name"])) {
            $file_ext = pathinfo($_FILES["intro_pic"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'intro_pic-' . date('YmdHis');
            $file_name = 'intro_pic-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'intro_pic' => $file_name,
			);
			$this->db->where('id', 1);
        	$this->db->update('ref_home', $data1);

            $this->doUpload('./assets/img/intro/', 'intro_pic', $file_name_upload);
        }

		$this->db->where('id', 1);
        $this->db->update('ref_home', $data);
        
        redirect('home-page');
    }

	public function update_slider1_page()
    {
        $data = array(
			'slider1_title' => $this->input->post('slider1_title'),
        );

		if (!empty($_FILES["slider1"]["name"])) {
            $file_ext = pathinfo($_FILES["slider1"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'slider1-' . date('YmdHis');
            $file_name = 'slider1-' . date('YmdHis') . '.' . $file_ext;

			$data1 = array(
				'slider1' => $file_name,
			);
			$this->db->where('id', 1);
        	$this->db->update('ref_home', $data1);

            $this->doUpload('./assets/img/slider/', 'slider1', $file_name_upload);
        }

		$this->db->where('id', 1);
        $this->db->update('ref_home', $data);
        
        redirect('home-page');
    }

	public function update_slider2_page()
    {
        $data = array(
            'slider2_title' => $this->input->post('slider2_title'),
        );

		if (!empty($_FILES["slider2"]["name"])) {
            $file_ext = pathinfo($_FILES["slider2"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'slider2-' . date('YmdHis');
            $file_name = 'slider2-' . date('YmdHis') . '.' . $file_ext;

			$data2 = array(
				'slider2' => $file_name,
			);
			$this->db->where('id', 1);
        	$this->db->update('ref_home', $data2);
			
            $this->doUpload('./assets/img/slider/', 'slider2', $file_name_upload);
        }

		$this->db->where('id', 1);
        $this->db->update('ref_home', $data);
        
        redirect('home-page');
    }

	public function update_slider3_page()
    {
        $data = array(
			'slider3_title' => $this->input->post('slider3_title'),
        );

		if (!empty($_FILES["slider3"]["name"])) {
            $file_ext = pathinfo($_FILES["slider3"]["name"], PATHINFO_EXTENSION);
            $file_name_upload = 'slider3-' . date('YmdHis');
            $file_name = 'slider3-' . date('YmdHis') . '.' . $file_ext;

			$data3 = array(
				'slider3' => $file_name,
			);
			$this->db->where('id', 1);
        	$this->db->update('ref_home', $data3);
			
            $this->doUpload('./assets/img/slider/', 'slider3', $file_name_upload);
        }

		$this->db->where('id', 1);
        $this->db->update('ref_home', $data);
        
        redirect('home-page');
    }













	public function top_page()
    {
        $data['title'] = 'Top Page';
        $data['content'] = 'top_page';
		$data['top'] = $this->model->get_top($this->session->userdata('admin_negara_id'));

        $this->load->view('layouts/master', $data);
    }

	public function update_top_page()
    {
        $data = array(
            'top_title' => $this->input->post('top_title'),
            'top_desc' => $this->input->post('top_desc'),
			'top_pic' => $this->input->post('top_pic'),
        );

        $this->model->update_top_page($this->session->userdata('admin_negara_id'), $data);
        
        redirect('top-page');
    }

	public function activity()
    {
        $data['title'] = 'Activity';
        $data['content'] = 'activity_page';
        $data['activity'] = $this->model->get_activity($this->session->userdata('admin_negara_id'));

        $this->load->view('layouts/master', $data);
    }

    public function update_activity()
    {
        $data = array(
            'activity_title' => $this->input->post('activity_title'),
            'activity_desc' => $this->input->post('activity_desc'),
			'activity_pic' => $this->input->post('activity_pic'),

            'activity_cul_title' => $this->input->post('activity_cul_title'),
            'activity_cul_desc' => $this->input->post('activity_cul_desc'),
			'activity_cul_pic' => $this->input->post('activity_cul_pic'),

            'activity_agri_title' => $this->input->post('activity_agri_title'),
            'activity_agri_desc' => $this->input->post('activity_agri_desc'),
			'activity_agri_pic' => $this->input->post('activity_agri_pic'),

            'activity_soc_title' => $this->input->post('activity_soc_title'),
            'activity_soc_desc' => $this->input->post('activity_soc_desc'),
			'activity_soc_pic' => $this->input->post('activity_soc_pic'),
        );

        $this->model->update_activity($this->session->userdata('admin_negara_id'), $data);
        
        redirect('activity');
    }

	public function news_page()
    {
        $data['title'] = 'News Page';
        $data['content'] = 'news_page';
        $data['news'] = $this->model->get_news($this->session->userdata('admin_negara_id'));

        $this->load->view('layouts/master', $data);
    }

    public function update_news_page()
    {
        $data = array(
            'news_title' => $this->input->post('news_title'),
            'news_desc' => $this->input->post('news_desc'),
			'news_pic' => $this->input->post('news_pic')
        );

        $this->model->update_news($this->session->userdata('admin_negara_id'), $data);
        
        redirect('news-page');
    }

	// public function product_page()
    // {
    //     $data['title'] = 'Product Page';
    //     $data['content'] = 'product_page';
    //     $data['product'] = $this->model->get_product($this->session->userdata('admin_negara_id'));

    //     $this->load->view('layouts/master', $data);
    // }

    // public function update_product_page()
    // {
    //     $data = array(
    //         'product_title' => $this->input->post('product_title'),
    //         'product_desc' => $this->input->post('product_desc'),
	// 		'product_pic' => $this->input->post('product_pic')
    //     );

    //     $this->model->update_product($this->session->userdata('admin_negara_id'), $data);
        
    //     redirect('product-page');
    // }

	public function video()
    {
        $data['title'] = 'Video Links';
        $data['content'] = 'video';
        $data['channel'] = $this->db->select('*')->from('ref_channel')->where('channel_negara_id',$this->session->userdata('admin_negara_id'))->get()->row();

        $this->load->view('layouts/master', $data);
    }

	public function delete_video(){
		$id=$this->input->post('video_id');
		echo json_encode($this->db->delete('ref_video',array('video_id'=>$id)));
	}

	public function get_video(){
		$data = $this->db->select('*')->from('ref_video')->where('video_negara_id', $this->session->userdata('admin_negara_id'))->get()->result();
		echo json_encode($data);
	}

	public function item_video(){
		$data = $this->db->select('*')->from('ref_video')->where('video_id', $this->input->post('video_id'))->get()->row();
		echo json_encode($data);
	}

	public function add_video(){
		$data = array(
			'video_link'	=> $this->input->post('video_link'),
			'video_title'	=> $this->input->post('video_title'),
			'video_negara_id'	=> $this->session->userdata('admin_negara_id')
		);

		echo json_encode($this->db->insert('ref_video', $data));
	}

	public function update_link()
    {
        $data = array(
            'channel_link' => $this->input->post('link'),
			'channel_desc'	=> $this->input->post('desc')
        );

        $this->db->where('channel_negara_id', $this->session->userdata('admin_negara_id'));
        echo json_encode($this->db->update('ref_channel', $data));
    }

    public function edit_video()
    {
        $data = array(
            'video_link' => $this->input->post('video_link'),
			'video_title'	=> $this->input->post('video_title')
        );

        $this->db->where('video_id', $this->input->post('video_id'));
        echo json_encode($this->db->update('ref_video', $data));
    }

	public function footer()
    {
        $data['title'] = 'Footer';
        $data['content'] = 'footer';
        $data['negara_info'] = $this->model->get_footer($this->session->userdata('admin_negara_id'));

        $this->load->view('layouts/master', $data);
    }

    public function update_footer()
    {
        $data = [
            'negara_telp' => $this->input->post('negara_telp'),
            'negara_email' => $this->input->post('negara_email'),
            'negara_footer_desc' => $this->input->post('negara_footer_desc'),
        ];

        $id = $this->session->userdata('admin_negara_id');

        $this->model->update_footer($id,$data);
		redirect('footer');  
    }

	public function short_desc()
    {
        $data['title'] = 'Short Description';
        $data['content'] = 'short_desc';
        $data['short_desc'] = $this->model->get_footer($this->session->userdata('admin_negara_id'));

        $this->load->view('layouts/master', $data);
    }

    public function update_short_desc()
    {
        $data = [
            'negara_short_desc' => $this->input->post('short_desc')
        ];

        $id = $this->session->userdata('admin_negara_id');

        $this->model->update_footer($id,$data);
			redirect('short-desc');       
    }

	public function photos()
    {
        $data['title'] = 'Photos';
        $data['content'] = 'photos';
        $data['data_photos']  = $this->model->get_photos($this->session->userdata('admin_negara_id'));

        $this->load->view('layouts/master', $data);
    }

	function remove_foto(){
		$id=$this->input->post('negara_foto_id');
		echo json_encode($this->db->delete('ref_negara_foto',array('negara_foto_id'=>$id)));
	}

	function add_foto(){
		$foto_path=$this->input->post('foto_path');
		$data = array(
            'foto_path' => $foto_path,
			'foto_negara_id' => $this->session->userdata('admin_negara_id'),
			'created_at'	=> date('Y-m-d H:is')
        );

		echo json_encode($this->db->insert('ref_negara_foto',$data));
	}

	public function region_info()
    {
        $data['title'] = 'Region Information';
        $data['content'] = 'region_info';
        $data['negara_info'] = $this->model->get_footer($this->session->userdata('admin_negara_id'));

        $this->load->view('layouts/master', $data);
    }

    public function update_region_info()
    {
        $data = [
            'negara_information' => $this->input->post('negara_info')
        ];

        $id = $this->session->userdata('admin_negara_id');

        $this->model->update_footer($id,$data);
		redirect('region-info');
    }

	public function news()
    {
        $data['title'] = 'News';
        $data['content'] = 'news';
        $this->load->view('layouts/master', $data);
    }

	public function news_photos($id){
		$data['title'] = 'Photos';
        $data['content'] = 'photos_news';
        $data['data_photos']  = $this->model->get_news_photos($id);
		$data['news'] = $this->model->get_news_negara_row($id);

        $this->load->view('layouts/master', $data);
	}

	public function delete_news()
    {
        $data = [
            'news_aktif' => 0
        ];

        $id = $this->input->post('news_id');

        echo json_encode($this->model->update_news_negara($id,$data));       
    }

	public function delete_activities()
    {
        $data = [
            'activities_aktif' => 0
        ];

        $id = $this->input->post('activities_id');

        echo json_encode($this->model->update_activities_negara($id,$data));       
    }

	function remove_news_foto(){
		$id=$this->input->post('news_foto_id');
		echo json_encode($this->db->delete('ta_news_foto',array('news_foto_id'=>$id)));
	}

	function add_news_foto(){
		$foto_path=$this->input->post('news_foto_path');
		$id = $this->input->post('news_id');
		$data = array(
			'news_foto_news_id' => $id,
            'news_foto_path' => $foto_path,
			'news_foto_negara_id' => $this->session->userdata('admin_negara_id'),
			'news_foto_created_at'	=> date('Y-m-d H:is')
        );

		echo json_encode($this->db->insert('ta_news_foto',$data));
	}

	function add_activities_foto(){
		$foto_path=$this->input->post('activities_foto_path');
		$id = $this->input->post('activities_id');
		$data = array(
			'activities_foto_activities_id' => $id,
            'activities_foto_path' => $foto_path,
			'activities_foto_negara_id' => $this->session->userdata('admin_negara_id'),
			'activities_foto_created_at'	=> date('Y-m-d H:is')
        );

		echo json_encode($this->db->insert('ta_activities_foto',$data));
	}

	function remove_activities_foto(){
		$id=$this->input->post('activities_foto_id');
		echo json_encode($this->db->delete('ta_activities_foto',array('activities_foto_id'=>$id)));
	}

	

	public function add_new_news(){
		$data = array(
            'news_judul' => $this->input->post('news_judul'),
            'news_lat' => $this->input->post('news_lat'),
            'news_long' => $this->input->post('news_long'),
			'news_lokasi' => $this->input->post('news_lokasi'),
            'news_deskripsi' => $this->input->post('news_deskripsi'),
            'news_situasi' => $this->input->post('news_situasi'),
            'news_penanganan' => $this->input->post('news_penanganan'),
            'news_lakukan' => $this->input->post('news_lakukan'),
            'news_rekomendasi' => $this->input->post('news_rekomendasi'),
            'news_negara_id' => $this->session->userdata('admin_negara_id'),
			'news_created_at'	=> date('Y-m-d H:i:s'),
			'news_updated_at'	=> date('Y-m-d H:i:s')
		);

        $this->model->add_new_news($data);
		redirect('news');
	}

	public function add_new_activities(){
		$data = array(
			'activities_cat_id' => $this->input->post('activities_cat_id'),
            'activities_title' => $this->input->post('activities_title'),
            'activities_lat' => $this->input->post('activities_lat'),
            'activities_long' => $this->input->post('activities_long'),
			'activities_lokasi' => $this->input->post('activities_lokasi'),
            'activities_deskripsi' => $this->input->post('activities_deskripsi'),
            'activities_negara_id' => $this->session->userdata('admin_negara_id'),
			'activities_created_at'	=> date('Y-m-d H:i:s'),
			'activities_updated_at'	=> date('Y-m-d H:i:s')
		);

        $this->model->add_new_activities($data);
		redirect('activities');
	}

	public function post_edit_activities(){
        $id = $this->input->post('activities_id');
        $data = array(
			'activities_cat_id' => $this->input->post('activities_cat_id'),
            'activities_title' => $this->input->post('activities_title'),
            'activities_lat' => $this->input->post('activities_lat'),
            'activities_long' => $this->input->post('activities_long'),
			'activities_lokasi' => $this->input->post('activities_lokasi'),
            'activities_deskripsi' => $this->input->post('activities_deskripsi'),
            'activities_negara_id' => $this->session->userdata('admin_negara_id'),
			'activities_created_at'	=> date('Y-m-d H:i:s'),
			'activities_updated_at'	=> date('Y-m-d H:i:s')
		);

        $update= $this->model->update_activities_negara($id, $data);
		redirect('activities');
    }

	public function post_edit_news(){
        $id = $this->input->post('news_id');
        $data = array(
            'news_judul' => $this->input->post('news_judul'),
            'news_lat' => $this->input->post('news_lat'),
            'news_long' => $this->input->post('news_long'),
			'news_lokasi' => $this->input->post('news_lokasi'),
            'news_deskripsi' => $this->input->post('news_deskripsi'),
            'news_situasi' => $this->input->post('news_situasi'),
            'news_penanganan' => $this->input->post('news_penanganan'),
            'news_lakukan' => $this->input->post('news_lakukan'),
            'news_rekomendasi' => $this->input->post('news_rekomendasi'),
            'news_negara_id' => $this->session->userdata('admin_negara_id'),
			'news_created_at'	=> date('Y-m-d H:i:s'),
			'news_updated_at'	=> date('Y-m-d H:i:s')
		);

        $update= $this->model->update_news_negara($id, $data);
		redirect('news');
    }

	public function get_news_negara(){
		echo json_encode($this->model->get_news_negara($this->session->userdata('admin_negara_id')));
	}

	public function add_news()
    {
        $data['title'] = 'News';
        $data['content'] = 'add_news';
        $this->load->view('layouts/master', $data);
    }

	public function edit_news($id)
    {
        $data['title'] = 'Edit News';
        $data['content'] = 'edit_news';
		$data['news'] = $this->model->get_news_negara_row($id);
        $this->load->view('layouts/master', $data);
    }

	public function add_activities()
    {
        $data['title'] = 'Activities';
        $data['content'] = 'add_activities';
        $this->load->view('layouts/master', $data);
    }

	public function edit_activities($id)
    {
        $data['title'] = 'Edit Activities';
        $data['content'] = 'edit_activities';
		$data['activities'] = $this->model->get_activities_negara_row($id);
        $this->load->view('layouts/master', $data);
    }

	

	public function product()
    {
        $data['title'] = 'Product';
        $data['content'] = 'product';
        $this->load->view('layouts/master', $data);
    }

	public function get_activities_negara(){
		echo json_encode($this->model->get_activities_negara($this->session->userdata('admin_negara_id')));
	}

	private function doUpload($upload_path, $key, $file_name)
	{
		$config['upload_path']   = $upload_path;
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';
		$config['file_name']     = $file_name;
		$config['overwrite']     = 'TRUE';
		$this->load->library('upload', $config);
		$this->upload->do_upload($key);
    }
	
	public function activities()
    {
        $data['title'] = 'Activities';
        $data['content'] = 'activities';
        $this->load->view('layouts/master', $data);
    }

	public function activities_photos($id){
		$data['title'] = 'Activities Photos';
        $data['content'] = 'photos_activities';
        $data['data_photos']  = $this->model->get_activities_photos($id);
		$data['activities'] = $this->model->get_activities_negara_row($id);

        $this->load->view('layouts/master', $data);
	}



}


/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
