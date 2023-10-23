

function keyup() {
    send = document.getElementById("btnsend");
    send.removeAttribute("disabled");

    if (!$('#sendmessage').val()) {
        document.getElementById("btnsend").disabled = true
    }
}