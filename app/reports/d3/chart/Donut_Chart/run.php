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
    exit;
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

<script>
    setTimeout(function() {
        $.ajax({
            type: "POST",
            // url: "run.php",
            data: {
                command: "second"
            },
            success: function(response) {
                $('#report_render').html(response);
            },
        });
    }, 1000);

    setTimeout(function() {
        $.ajax({
            type: "POST",
            // url: "run.php",
            data: {
                command: "final"
            },
            success: function(response) {
                $('#report_render').html(response);
            },
        });
    }, 2000);
</script>