<?php
namespace VanXuan;
/**
 * Last edit: 2017-11-09
 */

class VNDate{
    /**
     * Convert from dd/mm/yyyy to yyyy-mm-dd
     * @param string $d Date string with format dd/mm/yyyy
     * @return string
     */
	public static function vn2sql($d){
		list($d,$m,$y) = $d?explode('/',$d):array('00','00','0000');
		return "$y-$m-$d";
	}
    /**
     * Convert from yyyy-mm-dd to dd/mm/yyyy
     * @param string $d Date string with format yyyy-mm-dd
     * @return string
     */
	public static function sql2vn($d){
		if (!$d) return '';
		list($y,$m,$d) = explode('-',$d);
		if ($y+$m+$d==0) return '';
		return "$d/$m/$y";
	}
	public static function change($date,$change){
		return date('Y-m-d',strtotime($change,strtotime($date)));
	}

	/**
	 * @param $d String dd/mm/yyyy or dd/mm/yy or d/m/yyyy or d/m/yy
	 *
	 * @return \DateTime
	 */
	public static function from($d){
		preg_match('/(\d+)\/(\d+)\/(\d+)/',$d,$ms);
		$y = ($ms[3]<100 ? '20':'').$ms[3];
		$m = (intval($ms[2])<10 ? '0':'').intval($ms[2]);
		$d = (intval($ms[1])<10 ? '0':'').intval($ms[1]);
		return new \DateTime("$y-$m-$d");
	}
	public static function beginWeek(\DateTime $d){
		$d = clone($d);
		$c = intval($d->format('w'));
		$n = $c-1;
		if ($n>0)
			$d->sub(new \DateInterval("P{$n}D"));
		return $d;
	}
	public static function endWeek(\DateTime $d){
		$d = clone($d);
		$c = intval($d->format('w'));
		$n = 6-$c;
		if ($n)
			$d->add(new \DateInterval("P{$n}D"));
		return $d;
	}
}