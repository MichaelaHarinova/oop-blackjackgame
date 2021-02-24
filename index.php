<?php
declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Dealer.php';
require 'Blackjack.php';

session_start();

if (!isset($_SESSION['blackjack'])) {
    $_SESSION['blackjack'] = new Blackjack();
}
$disabled = "";

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "hit":
            $_SESSION['blackjack']->getPlayer()->hit($_SESSION['blackjack']->getDeck());
            if ($_SESSION['blackjack']->getPlayer()->hasLost()) {
                echo "You lost!";
                $disabled = "disabled";
            }
            break;
        case "stand":
            $_SESSION['blackjack']->getDealer()->hit($_SESSION['blackjack']->getDeck());
            if (!$_SESSION['blackjack']->getDealer()->hasLost() && $_SESSION['blackjack']->getPlayer()->getScore() > $_SESSION['blackjack']->getDealer()->getScore()) {
                echo "You win!";
                $disabled = "disabled";
            } else if($_SESSION['blackjack']->getDealer()->hasLost()) {
                echo "You win!";
            }else{
                echo "You lost!";
                $disabled = "disabled";
            }
            break;
        case "surrender":
            $_SESSION['blackjack']->getPlayer()->surrender();
            echo "You lost!";
            $disabled = "disabled";
            break;
        case "restart":
            unset($_SESSION['blackjack']);
            $_SESSION['blackjack'] = new Blackjack();
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Black Jack</title>
</head>
<!--displays cards and score of player-->
<body style="background-image: linear-gradient(#e2ece5,#385f26,#111511); background-repeat: no-repeat; background-attachment: fixed ">
<div style="float:left; margin: 20px 0 0 420px; font-size: 30px; text-align: center; display: inline-block">
    <?php
    foreach ($_SESSION['blackjack']->getPlayer()->getCards() as $card) {
        echo $card->getUnicodeCharacter(true) . PHP_EOL;
    }
    echo '<br>';
    echo "Your score is:  " . $_SESSION['blackjack']->getPlayer()->getScore();
    ?>
</div>
<!--displays dealers cards and score-->
<div style="float:right; margin: 20px 0 0 20px; font-size: 30px; text-align: center">
    <?php
  /*    foreach ($_SESSION['blackjack']->getDealer()->getCards() as $card) {
          echo $card->getUnicodeCharacter(true);
      }
      echo '<br>';
      echo "Dealer " . $_SESSION['blackjack']->getDealer()->getScore();

*/
    ?>

</div>
<br>
<div style="margin-top: 170px; margin-left: 420px ;display:block; position: fixed">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <br>
        <button type="submit" <?php echo $disabled ?> value="hit" name="action"
                style="width:100px;height:30px; text-align: center; border-radius: 10px;background-color:red;color:white">
            Hit
        </button>
        <button type="submit" <?php echo $disabled ?> value="stand" name="action"
                style="width:100px;height:30px; text-align: center; border-radius: 10px;10px;background-color:black;color:white">
            Stand
        </button>
        <button type="submit" <?php echo $disabled ?> value="surrender" name="action"
                style="width:100px;height:30px; text-align: center; border-radius: 10px;10px;background-color:black;color:white">
            Surrender
        </button>
        <button type="submit" value="restart" name="action"
                style="width:130px;height:30px; text-align: center; border-radius: 10px">Restart
        </button>
    </form>

</div>

</body>
</html>