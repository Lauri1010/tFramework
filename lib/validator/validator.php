<?php

function isInt($variable){
	
	return is_int($variable);
	
}

function isDouble($variable){
	
	return is_double($variable);
	
}

function checkIfNumeric($variable){
	
	return is_numeric($variable);

}

function isIntUfilter($int){
	
	return filter_var($int, FILTER_VALIDATE_INT);

}

function removeSepecialCharacters($string){
	
	if(is_string($string)){
		
		return filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

	}
	

}


function convertToInt($variable,$min=1,$max=11){
	
/* 	if(!is_int($variable)){
		
		if(is_string($variable)){
			
			$stringLenght=strlen($variable);
			
			if($stringLenght >= $min && $stringLenght <= $max){

				$variable = (int) $variable;
				
			}
			
		}

	} */
	
	if(is_numeric($variable)){
	
	$variable = (int) $variable;
	
		return filter_var(
				$variable,
				FILTER_VALIDATE_INT,
				array(
						'options' => array(
								'min_range' => $min,
								'max_range' => $max
						)
				)
		);
	
	}else{
	
		return false;
	
	}
	
}

function convertToFloat($variable,$min=1,$max=11){
	
	if(is_numeric($variable)){
	
		$variable = (float) $variable;
	
		return filter_var(
				$variable,
				FILTER_VALIDATE_FLOAT
		);
	
	}else{
		
		return false;
		
	}

}

function intigerCheck($int, $min, $max)
{

 	if (is_string($int) && !ctype_digit($int)) {
		return false; // contains non digit characters
	}
	if (!is_int((int) $int)) {
		return false; // other non-integer value or exceeds PHP_MAX_INT
	} 
	return ($int >= $min && $int <= $max);
}

function stringProperCheck($string,$min,$max){
	
	if (is_string($string)){
		
		$strinLenght=strlen($string);
		
		return ($strinLenght >= $min && $strinLenght <= $max);
		
	}else{
		
		return false;
	}
	
}

function stringCheck($string, $type, $length){

	// assign the type
	$type = 'is_'.$type;

	if(!$type($string))
	{
		return FALSE;
	}
	// now we see if there is anything in the string
	elseif(empty($string))
	{
		return FALSE;
	}
	// then we check how long the string is
	elseif(strlen($string) > $length)
	{
		return FALSE;
	}
	else
	{
		// if all is well, we return TRUE
		return TRUE;
	}
}

function stripTags($string){

	return strip_tags($string);
	
}

function validateEmail($email){
	
	return filter_var($email, FILTER_VALIDATE_EMAIL);

}

function hasWhitespace($string){
	
	return (preg_match('/\s/',$string));

}

function checkdateFunction($month,$day,$year){
	
	return checkdate($month , $day , $year);
	
}

// http://php.net/manual/en/function.checkdate.php
function validateDate($date, $format = 'Y-m-d H:i:s')
{
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}






