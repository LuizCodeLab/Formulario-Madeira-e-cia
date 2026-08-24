<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promocao de Aniversario - Madeira e Cia Ltda</title>

    <!--
        ===========================================================
        ETAPA 1: ESTILIZACAO (CSS)
        ===========================================================

    -->
    <style>
        /* Reset basico: remove espacamentos padrao do navegador
           e define a fonte para todos os elementos */
        * {
            box-sizing: border-box; /* padding e border nao aumentam o tamanho total do elemento */
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        /* Fundo da pagina inteira: gradiente de marrom (tema "madeira") */
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #5b3a29, #8a5a3c);
            min-height: 100vh;       /* ocupa a altura inteira da tela */
            display: flex;           /* flexbox para centralizar o card */
            justify-content: center; /* centraliza horizontalmente */
            align-items: center;     /* centraliza verticalmente */
        }

        /* O "cartao" branco que contem o formulario */
        .card {
            background: #fffaf5;
            width: 100%;
            max-width: 420px;        /* largura maxima, fica responsivo em telas menores */
            border-radius: 12px;     /* cantos arredondados */
            box-shadow: 0 10px 25px rgba(0,0,0,0.25); /* sombra para dar profundidade */
            overflow: hidden;
        }

        /* Cabecalho do card (nome da empresa) */
        .card-header {
            background: #6b4423;
            color: #fff;
            padding: 24px;
            text-align: center;
        }

        .card-header h1 {
            margin: 0;
            font-size: 22px;
        }

        .card-header p {
            margin: 6px 0 0;
            font-size: 13px;
            opacity: 0.85;
        }

        /* Corpo do card, onde fica o formulario */
        .card-body {
            padding: 24px;
        }

        label {
            display: block;      /* cada label ocupa uma linha inteira */
            margin-bottom: 6px;
            font-weight: 600;
            color: #4a2f1c;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #d8c3ac;
            border-radius: 6px;
            font-size: 14px;
            background: #fff;
        }

        /* Efeito visual quando o usuario clica no campo */
        input:focus, select:focus {
            outline: none;
            border-color: #8a5a3c;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #8a5a3c;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: #6b4423; /* escurece o botao ao passar o mouse */
        }

        /* Caixa de aviso mostrando as regras da promocao */
        .promo-box {
            background: #f3e6d8;
            border-left: 4px solid #8a5a3c;
            padding: 10px 14px;
            font-size: 13px;
            color: #4a2f1c;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="card">

        <!-- ETAPA 2: Cabecalho -->
        <div class="card-header">
            <h1>Madeira e Cia Ltda</h1>
            <p>Promocao de Aniversario</p>
        </div>

        <div class="card-body">

            <!-- ETAPA 3: Aviso com as regras de desconto, so para informar o cliente -->
            <div class="promo-box">
                Depósito: 10% de desconto &nbsp;|&nbsp; Boleto: 8% &nbsp;|&nbsp; Cartao: sem desconto
            </div>

            <!--
                ===========================================================
                ETAPA 4: FORMULÁRIO
                ===========================================================
                method="post"          -> os dados sao enviados de forma oculta (nao aparecem na URL)
                action="resultado.php" -> arquivo que vai RECEBER e processar os dados quando o botão for clicado
            -->
            <form method="post" action="resultado.php">

                <!-- Campo Nome do Cliente -->
                <label for="txtNome">Nome do Cliente</label>
                <input type="text" id="txtNome" name="txtNome" required>
                <!-- "required" impede o envio do formulario se o campo estiver vazio -->

                <!-- Campo Valor da Compra -->
                <label for="txtValorCompra">Valor da Compra (R$)</label>
                <input type="number" id="txtValorCompra" name="txtValorCompra" step="0.01" min="0" required>
                <!-- step="0.01" permite digitar centavos, min="0" impede valores negativos -->

                <!-- Campo Forma de Pagamento: select = caixa de selecao (combo) -->
                <label for="cmbPag">Forma de Pagamento</label>
                <select id="cmbPag" name="cmbPag" required>
                    <option value="">Selecione...</option>
                    <!-- O "value" de cada opcao e o que chega no PHP via $_POST['cmbPag'] -->
                    <option value="deposito">Deposito</option>
                    <option value="boleto">Boleto</option>
                    <option value="cartaoCredito">Cartao de Credito</option>
                </select>

                <!-- Botao de envio: por ser do tipo submit dentro de um <form>, dispara o envio -->
                <button type="submit">Calcular Desconto</button>

            </form>
        </div>
    </div>

</body>
</html>