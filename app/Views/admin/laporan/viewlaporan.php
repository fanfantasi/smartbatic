<html>
	<head>
		<style>
			table {
			  font-family: arial, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			td, th {
			  border: .5px solid #000000;
			  /*text-align: center;*/
			  /*height: 20px;*/
			  margin: 8px;
			}

		</style>
	</head>
	<body>
		<div style="font-size:22px; color:'#dddddd';"><i>LAPORAN HARIAN</i></div>
		<p>
		<i>SATGAS PEMULIHAN EKONOMI NASIONAL (PEN) </i>
		</p>
		<table>
			<tr>
				<th width="40px" rowspan="2" style="text-align:center;"><strong>No</strong></th>
				<th rowspan="2" width="15%"><strong>Hari/Tanggal</strong></th>
				<th rowspan="2" width="15%"><strong>Satker</strong></th>
				<th colspan="5" align="center" width="65%"><strong>Kegiatan</strong></th>
			</tr>
			<tr>
				<th width="10%"><strong>Bidang</strong></th>
				<th width="10%"><strong>Jenis Kegiatan</strong></th>
				<th width="30%" align="justify"><strong>Uraian</strong></th>
				<th width="15%"><strong>Dokumentasi</strong></th>
			</tr>
			<?php
			$no=1;
			foreach ($lap as $key):?>
				<tr nobr="true">
					<td><?= $no;?></td>
					<td><?= tgl_indo($key['created_at']) ?></td>
					<td><?= $key['nm_polda'] ?></td>
					<td><?= $key['kegiatan'] ?></td>
					<td><?= $key['fungsi'] ?></td>
					<td align="justify"><?= $key['uraian'] ?></td>
					<?php if ($key['file'] != null){ ?>
						<td><img src="<?= base_url(); ?>/uploads/laporan/<?= $key['file'];?>"></td>
					<?php }else{ ?>
					<td></td>
					<?php }?>
				</tr>
			<?php $no++; endforeach;?>
			
		</table>
	</body>
</html>