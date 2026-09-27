<?php
// Обработка формы обратной связи

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Читаем данные
    $name     = trim($_POST['name'] ?? '');
    $company  = trim($_POST['company'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $interest = trim($_POST['interest'] ?? '');
    $message  = trim($_POST['message'] ?? '');

    // 2. Куда отправлять
    $to = "gda@okna.kg"; // ← ВСТАВЬ СВОЙ EMAIL

    // 3. Заголовки письма
    $subject = "Заявка с сайта KABANASIA";
    $headers  = "From: KABANASIA <no-reply@kaban.asia>\r\n";
    $headers .= "Reply-To: ".$phone."\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // 4. Тело письма
    $body = "
        <h2>Новая заявка с сайта KABANASIA</h2>
        <p><strong>Имя:</strong> {$name}</p>
        <p><strong>Компания:</strong> {$company}</p>
        <p><strong>Телефон:</strong> {$phone}</p>
        <p><strong>Интересует:</strong> {$interest}</p>
        <p><strong>Сообщение:</strong><br>".nl2br(htmlspecialchars($message))."</p>
        <hr>
        <p>Дата: ".date('d.m.Y H:i')."</p>
    ";

    // 5. Попытка отправки
    $success = mail($to, $subject, $body, $headers);

    // 6. Редирект с флагом успеха
    if ($success) {
        header("Location: index.php?sent=1#contacts");
        exit;
    } else {
        header("Location: index.php?sent=0#contacts");
        exit;
    }
}

header('Location: index.php');
exit;

