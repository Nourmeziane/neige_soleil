
<?php
if (isset($_GET['id'])) {
    require_once './php/modele/modele_reservations.php';
    $modele = new ModeleReservation();

    $month = isset($_GET['month']) ? $_GET['month'] : date('m');
    $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
    $reservations = $modele->getReservations($_GET['id'], $month, $year);

} else {
    header('Location: ./sejour.php');
    exit;
}

if (!empty($message)) {
    echo "<p>$message</p>";
}

$prev_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
$prev_year = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
$next_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
$next_year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));

$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
$numberDays = date('t', $firstDayOfMonth);
$dateComponents = getdate($firstDayOfMonth);
$monthName = $dateComponents['month'];
$dayOfWeek = $dateComponents['wday'] - 1; // Ajuster pour que Lundi soit le premier jour de la semaine
if ($dayOfWeek < 0) {
    $dayOfWeek = 6;
}

$reservedDays = [];
foreach ($reservations as $reservation) {
    $startTimestamp = strtotime($reservation['DateD']);
    $endTimestamp = strtotime($reservation['DateF']);
    for ($currentTimestamp = $startTimestamp; $currentTimestamp <= $endTimestamp; $currentTimestamp += 86400) {
        // S'assurer que le jour appartient bien au mois et à l'année courants
        if (date('Y-m', $currentTimestamp) == "$year-$month") {
            $reservedDay = date('j', $currentTimestamp); // Jour du mois
            $reservedDays[$reservedDay] = true;
        }
    }
}

echo "<h2>$monthName $year</h2>";
echo "<a href='" . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . "?id=" . $_GET['id'] . "&month=" . $prev_month . "&year=" . $prev_year . "'>Mois précédent</a> ";
echo "<a href='" . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . "?id=" . $_GET['id'] . "&month=" . $next_month . "&year=" . $next_year . "'>Mois suivant</a>";

echo "<table>";
echo "<tr><th>Lun</th><th>Mar</th><th>Mer</th><th>Jeu</th><th>Ven</th><th>Sam</th><th>Dim</th></tr><tr>";

if ($dayOfWeek > 0) {
    echo str_repeat("<td></td>", $dayOfWeek);
}

$currentDay = 1;

while ($currentDay <= $numberDays) {
    if ($dayOfWeek == 7) {
        $dayOfWeek = 0;
        echo "</tr><tr>";
    }

    // Vérification correcte pour afficher un jour comme réservé ou non
    if (isset($reservedDays[$currentDay])) {
        echo "<td class='bg-warning'>$currentDay</td>"; // Jour réservé
    } else {
        echo "<td><a href='" . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . "?id=" . $_GET['id'] . "&month=" . $month . "&year=" . $year . "&resa=" . sprintf('%02d', $currentDay) . "'>$currentDay</a></td>";

    }
    $currentDay++;
    $dayOfWeek++;
}

if ($dayOfWeek != 7) {
    echo str_repeat("<td></td>", 7 - $dayOfWeek);
}

echo "</tr></table>";
?>
