<?php


namespace Ajde\Shop\Transaction\Provider\Paypal;

use Ajde\Shop\Transaction\Provider\Paypal;



class Creditcard extends Paypal
{
    public function getName() {
		return 'Creditcard';
	}
	
	public function getLogo() {
		return MEDIA_DIR . '_core/shop/creditcard.png';
	}

    protected function getMethod()
    {
        return '_creditcard';
    }
}