<?php
// public/index.php

// Aquí podrías cargar la configuración, iniciar sesiones, conectar a la base de datos, etc.
// Este es un ejemplo básico para mostrar la estructura y enlaces principales.

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Medussa CRM - Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8fafc; margin: 0; padding: 0; }
        .container { max-width: 800px; margin: 50px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 12px #ddd; padding: 30px; }
        h1 { color: #006699; }
        ul { list-style: none; padding: 0; }
        li { margin: 15px 0; }
        a { text-decoration: none; color: #1a78b8; font-weight: bold; }
        a:hover { text-decoration: underline; }
        .footer { text-align: center; margin-top: 30px; color: #999; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido a Medussa CRM</h1>
        <p>¡Tu plataforma de gestión para ISP profesional!</p>

        <h2>Módulos principales</h2>
        <ul>
            <li><a href="/medussa/ai_local/index.php">IA Local - Asistente de Programación</a></li>
            <li><a href="#">Gestión de Clientes</a></li>
            <li><a href="#">Telefonía VoIP</a></li>
            <li><a href="#">Gestión OLT y ONUs</a></li>
            <li><a href="#">Streaming y Multimedia</a></li>
            <li><a href="#">Inventarios</a></li>
            <li><a href="#">Finanzas y Cobranza</a></li>
            <li><a href="#">Premios y Referidos</a></li>
            <li><a href="#">Administración y Configuración</a></li>
        </ul>

        <div class="footer">
            &copy; <?php echo date('Y'); ?> Medussa CRM | Desarrollado para ISPs modernos.
        </div>
    </div>
</body>
</html>
