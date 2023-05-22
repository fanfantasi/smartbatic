<?php

if (! function_exists('tgl_indo'))
{
	function tgl_indo($tgl){
        $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $tanggal = substr($tgl,8,2);
        $bulan = substr($tgl,5,2);
        $tahun = substr($tgl,0,4);
        $jam = substr($tgl, 10,9);
        return $tanggal.' '.$bln[(int)$bulan-1].' '.$tahun.' Jam '.$jam;       
	}

	function tanggal($tgl){
        $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $tanggal = substr($tgl,8,2);
        $bulan = substr($tgl,5,2);
        $tahun = substr($tgl,0,4);
        $jam = substr($tgl, 10,9);
        return $tanggal.' '.$bln[(int)$bulan-1].' '.$tahun;       
	}
}
