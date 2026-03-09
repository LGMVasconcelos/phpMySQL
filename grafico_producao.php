<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Data - Turno', 'Quantidade Produzida'],
            <?php
                $sql_producao = "SELECT turno, DATE(data_producao) as data, SUM(qtd_produzida) as total 
                                 FROM tb_producao 
                                 WHERE data_producao >= DATE_SUB(CURDATE(), INTERVAL 3 DAY) 
                                 GROUP BY turno, data_producao 
                                 ORDER BY data_producao DESC, turno";
                $res_producao = mysqli_query($conn, $sql_producao);
                $tem_dados = false;
                if ($res_producao && mysqli_num_rows($res_producao) > 0) {
                    while ($row = mysqli_fetch_assoc($res_producao)) {
                        $turno = $row['turno'] ?? 'Sem Turno';
                        $data = $row['data'] ?? 'Sem Data';
                        $total = (int)$row['total'];
                        echo "['" . $data . " - Turno " . $turno . "', " . $total . "],";
                    }
                }
            ?>
        ]);

        var options = {
            title: 'Produção por Máquina e Turno - Últimos 3 Dias',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart.draw(data, options);
    }
</script>
  </head>
  <body>
    <div id="donutchart2" style="width: 620px; height: 420px;"></div>
  </body>
</html>
