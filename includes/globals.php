<?php
  $googleAPIKey = "ABQIAAAAfjmr4lahkxY9kV0meEpEGRTeW2qoRIKyKReX-9QIg2jHbGUatRRt-p7LMyqch5J5l4iiiFfU1Qg_Lw";
  
  $countries = array(".com"=>"United States",
                     ".ca"=>"Canada",
                     ".co.uk" => "United Kingdom",
                     ".com.au"=>"Australia",
                     ".co.nz" => "New Zealand",
                     );
                     
   $stateAbbr = array("MO" => "Missouri",
   				   "TX" => "Texas");
				   
	$clothSizes = array(""=>"","NA" => "N/A","NB"=>"New Born",
					"0-3 mo" => "0 - 3 Months",
					"3 mo"=>"3 Months",
					"3-6 mo" => "3 - 6 Months",
					"6 mo"=>"6 Months",
					"6-9 mo" => "6 - 9 Months",
					"9 mo"=>"9 Months",
					"12 mo"=>"12 Months",
					"18 mo"=>"18 Months",
					"24 mo"=>"24 Months",
					"2t" => "2T",
					"3t" => "3T",
					"4t" => "4T",
					"xs" => "XS",
					"s" => "S",
					"m" => "M",
					"l" => "L",
					"xl" => "XL",
					"xxl" => "XXL",
					"xxxl" => "XXL",
					"1" => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
					"7" => "7",
					"8" => "8",
					"9" => "9",
					"10" => "10",
					"11" => "11",
					"12" => "12",
					"13" => "13"
					);
					
	$genders = array(""=>"","N"=>"N/A","M"=>"Male",
					 "F" => "Female",
					 "U" =>"Unisex");
					
	$prices = array();
		$ii=0;
		for ($i=0; $i<75.5; $i+=.5){	
			$prices["$i"] = "$" . number_format($i,2,'.',',');
			$ii++;
		}
?>
