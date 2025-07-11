<?php
\Config\Services::session();


require_once "MyReport.php";
$report = new MyReport;
$report->run();
// $report->render();
?>
<?php
if (isset($_POST['command'])) {
?>
    <div id="report_render">
        <?php
        $report->render();
        ?>
    </div>
<?php
    exit();
}
?>
<?php
if (!isset($_POST['command'])) {
?>
    <div id="report_render">
        <?php
        $report->render();
        ?>
    </div>
<?php
}
?>

<html>

<head>
    <title>
        Scriptable > Bubble | Chart.js sample
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="content">
        <div class="toolbar">
            <button id="randomize" class="btn">Randomize</button>
            <button id="addDataset" class="btn">Add Dataset</button>
            <button id="removeDataset" class="btn">Remove Dataset</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#randomize').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    // url: "run.php",
                    data: {
                        command: 'randomize',
                    },
                    success: function(response) {
                        $('#report_render').html(response);
                    }
                })
            })
            $('#addDataset').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    // url: "run.php",
                    data: {
                        command: 'addDataset',
                    },
                    success: function(response) {
                        $('#report_render').html(response);
                    }
                })
            })
            $('#removeDataset').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    // url: "run.php",
                    data: {
                        command: 'removeDataset',
                    },
                    success: function(response) {
                        $('#report_render').html(response);
                    }
                })
            })
        })
    </script>
    <div>
        <div id="report_render"></div>
    </div>
</body>

</html>