<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensagem = trim($_POST["mensagem"]);

    if (empty($nome) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($mensagem)) {
        http_response_code(400);
        echo "Por favor, preencha o formulário corretamente.";
        exit;
    }

    $destinatario = "ednmirand@gmail.com"; 
    $assunto = "Nova mensagem do site de $nome";

    $conteudo = "Nome: $nome\n";
    $conteudo .= "Email: $email\n\n";
    $conteudo .= "Mensagem:\n$mensagem\n";

    $headers = "From: $nome <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($destinatario, $assunto, $conteudo, $headers)) {
        http_response_code(200);
        echo "Mensagem enviada com sucesso!";
    } else {
        http_response_code(500);
        echo "Ocorreu um erro ao enviar sua mensagem.";
    }
} else {
    http_response_code(403);
    echo "O envio deve ser feito via formulário.";
}
?>
