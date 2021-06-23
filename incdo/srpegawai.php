<?php
	include('config.php');
	@$gt = $_GET['q'];
	//$gt = 'suad';
	$sql = "SELECT * from dt_bidang"; 
	$result = mysql_query($sql);
	
	$gagal = 0;

	$liat = mysql_num_rows($result);
	//echo ' '.$liat;

	if(isset($_GET['noid']))
		$etc = 'and dt_pegawai.NIP !='.$_GET['noid'];
	else
		$etc = '';
	
	while($row = mysql_fetch_array($result)){
		//$data[] = array('id' => $row[0], 'text' => $row[1]); // dont change because its cannot change.. huh ?
		$tmp = [];
		
		$sd = mysql_query("select dt_pegawai.NIP, dt_pegawai.nama_pegawai, dt_jabatan.nama_jabatan from dt_pegawai join dt_jabatan on dt_pegawai.id_jabatan = dt_jabatan.id_jabatan where dt_pegawai.id_bidang='$row[0]' and dt_pegawai.nama_pegawai like '%$gt%' $etc");
		
		if(mysql_num_rows($sd) != 0)	{
			while($rs = mysql_fetch_array($sd))	{
				$tmp[] = array('id' => $rs[0],'text' => $rs[1].' ('.$rs[2].')');
				//$data[] = array('text' => $row[1], 'children' => [array('id' => $rs[0],'text' => $rs[1].' ('.$rs[2].')')]);
			}
			$data[] = array('text' => $row[1], 'children' => $tmp);
			//echo ' BERHASIL,';
		} else	{
			$gagal += 1;
			//echo ' GAGAL,';
		}
		unset($tmp);
	}
	
	if($liat == $gagal)
		$data = [];
	
	echo json_encode($data);

?>