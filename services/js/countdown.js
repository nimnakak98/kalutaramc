/**
* @Author : GIHANTHA
* 
*/
var timeleft = 300;
var startTime = 0;
var currentTime = 0;

function convertSeconds(s) {
  var min = floor(s / 60);
  var sec = s % 60;
  return nf(min, 2) + ':' + nf(sec, 2);
}

function setup() {
  noCanvas();
  startTime = millis();

  var params = getURLParams();
  console.log(params);
  if (params.minute) {
    var min = params.minute;
    timeleft = min * 60;
  }

  var timer = select('#timer');
  timer.html(("Time Remaining: ")+convertSeconds(timeleft - currentTime));
  var interval = setInterval(timeIt, 1000);

  function timeIt() {
    currentTime = floor((millis() - startTime) / 1000);
    timer.html(("Time Remaining: ")+convertSeconds(timeleft - currentTime));
    if (currentTime == timeleft) {
      clearInterval(interval);
      $("#lblResendCode").show();
      $("#timer").hide();
    }

    if (currentTime == true ) { 
      $("#lblResendCode").hide();
    }
  }
}
