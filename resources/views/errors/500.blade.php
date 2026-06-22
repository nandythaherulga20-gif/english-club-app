<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Terjadi Kesalahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 100vh;">
        <i class="bi bi-exclamation-octagon text-danger" style="font-size: 4rem;"></i>
        <h1 class="mt-3 fw-bold">500</h1>
        <h5 class="text-muted mb-3">Terjadi Kesalahan pada Server</h5>
        <p class="text-muted" style="max-width: 420px;">
            Maaf, terjadi kesalahan internal. Silakan coba lagi nanti atau hubungi Admin.
        </p>
        <a href="{{ url('/dashboard') }}" class="btn btn-primary mt-2">
            <i class="bi bi-house-door"></i> Kembali ke Dashboard
        </a>
    </div>
</body>
</html>