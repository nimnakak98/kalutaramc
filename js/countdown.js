// Set the date and time for the countdown (April 13th, 9:05 PM)
const countdownDate = new Date('April 13, 2024 21:05:00').getTime();

// Update the countdown every second
const countdown = setInterval(() => {
  // Get the current date and time
  const now = new Date().getTime();

  // Calculate the difference between now and the countdown date
  const difference = countdownDate - now;

  // Calculate days, hours, minutes, and seconds
  const days = Math.floor(difference / (1000 * 60 * 60 * 24));
  const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((difference % (1000 * 60)) / 1000);

  // Display the countdown with text in the HTML element with id "countdown"
  document.getElementById('countdown').innerHTML = `
    <div>අලුත් අවුරුදු උදාවට තව දින..</div>
    <div>${days}d ${hours}h ${minutes}m ${seconds}s</div>
  `;

  // If the countdown is finished, display a message
  if (difference < 0) {
    clearInterval(countdown);
    document.getElementById('countdown').innerHTML = "Countdown expired!";
  }
}, 1000);
