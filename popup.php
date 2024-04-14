<!DOCTYPE html>
<html>
  <head>
    <title>Signup</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet"  href="css/popup.css">
    />
  </head>
  <body>
  <div id="overlay" class="hidden">
  <div id="popup" class="popup-content">
    <h2>Congratulation!</h2>
    <p>Expense successfully added! </p>
    <button id="close-popup-btn"><a href="home.php">Close</a></button>
  </div>
</div>

    

<script>
window.addEventListener('load', () => {
  const overlay = document.getElementById('overlay');
  const closePopupBtn = document.getElementById('close-popup-btn');

  overlay.style.display = 'block';

  closePopupBtn.addEventListener('click', () => {
    overlay.style.display = 'none';
  });
});
</script>
