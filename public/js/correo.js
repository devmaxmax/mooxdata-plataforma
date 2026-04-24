window.onSubmit = function (token) {
    const form = document.getElementById("contactForm");
    const formData = new FormData(form);

    formData.append('g-recaptcha-response', token);

    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/send_mail', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                form.reset();
            } else {
                alert('Error: ' + (data.message || 'Error de validación.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al enviar el mensaje. Intente más tarde.');
        });
};