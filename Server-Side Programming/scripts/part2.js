/* 
Author: sunwit petchoo 101318759
Created : 25/09/2018 
*/
"use strict";
var debug = false;
//cancel order and back to home page
function cancelOrder()
{
	// window confirm from https://www.w3schools.com/jsref/met_win_confirm.asp  
    var conf = confirm("Do you want to cancel order?");
    if (conf == true) 
	{
		//clear all session and go back to home
		sessionStorage.clear();
		window.location = "index.php";    
    }
}
//Check card number 
function checkCardNo(cardType,cardNo)
{
	var errMsg = "";
	switch(cardType)
	{
		case "V":
		if(!cardNo.match(/^(4)([0-9]{15})$/))
		{
			errMsg = "Visa cards have 16 digits and start with 4.\n";
		}
		break;
		case "M":
		if(!cardNo.match(/^([51-55])([0-9]{14})$/))
		{
			errMsg = "MasterCard have 16 digits and start with digits 51 through to 55.\n";
		}
		break;
		case "A":
		if(!cardNo.match(/^((34|37))([0-9]{13})$/))
		{
			errMsg = "American Express has 15 digits and starts with 34 or 37.\n";
		}
		break;
		default:
			errMsg = "Please input valid card number.\n";
	}
	return errMsg;
}
//validate payment form
function validatePayment()
{
	var errMsg = "";
	var tempMsg = "";
	var result = true;
	//enable or disable
	if(!debug){
	var cardTypeArr = document.getElementsByName("cardType");
	var cardType = "";
	for(var i=0;i<cardTypeArr.length;i++)
	{
		if(cardTypeArr[i].checked)
		{
			cardType = cardTypeArr[i].value;
		}
	}

	var cardName = document.getElementById("cardName").value;
	var cardNo = document.getElementById("cardNo").value;
	var exDate = document.getElementById("exDate").value;
	var cvv = document.getElementById("cvv").value;
	
		if(cardType == "" || cardType == null)
		{
			errMsg = "Please select Creadit card type.\n"
			result = false;
		}else
		{
			if(cardType == "V" || cardType == "M")
			{
				//check CVV for visa and master card
				if(!cvv.match(/^(\d{3})$/))
				{
					errMsg += "CVV must be 3 digits.\n"
					result = false;
				}   
			}else
			{
				//check CVV for american express
				if(!cvv.match(/^(\d{4})$/))
				{
					errMsg += "CVV must be 4 digits.\n"
					result = false;
				}   
			}
			//check card number
			tempMsg = checkCardNo(cardType,cardNo);
			if(tempMsg != "")
			{
				errMsg+=tempMsg;
				result = false;
			}
		}
		if(!cardName.match(/^[a-zA-Z ]+$/))
		{
			errMsg += "Name must only contain alpha characters.\n";
			result = false;
		}
		//check expiry date format
		if(!exDate.match(/^(0[1-9]|10|11|12)-[0-9]{2}$/))  
		{
			errMsg += "Expiry is invalid format.\n";
			result = false;
		}else
		{
			//check expiry date must be after current date
			var today = new Date();
			var mm = today.getMonth()+1; 
			var yy = today.getFullYear().toString().substr(2,2);
			var exDateSplit = exDate.split("-");
			if(Number(exDateSplit[1]) < Number(yy))
			{
				errMsg += "The card expiry date must be after the current date.\n";
				result = false;
			}else
			{
				if(Number(exDateSplit[1]) == Number(yy))
				{
					if(Number(exDateSplit[0]) < Number(mm))
					{
						errMsg += "The card expiry date must be after the current date.\n";
						result = false;
					}
				}
			}
		}
		if(errMsg!="")
		{
			alert(errMsg);
		}
	}
	return result
		
}
//Show hide billAddress
function showHideBillAddress()
{
    var address = document.getElementById("billAddress");
	var chkAddress = document.getElementById("chkAddress");
    if (address.style.display === "none") 
	{
        address.style.display = "block";
		//fix bug when already check and refesh window
		chkAddress.checked = true;
		
    }else 
	{
        address.style.display = "none";
		//fix bug when already check and refesh window
		chkAddress.checked = false;
    }
}

