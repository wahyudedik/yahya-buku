<!DOCTYPE html>
<html>
<head>
    <title>Pesan Baru dari Website</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #002B8F;">Pesan Baru dari Website Pena Langit</h2>
        <p>Anda menerima pesan baru dari formulir kontak website.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p><strong>Nama:</strong> {{ $data['name'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Pesan:</strong></p>
            <p style="white-space: pre-wrap;">{{ $data['message'] }}</p>
        </div>
        
        <p style="font-size: 12px; color: #888;">Email ini dikirim otomatis dari website Pena Langit Publishing.</p>
    </div>
</body>
</html>