<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenishero extends CI_Controller {

	public function index()
	{
		$this->load->model('jenishero_model');
		$data["jenishero_list"] = $this->jenishero_model->getDataJenisHero();
		$this->load->view('jenishero_datatable',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$this->load->model('jenishero_model');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_jenishero_view');

		}else
			{
			$this->jenishero_model->insertJenisHero();
			$this->load->view('tambah_jenishero_sukses');
			}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('jenishero_model');
		$data['jenishero']=$this->jenishero_model->getJenisHero($id);
//		$namaFile = $data['pegawai']->foto;
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_jenishero_view',$data);

			}
			else
			{
			$this->jenishero_model->updateByIdJenis($id);
//			unlink('assets/uploads/',$namaFile)
			$this->load->view('edit_jenishero_sukses');
			}
		
	}

	public function delete($id)
	{
		$this->load->model('jenishero_model');
		$data["jenishero_list"] = $this->jenishero_model->deleteByIdJenis($id);
		$this->load->view('hapus_jenishero_sukses',$data);
		
	}

	public function datatable()
	{
	 	$this->load->model('jenishero_model');
	 	$data["jenishero_list"] = $this->jenishero_model->getDataJenisHero();
	 	$this->load->view('jenishero_datatable',$data);
	}


}

/* End of file Jenishero.php */
/* Location: ./application/controllers/Jenishero.php */

 ?>