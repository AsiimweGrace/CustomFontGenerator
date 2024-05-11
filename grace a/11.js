document.addEventListener('DOMContentLoaded', function() {
  var countdownElement = document.getElementById('countdown');
  var downloadLink = document.getElementById('download-link');
  var manualDownloadLink = document.getElementById('manual-download');

  var countdownTimer = 30;
  var countdownInterval;

  function startCountdown() {
    countdownElement.textContent = countdownTimer;
    countdownInterval = setInterval(function() {
      countdownTimer--;
      countdownElement.textContent = countdownTimer;

      if (countdownTimer === 0) {
        clearInterval(countdownInterval);
        startDownload();
      }
    }, 1000);
  }

  function startDownload() {
    // Replace this with your actual download link
    window.location.href = '6.html';
  }

  downloadLink.addEventListener('click', function(event) {
    event.preventDefault();
    startCountdown();
  });

  manualDownloadLink.addEventListener('click', function(event) {
    event.preventDefault();
    startDownload();
  });

  startCountdown();
});