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

    }

    public function surrender()
    {
        $this->lost = true;
    }

    public function getScore()
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

    public function setLost($lost): bool
    {
            $this->lost=$lost;
    }


    public function getCards()
    {
        return $this->cards;
    }
}