//check postcode with state
function checkPostCode(state,postCode)
{
	var errMsg = "";
	var fPostCode = postCode.substring(0,1);
	
	switch(state)
	{
		case "VIC":
		if(fPostCode != "3" && fPostCode != "8" )
		{
			errMsg = "Postcode of "+state+" must start with 3 or 8. \n";
		}
		break;
		case "NSW":
		if(fPostCode != "1" && fPostCode != "2" )
		{
			errMsg = "Postcode of "+state+" must start with 1 or 2. \n";
		}
		break;
		case "QLD":
		if(fPostCode != "4" && fPostCode != "9" )
		{
			errMsg = "Postcode of "+state+" must start with 4 or 9. \n";
		}
		break;
		case "NT":
		case "ACT":
		if(fPostCode != "0")
		{
			errMsg = "Postcode of "+state+" must start with 0. \n";
		}
		break;
		case "WA":
		if(fPostCode != "6")
		{
			errMsg = "Postcode of "+state+" must start with 6. \n";
		}
		break;
		case "SA":
		if(fPostCode != "5")
		{
			errMsg = "Postcode of "+state+" must start with 5. \n";
		}
		break;
		case "TAS":
		if(fPostCode != "7")
		{
			errMsg = "Postcode of "+state+" must start with 7. \n";
		}
		break;
		default:
			errMsg = "Please input valid postcode. \n";
	}
	return errMsg;
}
//validate form in enquire.html
function validate()
{
	var errMsg = "";
	var result = true;
	//enable,disable validate
	if(!debug){
	var totalSeat = document.getElementById("totalSeat").value;
	var state = document.getElementById("state").value;
	var postCode = document.getElementById("postCode").value;
	var tempMsg = checkPostCode(state,postCode);
	var chkAddress = document.getElementById("chkAddress");
	var seat = document.getElementById("seat").value;
	var seatNum = checkBooking();
	if(seatNum != totalSeat)
	{
		errMsg = errMsg + "Please select seat for "+totalSeat+" people.\n";
		result =  false;
	}
	//validate address in case of another address checked
	if(seat == "")
	{
			errMsg = errMsg + "Please select ticket and seat.\n";
			result =  false;
	}
	if(chkAddress.checked)
	{
		
		var stAddress2 = document.getElementById("stAddress2").value;
		var subTown2 = document.getElementById("subTown2").value;
		var state2 = document.getElementById("state2").value;   
		var postCode2 = document.getElementById("postCode2").value;
		
		if(!stAddress2.match(/^[0-9a-zA-Z ]+$/))
		{
			errMsg = errMsg + "Address must only contain alpha characters and number.\n";
			result =  false;
		}
		if(!subTown2.match(/^[a-zA-Z ]+$/))
		{
			errMsg = errMsg + "Subtown must only contain alpha characters.\n";
			result =  false;
		}
		if(state2 == "")
		{
			errMsg = errMsg + "Please select billing state. \n";
			result =  false;
		}
		if(!postCode2.match(/^(\d{4})$/))   
		{
			errMsg = errMsg + "Postcode must only contain 4 digits.\n";
			result =  false;
		}if(state2 != "" && postCode2 != "")
		{
			var tempMsg2 = checkPostCode(state2,postCode2);
			if(tempMsg2 != "")
			{
				errMsg = errMsg + tempMsg2;
				result = false;
			}
		}
	}
	
	//check positive integer of number of people
	if(!totalSeat.match(/^([1-9]|10)$/))
	{
		errMsg = errMsg + "Number of people must be 1-10. \n";
		result =  false;
	//check seatType for the ticket 
	}
	if(document.getElementById("seatType").value == "none")
	{
		errMsg = errMsg + "Your ticket must be selected\n";
		result = false;
	}	
	//result of checkPostCode
	if(tempMsg != "")
	{
		errMsg = errMsg + tempMsg;
		result = false;
	}
	
	if(errMsg!="")
	{
		alert(errMsg);
	}
	}
	if(result)
	{
		storeData();
	}
	return result
}
//store data in session 
function storeData()
{
	//get checked category
	var category = "";
	var arrCategory = [];
	var nShow = document.getElementById("nShow").checked;
	var cSoon = document.getElementById("cSoon").checked;
	var _3D = document.getElementById("_3D").checked;
	var mFest = document.getElementById("mFest").checked;
	if(nShow)  arrCategory.push("now showing");
	if(cSoon)  arrCategory.push("Coming Soon");
	if(_3D) arrCategory.push("3D");
	if(mFest) arrCategory.push("Moives festival");
	for(var i= 0;i<arrCategory.length;i++)
	{
		category+=arrCategory[i];
		if(i<arrCategory.length-1)
		{
			if((arrCategory.length-1) - i == 1 )
			{
				category+=" and ";
			}else
			{
				category+=", ";
			}
		}
	}
	
	//get all value in enquire and store in session
	sessionStorage.firstName = document.getElementById("firstName").value;
	sessionStorage.lastName = document.getElementById("lastName").value
	sessionStorage.email = document.getElementById("email").value;
	sessionStorage.stAddress = document.getElementById("stAddress").value;
	sessionStorage.subTown = document.getElementById("subTown").value;
	sessionStorage.state = document.getElementById("state").value;
	sessionStorage.postCode = document.getElementById("postCode").value;
	sessionStorage.phoneNumber = document.getElementById("phoneNumber").value;
	if (document.getElementById("email2").checked) {
		sessionStorage.pContact = document.getElementById("email2").value;
	}else if(document.getElementById("post").checked)
	{
		sessionStorage.pContact = document.getElementById("post").value;
	}
	else if(document.getElementById("phone").checked)
	{
		sessionStorage.pContact = document.getElementById("phone").value;
	}else
	{
		sessionStorage.pContact = "";
	}
	sessionStorage.genre = document.getElementById("genre").value;
	sessionStorage.category = category;
	sessionStorage.seatType = document.getElementById("seatType").value;
	sessionStorage.totalSeat = document.getElementById("totalSeat").value;
	sessionStorage.Comments = document.getElementById("Comments").value;
	sessionStorage.seat = document.getElementById("seat").value;
	
	//get billing address in case checked
	var chkAddress = document.getElementById("chkAddress").checked;
	if(chkAddress)
	{
		sessionStorage.stAddress2 = document.getElementById("stAddress2").value;
		sessionStorage.subTown2 = document.getElementById("subTown2").value;
		sessionStorage.state2 = document.getElementById("state2").value;
		sessionStorage.postCode2 = document.getElementById("postCode2").value;
	}
	
	
}
//get  data from session
function getData()
{
	
	if(sessionStorage.firstName != undefined){    
		//confirmation text
		document.getElementById("payment_name").textContent = sessionStorage.firstName + " " + sessionStorage.lastName;
		document.getElementById("cardName").value = sessionStorage.firstName + " " + sessionStorage.lastName;// default Card name for customer
		document.getElementById("payment_email").textContent =sessionStorage.email;
		document.getElementById("payment_stAddress").textContent = sessionStorage.stAddress;
		document.getElementById("payment_subTown").textContent = sessionStorage.subTown;
		document.getElementById("payment_state").textContent =sessionStorage.state;
		document.getElementById("payment_postCode").textContent = sessionStorage.postCode;
		document.getElementById("payment_phoneNumber").textContent = sessionStorage.phoneNumber;
		document.getElementById("payment_pContact").textContent = sessionStorage.pContact;
		document.getElementById("payment_genre").textContent = sessionStorage.genre;
		document.getElementById("payment_category").textContent = sessionStorage.category;
		document.getElementById("payment_seatType").textContent = sessionStorage.seatType;
		document.getElementById("payment_totalSeat").textContent = sessionStorage.totalSeat;
		document.getElementById("payment_seat").textContent = sessionStorage.seat;
		document.getElementById("payment_Comments").textContent = sessionStorage.Comments;
		document.getElementById("payment_cost").textContent = "$"+calTotalPrice();
		document.getElementById("payment_cost").style.color = "red";
		document.getElementById("payment_cost").style.fontSize = "xx-large";
		if(sessionStorage.stAddress2 != undefined){
		document.getElementById("payment_stAddress2").textContent = sessionStorage.stAddress2;
		document.getElementById("payment_subTown2").textContent = sessionStorage.subTown2;
		document.getElementById("payment_state2").textContent = sessionStorage.state2;
		document.getElementById("payment_postCode2").textContent = sessionStorage.postCode2;
		//fill hidden field for billing address
		document.getElementById("stAddress2").value = sessionStorage.stAddress2;
		document.getElementById("subTown2").value = sessionStorage.subTown2;
		document.getElementById("state2").value = sessionStorage.state2;
		document.getElementById("postCode2").value = sessionStorage.postCode2;
		}else
		{
			document.getElementById("billingAddress_P").style.display = "none";
		}
		
		//fill hidden fields
		document.getElementById("firstName").value = sessionStorage.firstName;
		document.getElementById("lastName").value = sessionStorage.lastName;
		document.getElementById("email").value = sessionStorage.email;
		document.getElementById("stAddress").value = sessionStorage.stAddress;
		document.getElementById("subTown").value = sessionStorage.subTown;
		document.getElementById("state").value = sessionStorage.state;
		document.getElementById("postCode").value = sessionStorage.postCode;
		document.getElementById("phoneNumber").value = sessionStorage.phoneNumber;
		document.getElementById("pContact").value = sessionStorage.pContact;
		document.getElementById("genre").value = sessionStorage.genre;
		document.getElementById("category").value = sessionStorage.category;
		document.getElementById("seatType").value = sessionStorage.seatType;
		document.getElementById("totalSeat").value = sessionStorage.totalSeat;
		document.getElementById("Comments").value = sessionStorage.Comments;
		document.getElementById("cost").value = calTotalPrice();
		document.getElementById("seat").value = sessionStorage.seat;
	
		
		
		}
}
// calculate total price
function calTotalPrice()
{
	var seatType = sessionStorage.seatType;
	var totalSeat = sessionStorage.totalSeat;
	var cost = 0;
	if(seatType == "Regular")
	{
		seatType = 10;
	}else if(seatType == "VIP"){
		seatType = 20;
	}
	else if(seatType == "Honeymoon"){
		seatType = 30;
	}else
	{
		return 0;
	}
	cost = seatType*totalSeat;
	return cost;
}
function setDebug()
{
	
	if(debug == true)
	   debug = false;
    else
		debug = true;
	document.getElementById("currentFlag").textContent = debug;
	
}
function init()
{
	
	var enquireForm = document.getElementById("enquireForm2");// get ref to the HTML element 
	
	var address2 = document.getElementById("billAddress");
	var chkAddress = document.getElementById("chkAddress");
	var paymentForm = document.getElementById("paymentForm");
	var cancelButton = document.getElementById("cancelButton");
	var debugFlag = document.getElementById("debugFlag");
		if(debugFlag != null)
		{
			debugFlag.onclick = setDebug;
		}
		if(enquireForm != null)
		{
		enquireForm.onsubmit = validate;           //register the event listener 
		//hide address fieldset
		address2.style.display = "none";
		//call  showHideBillAddress when checkbox checked/unchecked
		chkAddress.checked = false;
		chkAddress.onclick = showHideBillAddress;
		preScript();
		}
		if(paymentForm != null)
		{
			getData();
			paymentForm.onsubmit = validatePayment;
			cancelButton.onclick = cancelOrder;
			timedCountDes();
		}
}

window.onload = init;

