<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hero extends CI_Controller {

	public function index($idjenishero)
	{
		$this->load->model('jenishero_model');
		$data["hero_list"] = $this->jenishero_model->getHeroByJenisHero($idjenishero);
		$this->load->view('hero',$data);	
	}

	public function create($idjenishero)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('jenishero_model');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_hero_view');

		}else{
			$config['upload_path']			='./assets/uploads/';
			$config['allowed_types']		='gif|jpg|png';
			$config['max_size']				=1000000000;
			$config['max_width']			=10240;
			$config['max_height']			=7680;
			$this->load->library('upload', $config);
			if( ! $this->upload->do_upload('userfile'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('tambah_pegawai_view', $error);

			}
		else
			{
			$this->jenishero_model->insertHero($idjenishero);
			$this->load->view('tambah_hero_sukses');
			}
		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('jenishero_model');
		$data['jenishero']=$this->jenishero_model->getHero($id);
		$data2= $this->jenishero_model->getHero($id);
		$namaFile = $data2[0]->foto;
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_hero_view',$data);

			}else{
			$config['upload_path']			='./assets/uploads';
			$config['allowed_types']		='gif|jpg|png';
			$config['max_size']				=1000000000;
			$config['max_width']			=10240;
			$config['max_height']			=7680;
			$this->load->library('upload', $config);
			if( ! $this->upload->do_upload('userfile'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('tambah_hero_view', $error);

			}
			else
			{
			$this->jenishero_model->updateByIdHero($id);
			unlink('assets/uploads/',$namaFile);
			$this->load->view('edit_hero_sukses');
			}
		}
	}

	public function delete($id)
	{
		$this->load->model('jenishero_model');
		$data["jenishero_list"] = $this->jenishero_model->deleteByIdHero($id);
		redirect('jenishero/index/');
	 
		//$this->load->view('hapus_hero_sukses',$data);
		
	}

	public function datatable($idjenishero)
	{
	 	$this->load->model('jenishero_model');
	 	$data["hero_list"] = $this->jenishero_model->getDataHero($idjenishero);
	 	$this->load->view('jenishero_datatable',$data);
	}


}

/* End of file Jenishero.php */
/* Location: ./application/controllers/Jenishero.php */

 ?>