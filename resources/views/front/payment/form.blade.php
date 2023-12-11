<!-- resources/views/payment/form.blade.php -->

<!-- <form action="/halochat/subscription" method="post">
    @csrf
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="1000"
        data-name="halochat"
        data-description="Example charge"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-currency="usd">
    </script>
</form> -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Credit Card Form</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background: #131313;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    form {
      background: linear-gradient(91deg, #B473E0 -130%, #1d1d1d 81%);
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: white;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: #B473E0;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #B473E0;
    }
  </style>
</head>
<body>

  <form action="process_payment.php" method="post">

    <img src="http://127.0.0.1/halochat/public/front/img/viceapp.png" width="300" height="100" alt="">

    <label for="cardNumber">Card Number:</label>
    <input type="text" id="cardNumber" name="cardNumber" required>

    <label for="cardName">Cardholder Name:</label>
    <input type="text" id="cardName" name="cardName" required>

    <label for="expirationDate">Expiration Date:</label>
    <input type="text" id="expirationDate" name="expirationDate" placeholder="MM/YY" pattern="\d{2}/\d{2}" title="Please enter a valid MM/YY format" required>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required>

    <input type="submit" value="Submit">
  </form>

</body>
</html>
<script>
        document.getElementById('expirationDate').addEventListener('input', function (e) {
            var input = e.target;
            var value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
            var formattedValue = value.replace(/(\d{2})(\d{0,2})/, '$1/$2').substring(0, 5);

            input.value = formattedValue;
        });
    </script>