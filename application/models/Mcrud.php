<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Model {

	var $tbl_users				 = 'tbl_user';



 	public static function tgl_id($date, $bln='')
 	{
	 date_default_timezone_set('Asia/Jakarta');
		 $str = explode('-', $date);
		 $bulan = array(
			 '01' => 'Januari',
			 '02' => 'Februari',
			 '03' => 'Maret',
			 '04' => 'April',
			 '05' => 'Mei',
			 '06' => 'Juni',
			 '07' => 'Juli',
			 '08' => 'Agustus',
			 '09' => 'September',
			 '10' => 'Oktober',
			 '11' => 'November',
			 '12' => 'Desember',
		 );
		 if ($bln == '') {
			 $hasil = $str['0'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[2];
		 }elseif ($bln == 'full') {
			 $hasil = $str['0'] . " " . $bulan[$str[1]] . " " .$str[2];
		 }else {
			 $hasil = $bulan[$str[1]];
		 }
		 return $hasil;
 	}

	public function hari_id($tanggal)
	{
		$day = date('D', strtotime($tanggal));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => "Jum'at",
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}

	public function get_users()
	{
			return $this->db->get_where($this->tbl_users, "dihapus='tidak'");
	}

	public function get_id_user($id)
	{
			return $this->db->get_where($this->tbl_users, array('id_user'=>$id,'dihapus'=>'tidak'));
	}

	public function get_level_users()
	{
			// $this->db->where('tbl_user.level', 'user');
			return $this->db->get_where($this->tbl_users, "dihapus='tidak'");
	}

	public function get_users_by_un($id)
	{
		return $this->db->get_where($this->tbl_users, array('username'=>"$id", "dihapus"=>'tidak'));
	}

	public function get_level_users_by_id($id)
	{
			$this->db->from($this->tbl_users);
			$this->db->where('tbl_user.dihapus', 'tidak');
			$this->db->where('tbl_user.level', 'obh');
			$this->db->where('tbl_user.id_user', $id);
			$query = $this->db->get();
			return $query->row();
	}

	public function divisi($divisi) {
		if ($divisi == 'admin') {
			$name = 'Administrasi';
		} elseif ($divisi == 'yankumham') {
			$name = 'Pelayanan Hukum dan HAM';
		} elseif ($divisi == 'pas') {
			$name = 'Pemasyarakatan';
		} elseif ($divisi == 'imi') {
			$name = 'Keimigrasian';
		} else {
			$name = '-';
		}

		return $name;
	}

	public function save_user($data)
	{
		$this->db->insert($this->tbl_users, $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_users, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_user_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_users);
	}

	public function waktu($data, $aksi='')
	{
		if ($aksi=='full') {
			$tgl_n = date('d-m-Y H:i:s',strtotime($data));
		}else {
			$tgl_n = date('d-m-Y',strtotime($data));
		}
		$hari = $this->Mcrud->hari_id($tgl_n);
		$tgl  = $this->Mcrud->tgl_id($tgl_n,$aksi);
		return $hari.", ".$tgl;
	}

	function judul_web($id='')
	{
		$nama_web = $this->db->get_where('tbl_web',"id_web='1'")->row()->nama_web;
		$ket_web  = $this->db->get_where('tbl_web',"id_web='1'")->row()->ket_web;
		if ($id==1) {
			$data = "$nama_web";
		}elseif ($id==2) {
			$data = "$ket_web";
		}else {
			$data = "$nama_web $ket_web";
		}
		return $data;
	}

	function footer()
	{
			return "Copyright &copy; 2019 | Developer by <a href='#' target='_blank'>CV. LINK NET</a>";
	}

	public function cek_filename($file='')
	{
		$data = "assets/favicon.png";
		if ($file != '') {
			if(file_exists("$file")){
				$data = $file;
			}
		}
		return $data;
	}

	//d_pelaksana
	function d_pelaksana($id='',$aksi='')
	{
		if ($aksi=='nama_pelaksana') {
			$data = $this->db->get_where('tbl_user', array('id_user'=>$id))->row()->nama_lengkap;
		}elseif ($aksi=='kategori_lap') {
			$data = $this->db->get_where('tbl_kategori_lap', array('id_kategori_lap'=>$id))->row()->nama_kategori_lap;
		}elseif ($aksi=='sub_kategori_lap') {
			$data = $this->db->get_where('tbl_sub_kategori_lap', array('id_sub_kategori_lap'=>$id))->row()->nama_sub_kategori_lap;
		}else {
			$data = '-';
		}
		return $data;
	}

	//cek status berita
	function cek_status_berita($data)
	{
		if ($data=='menunggu') {
			$v_data = '<label class="label label-danger">BELUM DIPROSES</label>';
		}elseif ($data=='perbaikan') {
			$v_data = '<label class="label label-danger">PERBAIKAN</label>';
		}
		elseif ($data=='proses') {
			$v_data = '<label class="label label-warning">NARASI SEDANG DIBUAT</label>';
		}elseif ($data=='konfirmasi') {
			$v_data = '<label class="label label-primary">MENUNGGU KOREKSI</label>';
		}elseif ($data=='selesai') {
			$v_data = '<label class="label label-success">SUDAH DIPOST</label>';
		}else {
			$v_data = '';
		}
		return $v_data;
	}

	function kirim_notif($pengirim,$penerima,$id_for_link,$notif_type,$pesan)
	{
		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d H:i:s');
		if ($pengirim=='humas') { 
			$pengirim = '6';
		}
		if ($penerima=='humas') {
			for($i=0; $i<6; $i++) {
				$penerima_id[$i] = $i+1;
			}
		}

		if ($notif_type == 'berita') {
			if ($pesan=='pelaksana_kirim_berita') {
				$pesan = "Mengirim bahan berita baru.";
			}elseif ($pesan=='pelaksana_perbaikan_berita') {
				$pesan = "Mengirim perbaikan bahan berita.";
			}elseif ($pesan=='humas_perbaikan_berita') {
				$pesan = "Bahan berita perlu perbaikan";
			}elseif ($pesan=='humas_proses_berita') {
				$pesan = "Narasi berita sedang dipost";	
			}elseif ($pesan=='humas_konfirmasi_berita') {
				$pesan = "Bahan berita sedang dikoreksi";	
			}elseif ($pesan=='humas_selesai_berita') {
				$pesan = "Bahan berita sudah dipost";	
			}
			// id laporan notaris
			if ($id_for_link=='' OR $id_for_link==0) {
				$link = '';
			}else{
				$link = "berita/v/d/".hashids_encrypt($id_for_link);
			}
			//sampai sini
		}
		
		// if($pengirim=="superadmin") {
		// 	foreach ($pengirim as $key) {
		// 		// var_dump($key); exit;
		// 		$data2 = array(
		// 			'pengirim'  => $pengirim,
		// 			'penerima'  => $penerima,
		// 			'pesan'  		=> $pesan,
		// 			'link'			=> $link,
		// 			'id_for_link' => $id_for_link,
		// 			'tgl_notif' => $tgl
		// 		);
		// 		$this->db->insert('tbl_notif',$data2);
		// 	}
		// }

		if($penerima=="humas") {
			for ($i=0; $i < count($penerima_id); $i++) { 
				$data2 = array(
					'pengirim'  => $pengirim,
					'penerima'  => $penerima_id[$i],
					'pesan'  		=> $pesan,
					'link'			=> $link,
					'id_for_link' => $id_for_link,
					'tgl_notif' => $tgl
				);
				$this->db->insert('tbl_notif',$data2);
			}
		} else {
			$data2 = array(
					'pengirim'  => $pengirim,
					'penerima'  => $penerima,
					'pesan'  		=> $pesan,
					'link'			=> $link,
					'id_for_link' => $id_for_link,
					'tgl_notif' => $tgl
				);
				$this->db->insert('tbl_notif',$data2);
		}



		
		
	}

}
