<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rozgrywki futbolowe</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="baner">
        <h2>Światowe rozgrywki piłkarskie</h2>
        <img src="obraz1.jpg" alt="boisko">
    </div>
    <section class="mecze">
        <?php
            $conn=mysqli_connect("localhost","root","","egzamin");
            $query1 = "SELECT `zespol1`, `zespol2`, `wynik`, `data_rozgrywki` FROM rozgrywka WHERE `zespol1`='EVG'";
            $result1 = mysqli_query($conn,$query1);

            while($row = mysqli_fetch_array($result1)){
                echo "<div class=\"mecz\">";
                echo "<h3>$row[zespol1] - $row[zespol2]</h3>";
                echo "<h4>$row[wynik]</h4>";
                echo "<p>w dniu: $row[data_rozgrywki]</p>";
                echo "</div>";
            }
            mysqli_close($conn);
        ?>
    </section>
    <div class="main">
        <h2>Reprezentacja Polski</h2>
    </div>
    <main>
        <div class="lewy">
            <p>Podaj pozycję (1-bramkarze, 2-obrońcy, 3-pomocnicy, 4-napastnicy)</p>
            <form method="post" action="futbol.php">
                <label for="numer">
                    <input type="number" name="numer" id="numer">
                </label>
                <button type="submit" id="przycisk">Sprawdź</button>
            </form>
            <ul>
                <?php
                    if (isset($_REQUEST['numer']) && $_REQUEST['numer'] != "") {
                        $conn=mysqli_connect("localhost","root","","egzamin");
                        $qrr = $conn->prepare("SELECT imie, nazwisko FROM zawodnik WHERE pozycja_id = ?");
                        $qrr->bind_param("i", $_REQUEST['numer']);
                        $qrr->execute();
                        $result = $qrr->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $i = $row['imie'];
                            $n = $row['nazwisko'];
                            echo "<li>$i $n</li>";
                        }
                        mysqli_close($conn);
                    }
                ?>
            </ul>
        </div>
        <div class="prawy">
            <img src="zad1.png" alt="piłkarz">
            <p>Autor: Jakub Chybowski 5J</p>
        </div>
    </main>
</body>
</html>