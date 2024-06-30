<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se todas as variáveis foram definidas
    $nome = isset($_POST['nome']) ? htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8') : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
    $telefone = isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone'], ENT_QUOTES, 'UTF-8') : '';
    $endereco = isset($_POST['endereco']) ? htmlspecialchars($_POST['endereco'], ENT_QUOTES, 'UTF-8') : '';
    $data_nascimento = isset($_POST['data_nascimento']) ? htmlspecialchars($_POST['data_nascimento'], ENT_QUOTES, 'UTF-8') : '';
    $objetivo = isset($_POST['objetivo']) ? htmlspecialchars($_POST['objetivo'], ENT_QUOTES, 'UTF-8') : '';
    $experiencias = isset($_POST['experiencia']) ? $_POST['experiencia'] : [];
    $formacao = isset($_POST['formacao']) ? htmlspecialchars($_POST['formacao'], ENT_QUOTES, 'UTF-8') : '';
    $habilidades = isset($_POST['habilidades']) ? htmlspecialchars($_POST['habilidades'], ENT_QUOTES, 'UTF-8') : '';

    // Calcular a idade com base na data de nascimento
    $data_atual = new DateTime();
    $data_nasc = new DateTime($data_nascimento);
    $idade = $data_atual->diff($data_nasc)->y;

    echo "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Currículo de $nome</title>
        <link rel='stylesheet' href='curriculo.css'>
        <style>
            @media print {
                body * {
                    visibility: hidden;
                }
                .curriculo, .curriculo * {
                    visibility: visible;
                }
                .curriculo {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                }
                .buttons {
                    display: none;
                }
            }
        </style>
        <script>
            function imprimirCurriculo() {
                window.print();
            }

            function baixarCurriculo() {
                const curriculoHtml = document.querySelector('.curriculo').outerHTML;
                const blob = new Blob([curriculoHtml], { type: 'text/html' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'curriculo.html';
                link.click();
            }
        </script>
    </head>
    <body>
        <div class='curriculo'>
            <h1>Currículo</h1>
            <div class='section'>
                <h2>Informações Pessoais</h2>
                <p><strong>Nome:</strong> $nome</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Telefone:</strong> $telefone</p>
                <p><strong>Endereço:</strong> $endereco</p>
                <p><strong>Data de Nascimento:</strong> $data_nascimento</p>
                <p><strong>Idade:</strong> $idade anos</p>
            </div>
            <div class='section'>
                <h2>Objetivo</h2>
                <p>$objetivo</p>
            </div>
            <div class='section'>
                <h2>Experiência</h2>";
                foreach ($experiencias as $exp) {
                    $exp = htmlspecialchars($exp, ENT_QUOTES, 'UTF-8');
                    echo "<p>$exp</p>";
                }
            echo "</div>
            <div class='section'>
                <h2>Formação</h2>
                <p>$formacao</p>
            </div>
            <div class='section'>
                <h2>Habilidades</h2>
                <p>$habilidades</p>
            </div>
        </div>
        <div class='buttons'>
            <button onclick='imprimirCurriculo()'>Imprimir</button>
            <button onclick='baixarCurriculo()'>Baixar</button>
        </div>
    </body>
    </html>";
} else {
    echo "Método de requisição inválido.";
}
?>
