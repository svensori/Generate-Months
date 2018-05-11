<?php
	/*
	//CUTOFF GENERATOR BY steven soriano
	//Produce months between selected date
	*/
	
	$d1 = strtotime("jan 1 2018");
	$d2 = strtotime("jan 31 2019");
	$format = "M d Y";

	$ss = new DateTime(date("Y-m-d", $d1));
	$ee = new DateTime(date("Y-m-d", $d2));
	$calc_date = $ss->diff($ee);
	$duration_y = $calc_date->format('%y');
	$duration_m = $calc_date->format('%m');
	$duration_d = $calc_date->format('%d');

	$flag = 0;
	$total_months = $duration_y * 12 + $duration_m;
	if($duration_d >= 27){
		$duration_d = 0;
		$total_months += 1;
	}

	$dates = array();

	if($total_months > 0){
		/*if($total_months > 3){
			array_push($dates, '2 Month Advance');
			$total_months -= 2;
		}*/

		//produce months
		for ($i=1; $i <= $total_months; $i++) { 
			if($i === 1){
				$strD1 = date($format, $d1);
			}else{
				list($expD1, $expD2) = explode(" - ", end($dates));
				$strD1 = date($format, strtotime("+1 DAY", strtotime($expD2)));
			}
			$strD2 = date($format, strtotime("-1 DAY", strtotime("+".$i." MONTH", $d1)));
			array_push($dates, $strD1." - ".$strD2);
		}
		//if month selected with half month
		if($duration_d > 10 && $duration_d < 20){
			list($lastD1, $lastD2) = explode(" - ", end($dates));
			if($duration_d < 15){
				$strD1 = date($format, strtotime("+1 DAY", strtotime($lastD2)));
			}else{
				$strD1 = date($format, strtotime("-".$duration_d." DAY", $d2));
			}
			$strD2 = date($format, $d2);
			array_push($dates, $strD1." - ".$strD2." (half month)");
		}
	}elseif($total_months === 0 && !empty($duration_d)){//if counted date is less than a month
		$start_cutoff = date($format, $d1);
		$end_cutoff = date($format, strtotime("+ " . $duration_d . " DAY", $d1));
		array_push($dates, $start_cutoff . ' - ' . $end_cutoff);
	}

	print_r($dates);
 ?>
