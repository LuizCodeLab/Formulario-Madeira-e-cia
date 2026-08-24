<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Madeira e Cia Ltda</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, #5b3a29, #8a5a3c);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #fffaf5;
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            overflow: hidden;
        }

        .card-header {
            background: #6b4423;
            color: #fff;
            padding: 24px;
            text-align: center;
        }

        .card-body {
            padding: 24px;
            color: #4a2f1c;
            line-height: 1.7;
        }

        .card-body strong {
            color: #6b4423;
        }

        a button {
            width: 100%;
            padding: 12px;
            background: #8a5a3c;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        a button:hover {
            background: #6b4423;
        }
    </style>
</head>
<body>

<?php
    // ===========================================================
    // ETAPA 1: VERIFICA SE OS DADOS VIERAM DE UM ENVIO POST
    // ===========================================================
    // $_SERVER["REQUEST_METHOD"] informa como a página foi acessada.
    // Isso evita erros caso alguém digite a URL diretamente no navegador
    // (sem passar pelo formulário), pois nesse caso $_POST estaria vazio.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // ===========================================================
        // ETAPA 2: RECEBE OS DADOS ENVIADOS PELO FORMULÁRIO
        // ===========================================================
        // Cada $_POST['nomeDoCampo'] busca o valor pelo "name" definido
        // no <input> ou <select> do arquivo formulario.php
        $nome = $_POST["txtNome"];
        $valorCompra = $_POST["txtValorCompra"];
        $formaPagamento = $_POST["cmbPag"];
        $desconto = 0; // inicializa em 0 para evitar erro caso nenhuma condição seja atendida

        // ===========================================================
        // ETAPA 3: ENCADEAMENTO DE DECISÕES (if / elseif / else)
        // ===========================================================
        
        if ($formaPagamento == "cartaoCredito") {
            $desconto = 0;                    // cartão de crédito não tem desconto
            $formaTexto = "cartão de crédito"; // texto usado depois na mensagem
        } elseif ($formaPagamento == "boleto") {
            $desconto = $valorCompra * 0.08;  // CORRIGIDO: boleto = 8%
            $formaTexto = "boleto";
        } elseif ($formaPagamento == "deposito") {
            $desconto = $valorCompra * 0.10;  // CORRIGIDO: depósito = 10%
            $formaTexto = "depósito";
        } else {
            // Caso o valor de cmbPag não bata com nenhuma opção esperada
            $formaTexto = null;
        }

        // ===========================================================
        // ETAPA 4: MONTA A MENSAGEM FINAL PARA O CLIENTE
        // ===========================================================
        if ($formaTexto !== null) {

            
            // Aqui calculamos o valor final subtraindo o desconto da compra.
            $valorFinal = $valorCompra - $desconto;

        
            // number_format($valor, casasDecimais, separadorDecimal, separadorMilhar)
            
            $valorCompraFmt = number_format($valorCompra, 2, ',', '.');
            $descontoFmt   = number_format($desconto, 2, ',', '.');
            $valorFinalFmt = number_format($valorFinal, 2, ',', '.');

            // Concatenação (.) para montar a frase final juntando texto e variáveis
            $mensagem = "Olá, $nome! Sua compra de R$ $valorCompraFmt foi realizada com $formaTexto. "
                      . "Desconto aplicado: R$ $descontoFmt. "
                      . "Valor final a pagar: R$ $valorFinalFmt.";
        } else {
            $mensagem = "Forma de pagamento inválida.";
        }
?>
        <!-- ===========================================================
             ETAPA 5: EXIBE O RESULTADO NA TELA (HTML + PHP misturados)
             =========================================================== -->
        <div class="card">
            <div class="card-header">
                <h1>Resultado da Compra</h1>
            </div>
            <div class="card-body">
                <p><?php echo $mensagem; ?></p>
                <!-- Botão de voltar: link simples apontando para o formulário -->
                <a href="formulario.php"><button>Voltar</button></a>
            </div>
        </div>
<?php
    } else {
        // ===========================================================
        // ETAPA 6: TRATAMENTO DE ACESSO DIRETO (sem passar pelo formulário)
        // ===========================================================
        echo "<p style='color:white;text-align:center;'>Nenhum dado recebido. 
              <a href='formulario.php'>Voltar ao formulário</a></p>";
    }
?>

</body>
</html>

