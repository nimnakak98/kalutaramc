var monthNames = ["January | ජනවාරි", "February | පෙබරවාරි", "March | මාර්තු", "April | අප්‍රේල්", "May | මැයි", "June | ජූනි",
  "July | ජූලි", "August | අගෝස්තු", "September | සැප්තැම්බර්", "October | ඔක්තෝබර්", "November | නොවැම්බර්", "December | දෙසැම්බර්"  
];
var dayNames = ['Sunday | ඉරිදා', 'Monday | සඳුදා', 'Tuesday | අඟහරුවාදා', 'Wednesday | බදාදා', 'Thursday | බ්‍රහස්පතින්දා', 'Friday | සිකුරාදා', 'Saturday | සෙනසුරාදා'];

function checkTime() { 
  var date = new Date();
  var sufix = '';
  var hours = date.getHours();
  var ampm = hours >= 12 ? 'PM' : 'AM'; // Determine AM or PM 
  hours = hours % 12;
  hours = hours ? hours : 12; // Convert midnight (0 hours) to 12
  var minutes = ('0' + date.getMinutes()).slice(-2);
  var seconds = ('0' + date.getSeconds()).slice(-2);
  var day = date.getDate();
  var month = monthNames[date.getMonth()];
  var weekday = dayNames[date.getDay()];

  if (day < 1 || day > 31) {
    sufix = 'th'; // Default suffix for invalid dates
  } else if (day >= 11 && day <= 13) {
    sufix = 'th'; // Exception cases for 11, 12, 13
  } else {
    switch (day % 10) {
      case 1:
        sufix = "st";
        break;
      case 2:
        sufix = "nd";
        break;
      case 3:
        sufix = "rd";
        break;
      default:
        sufix = "th";
        break;
    }
  }

  document.getElementById('time').innerHTML = "<span class='hour'>" + hours + ":" + minutes + ":" + seconds + " " + ampm + "</span><br/><span class='date'>" + month + ' ' + day + sufix + ', ' + weekday + '.';
}

setInterval(checkTime, 1000); // Pass the function reference, not the result of the function call
