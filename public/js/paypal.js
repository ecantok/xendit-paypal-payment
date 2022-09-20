function intialPaypal() {
    paypal
        .Buttons({
            style: {
                shape: "rect",
                color: "blue",
                layout: "vertical",
                label: "buynow",
            },
            createOrder: function (data, actions) {
                return fetch("api/paypal-gateway/checkout", {
                    method: "POST",
                    body: JSON.stringify({
                        amount: document
                            .querySelector("#paypal-button-container")
                            .getAttribute("data-amount"),
                    }),
                })
                    .then((response) => {
                        return response.json();
                    })
                    .then((orderData) => {
                        return orderData.id;
                    });
            },
            onApprove: (data, actions) => {
                return fetch(`api/paypal-gateway/capture`, {
                    method: "POST",
                    body: JSON.stringify({
                        orderId: data.orderID,
                    }),
                })
                    .then((response) => {
                        return response.json();
                    })
                    .then((callbackData) => {
                        console.log(callbackData);
                        if (callbackData.status == "COMPLETED") {
                            setTimeout(function () {
                                Swal.fire({
                                    icon: "success",
                                    title: `Payment Success`,
                                    text: `Transaction Complete Your ID is ${callbackData.id}`,
                                    showConfirmButton: true,
                                });
                            }, 1000);
                        } else if (
                            callbackData.error == "INSTRUMENT_DECLINED"
                        ) {
                            return actions.restart();
                        }
                    });
            },

            onError: (err) => {
                console.log(err);
                setTimeout(function () {
                    Swal.fire({
                        icon: "error",
                        title: `Transaction Failed Or Cancel`,
                        showConfirmButton: true,
                    });
                }, 1000);
            },
        })
        .render("#paypal-button-container");
}

intialPaypal();
