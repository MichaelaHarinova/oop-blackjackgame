<?php
declare(strict_types=1);

class Player
{
    protected array $cards = [];
    protected bool $lost = false;
    public const  LIMIT_VALUE = 21;

    public function __construct(Deck $deck)
    {
        array_push($this->cards, $deck->drawCard());
        array_push($this->cards, $deck->drawCard());

    }


    public function hit(Deck $deck)
    {   //gives another card
        array_push($this->cards, $deck->drawCard());
        if ($this->getScore() > self::LIMIT_VALUE) {
            $this->lost = true;
        }
     /*    if ($this->getScore() === self::LIMIT_VALUE){
             $this->lost=false;
}*/
    }

    public function surrender() :void
    {
        $this->lost = true;
    }

    public function getScore(): int
    {
        $totalScore = 0;

        foreach ($this->cards as $card) {
            $totalScore += $card->getValue();
        }
        return $totalScore;
    }

    public function hasLost(): bool
    {
        return $this->lost;
    }

/*public function setLost(bool $lost) :void{
        $this->lost=$lost;
}*/

    public function getCards() :array
    {
        return $this->cards;
    }

  /*  public function winOrLost(Dealer $dealer) :bool {
        if(!$dealer->hasLost() && $this->getScore() > $dealer->getScore()){
            $this->lost = false;
        }else if ($dealer->hasLost()){
            $this->lost =false;
            $dealer->setLost(true);
        }else{
            $this->lost = true;
            $dealer->setLost(false);
        }
        return !$this->lost;
    }*/
}

