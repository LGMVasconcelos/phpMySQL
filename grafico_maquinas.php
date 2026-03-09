<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [ 'Tipo', 'Status'],
            <?php 
                $sql_grafico = "SELECT tipo_maquina, status_operacional, COUNT(*) AS quantidade FROM tb_maquinas GROUP BY tipo_maquina, status_operacional";
                $res_grafico = mysqli_query($conn, $sql_grafico);
                if ($res_grafico) {
                    while ($row = mysqli_fetch_assoc($res_grafico)) {
                        $tipo = $row['tipo_maquina'] ?? 'Desconhecido';
                        $status = $row['status_operacional'] ?? 'Desconhecido';
                        echo "['$tipo - $status', " . $row['quantidade'] . "],";
                    }
                }
            ?>
        ]);

        var options = {
          title: 'Relatório de Máquinas - Status e Tipo',
          pieHole: 0.4,
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 620px; height: 420px;"></div>
  </body>
</html>