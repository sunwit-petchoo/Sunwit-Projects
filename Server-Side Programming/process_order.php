<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="php process and validate" />
</head>

<body>
<?php 
function sanitise_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
function calOrderCost($seatType,$totalSeat)
{
	$seatPrice = "";
	if($seatType == "Regular")
	{
		$seatPrice = 10;
	}
	if($seatType == "VIP")
	{
		$seatPrice = 20;
	}
	if($seatType == "Honeymoon")
	{
		$seatPrice = 30;
	}
	$orderCost = $seatPrice*$totalSeat;
	return $orderCost;
}
function checkPostCode($state,$postCode)
{
	$errMsg = "";
	$fPostCode = substr($postCode,0,1);
	switch($state)
	{
		case "VIC":
		if($fPostCode != "3" && $fPostCode != "8" )
		{
			$errMsg = "Postcode of $state must start with 3 or 8. ";
		}
		break;
		case "NSW":
		if($fPostCode != "1" && $fPostCode != "2" )
		{
			$errMsg = "Postcode of $state must start with 1 or 2. ";
		}
		break;
		case "QLD":
		if($fPostCode != "4" && $fPostCode != "9" )
		{
			$errMsg = "Postcode of $state must start with 4 or 9. ";
		}
		break;
		case "NT":
		case "ACT":
		if($fPostCode != "0")
		{
			$errMsg = "Postcode of $state must start with 0. ";
		}
		break;
		case "WA":
		if($fPostCode != "6")
		{
			$errMsg = "Postcode of $state must start with 6. ";
		}
		break;
		case "SA":
		if($fPostCode != "5")
		{
			$errMsg = "Postcode of $state must start with 5. ";
		}
		break;
		case "TAS":
		if($fPostCode != "7")
		{
			$errMsg = "Postcode of $state must start with 7. ";
		}
		break;
		default:
			$errMsg = "Please input valid postcode.";
	}
	return $errMsg;
}
//Check card number 
function checkCardNo($cardType,$cardNo)
{
	 $errMsg = "";
	switch($cardType)
	{
		case "V":
		if(!preg_match("/^(4)([0-9]{15})$/",$cardNo)) 
		{
			$errMsg = "Visa cards have 16 digits and start with 4.";
		}
		break;
		case "M":
		if(!preg_match("/^([51-55])([0-9]{14})$/",$cardNo)) 
		{
			$errMsg = "MasterCard have 16 digits and start with digits 51 through to 55.";
			
		}
		break;
		case "A":
		if(!preg_match("/^((34|37))([0-9]{13})$/",$cardNo)) 
		{
			$errMsg = "American Express has 15 digits and starts with 34 or 37.";
		}
		break;
		default:
			$errMsg = "Please input valid card number.";
	}
	return $errMsg;
}
	if(isset($_POST["firstName"]))
	{
		
		$errMsgArray=array();
		//get data from payment.php
		$firstname = sanitise_input($_POST["firstName"]);
		$lastname = sanitise_input($_POST["lastName"]);
		$email = sanitise_input($_POST["email"]);
		$stAddress = sanitise_input($_POST["stAddress"]);
		$subTown = sanitise_input($_POST["subTown"]);
		$state = sanitise_input($_POST["state"]);
		$postCode = sanitise_input($_POST["postCode"]);
		$phoneNumber = sanitise_input($_POST["phoneNumber"]);
		$genre = sanitise_input($_POST["genre"]);
		$seatType = sanitise_input($_POST["seatType"]);
		$totalSeat = sanitise_input($_POST["totalSeat"]);
		//payment details
		
		$cardName = sanitise_input($_POST["cardName"]);
		$cardNo = sanitise_input($_POST["cardNo"]);
		$exDate = sanitise_input($_POST["exDate"]);
		$cvv = sanitise_input($_POST["cvv"]);
		
		   
		if($firstname == "")
		{
			array_push($errMsgArray,"You must enter your first name");
			
		}else 
		{
			if(!preg_match("/^[a-zA-Z ]*$/",$firstname))
			{
				array_push($errMsgArray,"Only alpha letters allowed in your first name.");
			}
		}
		if($lastname == "")
		{
			array_push($errMsgArray,"You must enter your last name.");
			
		}else 
		{
			if(!preg_match("/^[a-zA-Z- ]*$/",$lastname))
			{
				array_push($errMsgArray,"Only alpha letters or hyphen allowed in your last name.");
			}
		}
		if($email == "")
		{
			array_push($errMsgArray,"You must enter your email.");
			
		}else 
		{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				array_push($errMsgArray,"Invalid E-mail address");
			}
		}
		//check address 
		if($stAddress == "")
		{
			array_push($errMsgArray,"You must enter address.");
			
		}else 
		{
			if(!preg_match("/^[0-9a-zA-Z ]*$/",$stAddress))
			{
				array_push($errMsgArray,"Only alpha letters and number allowed in Street Address.");
			}
		}
		if($subTown == "")
		{
			array_push($errMsgArray,"You must enter Suburb/Town.");
			
		}else 
		{
			if(!preg_match("/^[a-zA-Z ]*$/",$subTown))
			{
				array_push($errMsgArray,"Only alpha letters and number allowed in Suburb/Town.");
			}
		}
		if($state == "")
		{
			array_push($errMsgArray,"Please select state.");
		}
		if($postCode == "")
		{
			array_push($errMsgArray,"You must enter postcode");
			
		}else   
		{
			if(!preg_match("/^(\d{4})$/",$postCode))
			{
				array_push($errMsgArray,"Only 4 digits for Postcode");
			}
		}
		if($state != "" && $postCode != "")
		{
			$temp  = checkPostCode($state,$postCode);
			if($temp != "")
			{
				array_push($errMsgArray,$temp);
			}
		}
		if($phoneNumber == "")
		{
			array_push($errMsgArray,"You must enter phone number.");
			
		}else 
		{
			if(!preg_match("/^0[0-9]{9}$/",$phoneNumber))
			{
				array_push($errMsgArray,"Phone number only 10 digits start with 0 allowed.");
			}
		}
		if($_POST["pContact"] == "undefined" || $_POST["pContact"] == "")
		{ 
			array_push($errMsgArray,"Please select Prefer contact.");
			
		}else
		{
			$pContact = sanitise_input($_POST["pContact"]);
		}		
		
		if($totalSeat == "undefined" || $totalSeat == "")
		{
			array_push($errMsgArray,"You must enter number of people.");
			
		}else 
		{
			if(!preg_match("/^([1-9]|10)$/",$totalSeat))
			{
				array_push($errMsgArray,"Number of people between 1 and 10");
			}
		}
		if(!isset($_POST["cardType"]))
		{ 
			array_push($errMsgArray,"Please select card type.");
		}else
		{
			$cardType = sanitise_input($_POST["cardType"]);
			if($cardNo != "")
			{
				$temp2 = checkCardNo($cardType,$cardNo);
				if($temp2 !="")
				{
					array_push($errMsgArray,$temp2);
				}
			}else
			{
				array_push($errMsgArray,"Please enter card No.");
			}
			//check CVV
		if($cvv == "")
		{
			array_push($errMsgArray,"You must enter CVV.");
			
		}else
		{
			if($cardType == "V" || $cardType == "M") 
			{
				//check CVV for visa and master card
				if(!preg_match("/^(\d{3})$/",$cvv))  
				{
					array_push($errMsgArray,"CVV must be 3 digits.");
				}   
			}else
			{
				//check CVV for american express
				if(!preg_match("/^(\d{4})$/",$cvv))  
				{
					array_push($errMsgArray,"CVV must be 4 digits.");
				}   
			}
		}
		}
		//check card name
		if($cardName == "")
		{
			array_push($errMsgArray,"You must enter Card Name.");
			
		}else 
		{
			if(!preg_match("/^[a-zA-Z ]*$/",$cardName))
			{
				array_push($errMsgArray,"Card Name must only contain alpha characters.");
			}
		}
		//check expiry date format
		if($exDate == "")
		{
			array_push($errMsgArray,"You must enter expiry date.");
		}else
		{
			if(!preg_match("/^(0[1-9]|10|11|12)-[0-9]{2}$/",$exDate))
			{
				array_push($errMsgArray,"Expiry is invalid format.");
			}else
			{
				//check expiry date must be after current date
				$mm = date('n'); 
				$yy = substr(date("Y"),2,3);  
				$exDateArr = explode('-', $exDate);
				
            if($exDateArr[1] < $yy)
			{
				array_push($errMsgArray,"The card expiry date must be after the current date."); 

			}else
			{
				if($exDateArr[1] == $yy)
				{
					if($exDateArr[0] < $mm)
					{
						array_push($errMsgArray,"The card expiry date must be after the current date.");
					}
				}
			}
			}
		
		}
		if(count($errMsgArray) != 0)
		{
			
		$fixErrMsg = serialize($errMsgArray);
		$queryStrVal = "firstName=$firstname&lastName=$lastname&email=$email&stAddress=$stAddress&subTown=$subTown&state=$state&postCode=$postCode&pContact=$pContact&genre=$genre&seatType=$seatType&totalSeat=$totalSeat&phoneNumber=$phoneNumber";	
			header ("location: fix_order.php?errArray=$fixErrMsg&$queryStrVal");
			
		}else
		{
		//add orders table and redirect to reciept
		
		require_once ("setting.php");
		$conn = @mysqli_connect($host,
		$user,
		$pwd,
		$sql_db
		);
		if(!$conn)
		{
			echo "<p> Database connection failure</p>";
		}else
		{
			$orderId = "";
			$result = false;
			$orderCost  = calOrderCost($seatType,$totalSeat);
			$sql_table = "orders";
			$orderStatus = "PENDING";
			$query = "INSERT INTO $sql_table (first_name, last_name, email, street_address, sub_town, state, post_code, phone_number, p_contact, genre, seat_type,total_seat, order_cost,order_status, card_type, card_name, card_no, expiry_date, cvv) VALUES 
			('$firstname','$lastname','$email','$stAddress','$subTown','$state','$postCode','$phoneNumber','$pContact','$genre','$seatType','$totalSeat','$orderCost','$orderStatus','$cardType','$cardName','$cardNo','$exDate','$cvv')";
			
			$checkTable = "select * from $sql_table"; 
			$exist = mysqli_query($conn, $checkTable);
			
			if(!$exist)
			{
				
				//create orders table
				$queryCreate = "CREATE TABLE `orders` (
				 `first_name` varchar(25) NOT NULL,
				 `last_name` varchar(25) NOT NULL,
				`email` varchar(35) NOT NULL,
				`street_address` varchar(40) NOT NULL,
				`sub_town` varchar(20) NOT NULL,
				`state` varchar(3) NOT NULL,
				`post_code` int(4) NOT NULL,
				`phone_number` int(10) NOT NULL,
				`p_contact` varchar(10) NOT NULL,
				`genre` varchar(20) NOT NULL,
				`seat_type` varchar(10) NOT NULL,
				`total_seat` int(10) NOT NULL,
				`order_id` int(11) NOT NULL AUTO_INCREMENT,
				`order_cost` int(10) NOT NULL,
				`order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`order_status` varchar(10) NOT NULL,
				`card_type` varchar(10) NOT NULL,
				`card_name` varchar(40) NOT NULL,
				`card_no` int(16) NOT NULL,
				`expiry_date` varchar(5) NOT NULL,
				`cvv` int(4) NOT NULL,
				PRIMARY KEY (`order_id`)
				) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1";
				$resultCreate = mysqli_query($conn, $queryCreate);
				
				if($resultCreate)
				{
					$result = mysqli_query($conn, $query);
					$orderId = mysqli_insert_id($conn);
				}else
				{
					exit();
				}
			}else
			{
					$result = mysqli_query($conn, $query);
					$orderId = mysqli_insert_id($conn);
					if(!$result)
					{
						echo "<p>Something is wrong with ",$query, "</p>";
					}
						
					
					mysqli_close($conn);
			}
				if($orderId !="")
				{
					header ("location: receipt.php?orderId=$orderId");
				}else
				{
					echo "<p>Error: Cannot Make Payment <a href=\"index.php\">Go to HomePage</a></p>";
				}
		}
		}
	}else
	{
		//go back in case of enter direct URL
		header ("location: enquire.php");
		
	}
?>
</body>
</html>
