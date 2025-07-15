document.addEventListener("DOMContentLoaded", function () {
  const billingFields = document.querySelectorAll("#billingSection .form-control");
  const paymentFields = document.querySelectorAll("#paymentSection .form-control:required, #paymentSection #termsAgree");

  const nextBtn = document.getElementById("nextToPayment");
  const backBtn = document.getElementById("backToBilling");
  const completePurchaseBtn = document.getElementById("completePurchase");
  const backToHomeBtn = document.getElementById("backToHome");

  const billingSection = document.getElementById("billingSection");
  const paymentSection = document.getElementById("paymentSection");
  const confirmationSection = document.getElementById("confirmationSection");
  const checkoutForm = document.getElementById("checkoutForm");

  const step2 = document.getElementById("step2");
  const step3 = document.getElementById("step3");
  const step4 = document.getElementById("step4");

  const creditCardMethodDiv = document.getElementById("creditCardMethod");
  const paypalMethodDiv = document.getElementById("paypalMethod");
  const creditCardDetails = document.getElementById("creditCardDetails");

  nextBtn.disabled = true;
  completePurchaseBtn.disabled = true;

  function checkBillingFields() {
    let allFilled = Array.from(billingFields).every(field => field.value.trim() !== "");
    nextBtn.disabled = !allFilled;
    step2.classList.toggle("completed", allFilled);
  }

  billingFields.forEach(field => {
    field.addEventListener("input", checkBillingFields);
  });

  function checkPaymentFields() {
    let allFilled = true;
    paymentFields.forEach(field => {
      if (field.type === 'checkbox') {
        if (!field.checked) allFilled = false;
      } else if (!field.value.trim()) {
        allFilled = false;
      }
    });

    const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
    if (paymentMethod === "credit") {
      const requiredCardFields = ["cardName", "cardNumber", "cardExpiry", "cardCvc"];
      for (const id of requiredCardFields) {
        const field = document.getElementById(id);
        if (!field.value.trim()) {
          allFilled = false;
          break;
        }
      }
    }
    completePurchaseBtn.disabled = !allFilled;
    step3.classList.toggle("completed", allFilled);
  }

  paymentFields.forEach(field => {
    field.addEventListener("input", checkPaymentFields);
    field.addEventListener("change", checkPaymentFields);
  });

  function togglePaymentMethodDetails() {
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
    if (paymentMethod === "credit") {
      creditCardDetails.classList.add("active");
    } else {
      creditCardDetails.classList.remove("active");
    }
    checkPaymentFields();
  }

  document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
    radio.addEventListener("change", () => {
      creditCardMethodDiv.classList.remove("active");
      paypalMethodDiv.classList.remove("active");

      const selected = document.querySelector('input[name="payment_method"]:checked').id;
      if (selected === "creditCard") creditCardMethodDiv.classList.add("active");
      else if (selected === "paypal") paypalMethodDiv.classList.add("active");

      togglePaymentMethodDetails();
    });
  });

  togglePaymentMethodDetails();

  nextBtn.addEventListener("click", function () {
    if (
      !document.getElementById("firstName").value.trim() ||
      !document.getElementById("email").value.trim() ||
      !document.getElementById("country").value.trim()
    ) {
      alert("Please fill in all required billing information.");
      return;
    }

    billingSection.style.display = "none";
    paymentSection.style.display = "block";

    step2.classList.remove("active");
    step3.classList.add("active");

    checkPaymentFields();
  });

  backBtn.addEventListener("click", function () {
    paymentSection.style.display = "none";
    billingSection.style.display = "block";

    step3.classList.remove("active");
    step2.classList.add("active");
  });

  completePurchaseBtn.addEventListener("click", function (e) {
    e.preventDefault();

    const paymentMethodInput = document.querySelector('input[name="payment_method"]:checked');
    if (!paymentMethodInput) {
      alert("Please select a payment method.");
      return;
    }

    const paymentMethod = paymentMethodInput.value;

    if (paymentMethod === "credit") {
      const requiredCardFields = ["cardName", "cardNumber", "cardExpiry", "cardCvc"];
      for (const id of requiredCardFields) {
        const field = document.getElementById(id);
        if (!field.value.trim()) {
          alert("Please fill all credit card details.");
          return;
        }
      }
    }

    if (!document.getElementById("termsAgree").checked) {
      alert("Please agree to the Terms and Conditions.");
      return;
    }

    const orderData = {
      billing: {
        firstName: document.getElementById("firstName").value.trim(),
        lastName: document.getElementById("lastName").value.trim(),
        email: document.getElementById("email").value.trim(),
        phone: document.getElementById("phone").value.trim(),
        address: document.getElementById("address").value.trim(),
        city: document.getElementById("city").value.trim(),
        state: document.getElementById("state").value.trim(),
        zip: document.getElementById("zip").value.trim(),
        country: document.getElementById("country").value.trim(),
      },
      payment: {
        method: paymentMethod,
      },
      package: {
        total: 100000,
      },
    };

    if (paymentMethod === "credit") {
      orderData.payment.cardName = document.getElementById("cardName").value.trim();
      orderData.payment.cardNumber = document.getElementById("cardNumber").value.trim();
      orderData.payment.cardExpiry = document.getElementById("cardExpiry").value.trim();
      orderData.payment.cardCvc = document.getElementById("cardCvc").value.trim();
    }

    fetch("process_checkout.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(orderData),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          paymentSection.style.display = "none";
          confirmationSection.style.display = "block";

          step3.classList.remove("active");
          step4.classList.add("active");
          step4.classList.add("completed");

          document.getElementById("orderNumber").textContent = "WED2023-" + data.orderId;

          if (paymentMethod === "credit") {
            const cardNumber = orderData.payment.cardNumber;
            document.getElementById("paymentMethodSummary").textContent =
              "Credit Card ending in " + cardNumber.slice(-4);
          } else {
            document.getElementById("paymentMethodSummary").textContent = "PayPal";
          }
        } else {
          alert("Error: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred while processing your order.");
      });
  });

  backToHomeBtn.addEventListener("click", function () {
    alert("Redirecting to home page...");
  });
});
