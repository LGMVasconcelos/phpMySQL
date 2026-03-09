<?php
include_once("conexao.php");
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Máquina</title>
    <link rel="stylesheet" href="cadastro.css">
    <script>
        function gerarTag() {
            const tipoMaquina = document.getElementById('tipo_maquina').value;
            
            if (!tipoMaquina) {
                document.getElementById('tag_maquina').value = '';
                return;
            }
            

            fetch('gerar_tag.php?tipo_maquina=' + encodeURIComponent(tipoMaquina))
                .then(response => response.json())
                .then(data => {
                    document.getElementById('tag_maquina').value = data.tag;
                })
                .catch(error => console.error('Erro:', error));
        }
    </script>
</head>
<body>
    <div>
        <form class="form" method="POST" action="validacao_maquina.php">
            <p class="title">Cadastro de Máquina</p>
            <p class="message">Preencha os dados da nova máquina.</p>
            <label>
                <input readonly type="text" class="input" id="tag_maquina" name="tag_maquina" style="cursor: not-allowed; background-color: #f0f0f0;">
                <span>Tag da Máquina (gerada automaticamente)</span>
            </label>
            <label>
                <select class="input" id="tipo_maquina" name="tipo_maquina" required onchange="gerarTag()">
                    <option value="" disabled>Selecione o tipo da máquina</option>
                    <option value="Braço Robótico">Braço Robótico</option>
                    <option value="Célula de pintura">Célula de pintura</option>
                    <option value="Corte a Laser">Corte a Laser</option>
                    <option value="Embaladora">Embaladora</option>
                    <option value="Extrusora">Extrusora</option>
                    <option value="Linha de Montagem">Linha de Montagem</option>
                    <option value="Prensa Hidráulica">Prensa Hidráulica</option>
                    <option value="Solda Robotizada">Solda Robotizada</option>
                    <option value="Torno CNC">Torno CNC</option>
                </select>
                <span>Tipo da Máquina</span>
            </label>
            <label>
                <select class="input" id="status_operacional" name="status_operacional" required>
                    <option value="">Selecione o status operacional</option>
                    <option value="ativo">Ativo</option>
                    <option value="manutencao">Em manutenção</option>
                    <option value="parado">Parado</option>
                </select>
                <span>Status Operacional</span>
            </label>
            <button class="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>