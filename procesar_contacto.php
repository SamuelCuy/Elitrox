<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: Contacto.html");
    exit;
}
$nombre = trim(is_string($_POST["nombre"] ?? null) ? $_POST["nombre"] : "");
$correo = trim(is_string($_POST["correo"] ?? null) ? $_POST["correo"] : "");
$asunto = trim(is_string($_POST["asunto"] ?? null) ? $_POST["asunto"] : "");
$mensaje = trim(is_string($_POST["mensaje"] ?? null) ? $_POST["mensaje"] : "");
$errores = [];
if ($nombre === "") $errores[] = "El nombre es obligatorio.";
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = "El correo electrónico no es válido.";
if ($asunto === "") $errores[] = "El asunto es obligatorio.";
if ($mensaje === "") $errores[] = "El mensaje es obligatorio.";
if ((function_exists("mb_strlen") ? mb_strlen($nombre) : strlen($nombre)) > 120) $errores[] = "El nombre no debe superar 120 caracteres.";
if ((function_exists("mb_strlen") ? mb_strlen($asunto) : strlen($asunto)) > 160) $errores[] = "El asunto no debe superar 160 caracteres.";
if ((function_exists("mb_strlen") ? mb_strlen($mensaje) : strlen($mensaje)) > 5000) $errores[] = "El mensaje no debe superar 5000 caracteres.";
function e(string $valor): string { return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title><?= $errores ? 'Revisa el formulario' : 'Mensaje recibido' ?> | ELITROX</title><link rel="stylesheet" href="Estilo.css"><link rel="stylesheet" href="css/mejoras.css"></head>
<body><main class="contenedor" style="max-width:820px;margin:70px auto;padding:28px"><section class="pagina resultado" style="padding:clamp(24px,5vw,48px);background:#10191d;border:1px solid #2a3a40;border-radius:16px">
<?php if ($errores): ?>
<h1>No se pudo enviar el mensaje</h1><p>Por favor, revisa estos campos:</p><ul class="lista"><?php foreach ($errores as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul><a class="boton" href="Contacto.html">Volver al formulario</a>
<?php else: ?>
<div class="resultado-icono" aria-hidden="true">✅</div><h1>¡Mensaje recibido!</h1><p>Gracias, <strong><?= e($nombre) ?></strong>. Los datos del formulario se validaron correctamente.</p><div class="mensaje-recibido"><p><strong>Correo:</strong> <?= e($correo) ?></p><p><strong>Asunto:</strong> <?= e($asunto) ?></p><p><strong>Mensaje:</strong></p><p><?= nl2br(e($mensaje)) ?></p></div><p><em>Nota: esta versión de práctica muestra la confirmación en pantalla; todavía no envía el mensaje por correo ni lo guarda en una base de datos.</em></p><a href="Inicio.html" class="boton">Volver al inicio</a>
<?php endif; ?></section></main></body></html>
