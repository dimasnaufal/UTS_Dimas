<?php 

	//echo "Sukses Update Data";
	//echo "</br>";
	//echo anchor('pegawai/update/'.$this->uri->segment(3), 'Update Data Lagi');
 ?>

 <?php 
//redirect('pegawai','refresh');
echo '<script language="javascript">';
echo 'alert("Data Berhasil Diupdate")';
echo '</script>';
 ?>

 <?php 
redirect('jenishero','refresh');
 ?>