<?php
declare(strict_types=1);

class Dealer extends Player
{
    public const MIN_DEALER_DRAW = 15;
    public function __construct(Deck $deck)
    {
        parent::__construct($deck);
    }

    public function hit(Deck $deck)
    {
        while ($this->getScore()<self::MIN_DEALER_DRAW){
            parent::hit($deck);
        }

        }



}