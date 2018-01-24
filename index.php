<html>

<head>
    <title>Búsqueda por continentes</title>
    <style>
        body {}

        table,
        td {
            border: 1px solid black;
            border-spacing: 0px;
        }
    </style>
</head>

<body>
    <h1>Búsqueda por continentes</h1>

    <?php
        $conn = mysqli_connect('localhost', 'root', 'root');

        mysqli_select_db($conn, 'world');

        $consultaContinentes = "SELECT DISTINCT continent FROM country;";

        $continentes = mysqli_query($conn, $consultaContinentes);

        if (!$continentes) {
            $message = 'Consulta invàlida: ' . mysqli_error() . "\n";
            $message .= 'Consulta realitzada: ' . $consultaContinentes;
            die($message);
        }
    ?>

    <form action="index.php" method="POST">
        <select name="continente">
            <?php
                while ($registre = mysqli_fetch_assoc($continentes)) {
                    echo "\t<option value=" . $registre["continent"] . ">\n";
                    echo "\t\t" . $registre["continent"] . "</td>\n";
                    echo "\t</optiontr>\n";
                }
            ?>
        </select>
        <input type="submit" value="Busca">
    </form>


        <table>
            <thead>
                <td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td>
            </thead>
            <?php
                if (isset($_POST['continente'])) {
                    $consultaPaises = "SELECT name FROM country WHERE continent LIKE '".$_POST['continente']."%';";
                    $paises = mysqli_query($conn, $consultaPaises);
                    if (!$paises) {
                        $message = 'Consulta invàlida: ' . mysqli_error() . "\n";
                        $message .= 'Consulta realitzada: ' . $consultaPaises;
                        die($message);
                    }
                    while ($registre = mysqli_fetch_assoc($paises)) {
                        echo "\t<tr>\n";
                        echo "\t\t<td>" . $registre["name"] . "</td>\n";
                        echo "\t</tr>\n";
                    }
                }
            ?>
        </table>
</body>

</html>