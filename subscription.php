<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style11.css">
    <title>subscription</title>
</head>
<body>
    
    <div class="top-banner">
        <p class="current-plan"> Select Your Plan</p>
        <p class="plan-type"></p>
    </div>

    <div class="container">
      <h1 class="title">Choose a plan</h1>
      <div class="toggle-switch">
            <span>Subscribe to read books.</span>
      </div>

      <div class="cards">

        <!-- Starter Plan -->
          <div class="card" id="card-1">
            <h1 class="card-title">1 MONTH</h1>
            <h2 class="card-price" id="starter-price"> 99 <span> / MONTH</span> </h2>
            <ul class="card-plan">
              <li>Tax 10% less</li>
              <br>
              <li>User can added books up to 50/month</li>
            </ul><br><br><br><br><br>
            <button type="button" class="card-btn"> BUY NOW</button>
          </div>

          <!-- Super Plan -->
          <div class="card" id="card-2">
            <h1 class="card-title">1 YEAR</h1>
            <h2 class="card-price" id="Super-price"> 799 <span> / PERM</span> </h2>
            <ul class="card-plan">
              <li>Tax 30% less</li>
              <br>
              <li>User can addes books up to 100/month</li>
              <br>
              <li>Sponsor on 40 books</li>
            </ul><br><br>
            <button type="button" class="card-btn"> BUY NOW</button>
          </div>

          <!-- premium Plan -->
          <div class="card" id="card-2">
            <h1 class="card-title">PERMANENT</h1>
            <h2 class="card-price" id="premium-price"> 2999 <span> / YEAR</span> </h2>
            <ul class="card-plan">
              <li>No taxes! User can buy any book with its original price</li>
              <br>
              <li>User can added up unlimited number of books</li>
              <br>
              <li>Sponsor on all books</li>
            </ul>
            <button type="button" class="card-btn"> BUY NOW</button>
          </div>

      </div>
    </div>
    <script src="main.js"></script>
</body>
</html>