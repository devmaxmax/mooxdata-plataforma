<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nuevo mensaje de contacto</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Tienes un nuevo mensaje de contacto desde la web de MooxData</h2>
    
    <p><strong>Nombre/Empresa:</strong> {{ $contactData['name'] }}</p>
    <p><strong>Correo electrónico:</strong> {{ $contactData['email'] }}</p>
    
    <hr style="border: none; border-top: 1px solid #ccc; margin: 20px 0;">
    
    <h3>Mensaje (Desafío de datos a resolver):</h3>
    <p style="white-space: pre-line; background-color: #f9f9f9; padding: 15px; border-radius: 5px;">
        {{ $contactData['message'] }}
    </p>
</body>
</html>
