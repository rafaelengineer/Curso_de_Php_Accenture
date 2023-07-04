<?php
require_once "templates/header.php";

if (!playersRegistered()) {
    header("location: index.php");
}
printf("inicio");
$teste = true;

if ($_POST['cell']) {
    $win = play($_POST['cell']);

    if ($win) {
        $lastGame = getBoard();
         echo $lastGame;
         header("location: result.php?player=" . getTurn());
         exit; // Exit to prevent further execution of the code
        }
    }
    
    if (playsCount() >= 9) {
        header("location: result.php");
        exit; // Exit to prevent further execution of the code
    }
    
    if (isset($_POST['reset'])) {
        $lastGame = getBoard();
        echo $lastGame;
        resetBoard();
    header("location: play.php");
    exit; // Exit to prevent further execution of the code
}
?>

<h2><?php echo currentPlayer() ?>'s turn</h2>

<!-- Display the last play at the top left corner -->
<div class="last-play">
    Last Game: <?php echo $lastGame; ?>
</div>

<form method="post" action="play.php">
    <table class="tic-tac-toe" cellpadding="0" cellspacing="0">
        <tbody>
        <?php
        $lastRow = 0;
        for ($i = 1; $i <= 9; $i++) {
            $row = ceil($i / 3);

            if ($row !== $lastRow) {
                $lastRow = $row;

                if ($i > 1) {
                    echo "</tr>";
                }

                echo "<tr class='row-{$row}'>";
            }

            $additionalClass = '';

            if ($i == 2 || $i == 8) {
                $additionalClass = 'vertical-border';
            } elseif ($i == 4 || $i == 6) {
                $additionalClass = 'horizontal-border';
            } elseif ($i == 5) {
                $additionalClass = 'center-border';
            }
            ?>
            <td class="cell-<?= $i ?> <?= $additionalClass ?>">
                <?php if (getCell($i) === 'x'): ?>
                    X
                <?php elseif (getCell($i) === 'o'): ?>
                    O
                <?php else: ?>
                    <input type="radio" name="cell" value="<?= $i ?>" onclick="enableButton()" />
                <?php endif; ?>
            </td>
        <?php } ?>
        </tr>
        </tbody>
    </table>

    <button type="submit" disabled id="play-btn">Play</button>
    <button type="submit" name="reset">Reset</button>
</form>

<script type="text/javascript">
    function enableButton() {
        document.getElementById('play-btn').disabled = false;
    }
</script>

<?php
require_once "templates/footer.php";
