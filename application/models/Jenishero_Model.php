<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenishero_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataJenisHero()
		{
			$this->db->select("id,keterangan");
			$query = $this->db->get('jenis_hero');
			return $query->result();
		}

		public function getHeroByJenisHero($idJenishero)
		{
			$this->db->select("hero.id,nama, DATE_FORMAT(tanggal_Lahir,'%d-%m-%Y') as tanggalLahir, foto");
			$this->db->where('fk_jenis', $idJenishero);	
			$this->db->join('jenis_hero', 'jenis_hero.id = hero.fk_jenis', 'left');	
			$query = $this->db->get('hero');
			return $query->result();
		}
		
		public function insertJenisHero()
		{
			$object = array(
			'keterangan' => $this->input->post('keterangan'),
			);	

			$this->db->insert('jenis_hero', $object);
		}


		public function getJenisHero($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('jenis_hero',1);
			return $query->result();

		}

		public function updateByIdJenis($id)
		{
			$data = array(
			'keterangan' => $this->input->post('keterangan'),
			);	
			$this->db->where('id', $id);
			$this->db->update('jenis_hero', $data);

		}

		public function deleteByIdJenis($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('hero');

			$this->db->where('id', $id);
			$this->db->delete('jenis_hero');
		}		

		public function insertHero($idJenishero)
		{
			$object = array(
			'nama' => $this->input->post('nama'), 
			'tanggal_Lahir' => $this->input->post('tanggalLahir'), 	
			'foto' => $this->upload->data('file_name'),
			'fk_jenis'=> $idJenishero		
			);	

			$this->db->insert('hero', $object);
		}

		public function getHero($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('hero',1);
			return $query->result();

		}

		public function UpdateByIdHero($id)
		{
		$data = array(
			'keterangan' => $this->input->post('keterangan'),
			);	
			$this->db->where('id', $id);
			$this->db->update('jenis_hero', $data);
			
		}
		public function deleteByIdHero($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('hero');
		}

		
}

/* End of file Jenishero_Model.php */
/* Location: ./application/models/Jenishero_Model.php */
 ?>