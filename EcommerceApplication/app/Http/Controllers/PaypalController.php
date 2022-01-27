<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/** Paypal Details classes **/

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use PayPal\Exception\PayPalConnectionException;
use Exception;

class PaypalController extends Controller
{
    private $api_context;

    public function __construct()
    {
        $this->api_context = new ApiContext(
            new
                OAuthTokenCredential(
                    config('paypal.client_id'),
                    config('paypal.secret')
                )
        );
        $this->api_context->setConfig(config('paypal.settings'));
    }

    /** This method sets up the paypal payment.
     **/
    public function createPayment(Request $request)
    {
        //Setup Payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        //Setup Amount
        $amount = new Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($request->amount);
        //Setup Transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Your awesome 
      Product!');
        //List redirect URLS
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($request->return_url);
        $redirectUrls->setCancelUrl($request->return_url);
        //And finally set all the prerequisites and create the payment
        $payment = new Payment();

        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->api_context);
        //Return our payment info to the user
        return $response;
    }
    /**
     ** This method confirms if payment with paypal was 
        processed successful and then execute the payment, string.
     ** we have 'paymentId, PayerID and token' in query   
     **/

    public function executePaypal(Request $request)
    {
        /** Get the payment ID before session clear **/
        $paymentId = $request->get('payment_id');
        $payerId = $request->get('payer_id');


        $payment = Payment::get($paymentId, $this->api_context);
        $paymentExecution = new PaymentExecution();
        $paymentExecution->setPayerId($payerId);

        $executePayment = $payment->execute($paymentExecution, $this->api_context);
        if ($executePayment->getState() == 'approved') {
            if ($executePayment->transactions[0]->related_resources[0]->sale->state == 'completed') {

                /*
      * Here is where you would do your own stuff like add 
      a record for the payment, trigger a hasPayed event, 
      etc.
      */

                // Do something to signify we succeeded

                return response()->json(
                    [
                        'status' => "success",

                    ],
                    200
                );
            }
        }
        return response()->json('failed', 400);
    }
}
