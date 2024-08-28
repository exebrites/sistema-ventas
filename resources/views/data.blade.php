<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caja Horizontal de Menú de Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .user-menu-container {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Ajusta el ancho máximo según necesites */
            margin: 20px auto; /* Centrar horizontalmente en la página */
        }
        .user-menu__user-badge {
            text-align: center;
            margin-right: 10px;
        }
        .user-menu-evolution__user-badge-image {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            background-color: #ddd;
            border-radius: 50%;
            font-size: 18px;
            color: #fff;
            font-weight: bold;
        }
        .user-menu-evolution__user-badge-title {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Caja Horizontal de Menú de Usuario -->
    <div class="user-menu-container">
        <div class="user-menu__main">
            <div class="user-menu__user-info-outer-container user-menu__user-with-loyalty">
                <div class="user-menu__user-info-inner-container">
                    <!-- Badge de Usuario -->
                    <div class="user-menu__user-badge user-menu__user-badge--center">
                        <div class="user-menu-evolution__user-badge-image">
                            <div class="user-menu-evolution__user-initials">EB</div>
                        </div>
                        <div class="user-menu-evolution__user-badge-title">Exequiel</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
