<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro em Etapas</title>
    <link rel="stylesheet" href="css/style2.css">
</head>

<body>

    <main class="container-cadastro">

        <header class="form-header">
            <h2>Crie sua Conta</h2>
            <p>Preencha os dados abaixo em 3 passos simples.</p>

            <div class="progresso">
                <span class="etapa-indicador ativo">1</span>
                <span class="etapa-indicador">2</span>
                <span class="etapa-indicador">3</span>
            </div>
        </header>

        <form action="index.php?action=store" method="POST" id="formWizard">

            <fieldset class="etapa ativa" id="etapa1">
                <legend>Dados Pessoais</legend>

                <div class="grupo-input">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Ex: Maria Silva" required>
                </div>

                <div class="grupo-input">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" oninput="mascaraCPF(this)"
                        required>
                </div>

                <div class="acoes-form">
                    <button type="button" class="btn-primario" onclick="mudarEtapa(1, 2)">Avançar</button>
                </div>
            </fieldset>

            <fieldset class="etapa" id="etapa2">
                <legend>Informações de Contato</legend>

                <div class="grupo-input">
                    <label for="email">E-mail Profissional</label>
                    <input type="email" id="email" name="email" placeholder="maria@exemplo.com" required>
                </div>

                <div class="acoes-form espaco-entre">
                    <button type="button" class="btn-secundario" onclick="mudarEtapa(2, 1)">Voltar</button>
                    <button type="button" class="btn-primario" onclick="mudarEtapa(2, 3)">Avançar</button>
                </div>
            </fieldset>

            <fieldset class="etapa" id="etapa3">
                <legend>Segurança da Conta</legend>

                <div class="grupo-input">
                    <label for="senha">Crie uma Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <div class="acoes-form espaco-entre">
                    <button type="button" class="btn-secundario" onclick="mudarEtapa(3, 2)">Voltar</button>
                    <button type="submit" class="btn-sucesso">Finalizar Cadastro</button>
                </div>
            </fieldset>

        </form>
    </main>

    <script>
        function mudarEtapa(atual, proxima) {
            // Esconde a etapa atual
            document.getElementById('etapa' + atual).classList.remove('ativa');
            // Mostra a próxima
            document.getElementById('etapa' + proxima).classList.add('ativa');

            // Atualiza as bolinhas de progresso
            const indicadores = document.querySelectorAll('.etapa-indicador');
            indicadores.forEach((ind, index) => {
                if (index < proxima) ind.classList.add('ativo');
                else ind.classList.remove('ativo');
            });
        }

        function mascaraCPF(input) {
            let valor = input.value;

            // remove tudo que não é número
            valor = valor.replace(/\D/g, '');

            // limita a 11 dígitos
            valor = valor.substring(0, 11);

            // aplica a máscara
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            input.value = valor;
        }
    </script>

</body>

</html>