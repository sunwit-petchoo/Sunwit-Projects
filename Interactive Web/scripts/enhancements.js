/* 
Author: sunwit petchoo 101318759
Created : 25/09/2018 
*/
"use strict";
//set available selected seat and disable the others
var totalTime = 120;
var time;
//disable unselected type of ticket and only enable the selected one
function setAvailableSeat(seat,disSeat,disSeat2)
{
	//clear seat value in case of user already selected seat in that type and change to another type 
	document.getElementById("seat").value = "";
	for(var i=1;i<=10;i++)
	{	
			//get each seat id for the selected type
		var seatId = document.getElementById(seat + i)
			//set color to display that the seats are available
			seatId.style.backgroundColor = "#b6cada";
			//disable seats from unselected type
			document.getElementById(disSeat + i).style.backgroundColor="grey";
			document.getElementById(disSeat2 + i).style.backgroundColor="grey";		
	}
}
//set selected seat when user click according to number of people
function setSelectedSeat(id)
{
	//get current seat that is clicked
	var currentSeat = document.getElementById(id);
	//get total of booking seat
	var seatNum = checkBooking();
	var seatNo = document.getElementById("seat").value;
	var shortId = "";
	//check whether click on disable seat or not 
	if(document.getElementById(id).style.backgroundColor != "grey" && document.getElementById("seatType").value != "none")
	{
		var totalSeat = document.getElementById("totalSeat").value;
		//error message alert if user not input totalSeat or input with wrong format
		if(totalSeat.match(/^([1-9]|10)$/)&& totalSeat != "")
		{
			//alert if user book over totalSeat
			if(seatNum<totalSeat)
			{
				//check that user click on booked seat
				if(currentSeat.style.backgroundColor != "yellow")
				{
				//change color to book status(yellow)
				currentSeat.style.backgroundColor = "yellow";
				//repalce full id to short one
				shortId = id.substring(0,1);
				if(shortId == "R")
				{
					shortId = id.replace("Regular", "R");   
				}
				if(shortId == "V")
				{
					shortId = id.replace("VIP", "V");
				}
				if(shortId == "H")
				{
					shortId = id.replace("Honeymoon", "H");
				}
				//check duplicate for id already input
				if(seatNo.search(shortId) < 0 )
				{
					//adding for first no need comma
					if(seatNo == "")
					{
						seatNo = shortId;
					}else
					{
						//add comma for second time or more
						seatNo += ","+shortId;
					}
				}
					//set value in text box
					document.getElementById("seat").value = seatNo;
				}else
				{
					//change color back if click on booked seat
					currentSeat.style.backgroundColor = "#b6cada";
				}
			}else
			{
				alert("Cannot book over "+totalSeat+" people");
			}
			
		}else
		{
			alert("Please input number of people first.");
			document.getElementById("totalSeat").focus();
		}
	}
}
//check that how many seat already booked
function checkBooking()
{
	
	var count = 0;
	//get all seat
	var allSeat = document.getElementsByTagName("td");
		for (var i = 0; i < allSeat.length; i++)
		{
		var id = allSeat[i].id;
		//count yellow seat = booked
		if(document.getElementById(id).style.backgroundColor == "yellow")
		{
			count++;
		}
		}
		return count;
}
//Change ticket price
function setTicketPrice()
{
	//when select seatType(ticket) display booking panel for user
	document.getElementById("seatBooking").style.display = "block";
	//set price based on selected Id
	var seat = document.getElementById("seatType").value;
	var seatPrice = "";
	if(seat == "Regular")
	{
		seatPrice = "$10";
		setAvailableSeat("Regular","VIP","Honeymoon"); 
	}else if(seat == "VIP")
	{
		seatPrice = "$20";
		setAvailableSeat("VIP","Regular","Honeymoon");
		
	}else if(seat == "Honeymoon")
	{
		seatPrice = "$30";
		setAvailableSeat("Honeymoon","VIP","Regular");
	}else
	{
		seatPrice = "___";
	}
	//set price on html page
	document.getElementById("price").innerHTML = seatPrice;
	
}

//clear all seat
function clearSeat()
{
	//get all seat in readonly textbox and split with ,
	var selectedSeat = document.getElementById("seat").value;
	var selectedSeatArr = selectedSeat.split(",");
	
	var id = "";
	//get each id and replace with full id 
	for(var i=0;i<selectedSeatArr.length;i++)
	{
				id = selectedSeatArr[i].substring(0,1);
				if(id == "R")
				{
					id = selectedSeatArr[i].replace("R", "Regular");   
				}
				if(id == "V")
				{
					id = selectedSeatArr[i].replace("V", "VIP");
				}
				if(id == "H")
				{
					id = selectedSeatArr[i].replace("H", "Honeymoon");
				}
				// change to default color 
				document.getElementById(id).style.backgroundColor ="#b6cada";
				
	}
	//clear value in readonly textbox
	document.getElementById("seat").value = "";
}
//create time counter to show time left for user 
function timedCountDes()
{
	//get span id counter and style it 
	var txt = document.getElementById("counter");
	txt.style.fontWeight = "blod";
	txt.style.fontSize = "xx-large";
	//set color of counter for that specific time
	if(totalTime >= 71 && totalTime <= 120) 
	{
		txt.style.color = "blue";
	}
	if(totalTime >= 21 && totalTime <= 70) 
	{
		txt.style.color = "green";
	}
	if(totalTime <= 20 ) 
	{
		txt.style.color = "red";
	}
    txt.textContent = totalTime;
	//count down
    totalTime--;
	//when time's up reset counter, clear timeout and go back to enquire.html
	if(totalTime == 0)
	{
		totalTime = 120;
		clearTimeout(time);
		window.location = "enquire.html";
	}
	// call timedCountDes every 1 sec
    time = setTimeout(timedCountDes, 1000);

}
//initial script
function preScript()
{
		
		//hide booking pabel when page load
		var seatType = document.getElementById("seatType");
		document.getElementById("seatBooking").style.display = "none";
		//call setTicketPrice function when value of setType changed
		seatType.onchange = setTicketPrice;
		//Click button to clear seat
		var bookSeat = document.getElementById("bookSeat");
		bookSeat.onclick = clearSeat;
		//add EventListener to all <td> to prepare when user click
		var allSeat = document.getElementsByTagName("td");
		for (let i = 0; i < allSeat.length; i++)    // loop all <td> to get id 
		{
		let id = allSeat[i].id;
		document.getElementById(id).addEventListener("click", function(){setSelectedSeat(id);}, false); //add event and when user click will call function setSelectedSeat
		}
		
}


