const calcPayback = (amount) => {
    if (isNaN(amount)) {
        return;
    }

    let payback = document.getElementById("payback");
    let total = document.getElementById("total").value;

    total = total.replace(/,/g, '');


    amount = parseFloat(amount);
    total = parseFloat(total);

    if (amount > total) {
        console.log("greater");
        payback.value = (amount - total).toFixed(2);
    }

    if (amount < total && amount > 0) {
        console.log("less");
        payback.value = 0;
    }

    if (amount === total) {
        console.log("equal");
        payback.value = 0;
    }
}

document.addEventListener("DOMContentLoaded", function () {
    var paymentType = document.getElementById("payment-type");
    var payment = document.getElementById("pay");

    // Hide payback group by default
    document.getElementById("payback-group").style.display = "none";

    // Show payback group if payment type is HandCash
    if (paymentType.value === "HandCash") {
        document.getElementById("payback-group").style.display = "block";
    }

    // Show payback group if payment type is HandCash
    paymentType.addEventListener("change", function () {
        if (paymentType.value === "HandCash") {
            document.getElementById("payback-group").style.display = "block";
        } else {
            document.getElementById("payback-group").style.display = "none";
        }
    });

    payment.addEventListener("input", function () {
        calcPayback(payment.value);
    });
});