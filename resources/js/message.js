import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

export default function showMessage(message, type = "success") {
    const bgMsg = type === "success" ? "#00b09b" : "#f85032";
    Toastify({
        text: message,
        duration: 1500,
        newWindow: true,
        close: true,
        gravity: "bottom", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: bgMsg,
        },
        onClick: function () {}, // Callback after click
    }).showToast();
}
