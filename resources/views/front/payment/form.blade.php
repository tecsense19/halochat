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
      font-weight: 700;
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

  <form action="{{ route('payment.orderConfirm') }}" method="post">
  {!! csrf_field() !!}
    <img src="http://127.0.0.1/halochat/public/front/img/viceapp.png" width="300" height="100" alt="">

    <label for="cardNumber">Card Number:</label>
    <input type="text" id="cardNumber" name="cardNumber" pattern="\d{4} \d{4} \d{4} \d{4}" placeholder="Please enter a valid credit card number" title="Please enter a valid credit card number in the format xxxx xxxx xxxx xxxx" required>
    <input type="hidden" id="product_id" name="product_id" value="{{ $product_id }}" >

    <label for="cardName">Cardholder Name:</label>
    <input type="text" id="cardName" name="cardName" placeholder="Please enter a valid credit card name holder"  required>

    <label for="expirationDate">Expiration Date:</label>
    <input type="text" id="expirationDate" name="expirationDate" placeholder="MM/YY" pattern="\d{2}/\d{2}" title="Please enter a valid MM/YY format">

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required>

    <label for="cardNumber">Amount:</label>
    <input type="text" readonly id="amount" name="amount" value="{{ $amount }}" required>

    <input type="submit" value="Submit">
  </form>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    document.getElementById('expirationDate').addEventListener('input', function (e) {
        var input = e.target;
        var value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
        var formattedValue = value.replace(/(\d{2})(\d{0,2})/, '$1/$2').substring(0, 5);

        input.value = formattedValue;

        // Validate for a future date
        var currentDate = new Date();
        var enteredDate = new Date(formattedValue.split('/').reverse().join('-'));
        // Validate the month (01-12)
        
        var enteredMonth = parseInt(formattedValue.split('/')[0], 10);
        if (isNaN(enteredMonth) || enteredMonth < 1 || enteredMonth > 12) {
 
            input.setCustomValidity('Invalid month. Please enter a valid month (01-12).');
        } else if (enteredMonth === 12 && enteredDate < currentDate) {

            input.setCustomValidity('Expiration date must be in the future');
        } else if (enteredDate < currentDate) {
            input.setCustomValidity('Invalid expiration date. Please enter a future date.');
        } else {
            input.setCustomValidity('');
        }
    });
</script>

<script>
  document.getElementById('cardNumber').addEventListener('input', function (event) {
    let inputValue = event.target.value.replace(/\D/g, ''); // Remove non-digit characters
    let formattedValue = formatCreditCardNumber(inputValue);
    event.target.value = formattedValue;
  });

  function formatCreditCardNumber(value) {
    // Add a space after every 4 digits and limit the length to 16 characters
    return value.replace(/(\d{4})/g, '$1 ').trim().slice(0, 19);
  }
</script>

<script>
        $(document).ready(function () {
            // Add validation rules to the cardNumber input
            $("#cardNumber").validate({
                rules: {
                    cardNumber: {
                        required: true,
                        creditcard: true // Use the creditcard rule for basic credit card validation
                    }
                },
                messages: {
                    cardNumber: {
                        required: "Please enter a valid credit card number",
                        creditcard: "Please enter a valid credit card number"
                    }
                }
            });
        });
    </script>

<script>
    $(document).ready(function () {
        $('#cvv').on('input', function () {
            // Remove non-numeric characters
            var sanitizedValue = $(this).val().replace(/[^0-9]/g, '');

            // Update the input value
            $(this).val(sanitizedValue);

            // Ensure only 3 characters are allowed
            if (sanitizedValue.length > 3) {
                $(this).val(sanitizedValue.slice(0, 3));
            }
        });
    });
</script>