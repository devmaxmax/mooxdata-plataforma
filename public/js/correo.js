window.onSubmit = function (token) {
    const form = document.getElementById("contactForm");
    const formData = new FormData(form);

    formData.append('g-recaptcha-response', token);

    fetch('send_mail.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                form.reset();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al enviar el mensaje. Intente más tarde.');
        });
};