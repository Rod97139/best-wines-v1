<?php

namespace App\Controllers;

use App\Models\StripePayment;
use Core\Controller;
use Core\Partials\CheckLog;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;


class PayController extends Controller
{



    public function index()
    {


        CheckLog::checkClientIsLogged();
        $total = $_SESSION['total_price'];
        $paypal_items_array = [];

        foreach ($_SESSION["cart_item"] as $k => $v) {

            $paypal_items_array[] = [

                'name' => $v['name'],
                'unit_amount' => [
                    'value' => $v['price'],
                    'currency_code' => 'EUR'
                ],
                'quantity' => $v['quantity']
            ];
        }

        $order = json_encode([
            'purchase_units' => [[
                'description' => "Panier de l'utilisateur n°" . $_SESSION['user']['id'],
                'items' => $paypal_items_array,
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => $total,
                    'breakdown' => [
                        'item_total' => [
                            'currency_code' => 'EUR',
                            'value' => $total
                        ]
                    ]
                ]

            ]]
        ]);

        $this->renderView('pay/index', compact('order'));
    }


    public function paypal()
    {

        $environment = new SandboxEnvironment("Ad3W5NwEIU0dsnq-0ceovxjEu4rMfLjiXByoqs08JqjYGS1rUy7oqwVprP4jWDr91NIe1fC9_kk2Ypbq", "EEE0U9BvSZfHmhV2jfZvElGXs8qvG1jtcGwPTbeDEhchYwA9vBmdSweerQTpySRSUQO6txEov_3guUAl");
        $client = new PayPalHttpClient($environment);

        $request = new OrdersGetRequest($_GET['orderId']);

        $response = $client->execute($request);

        // dump($response->result->status);
        // dump($response->result->payment_source);
        // dump($response->result->purchase_units[0]->shipping);
        // dump($response);

        if ($response->result->status == 'COMPLETED') {

            unset($_SESSION['cart_item']);
            //phpmailer 

            $this->renderView('pay/success');
        } else {
            echo 'echec du paiement';
        }
    }

    public function stripePayment()

    {
        $payment = new StripePayment('sk_test_51MFSr6DqvB6uQCmLYh57hTz529jASvKBjeORVylUg6190E6aIXaknfUa6ymuIaa24UA2LUUVZNvwuSsWhyrlHwUG002d6u3Qq0', 'whsec_01c59bc18dc792fcd543427e5eaa98e55dd08975e5d7b3205a242bf83d78a4ff');
        $payment->startPayment();
    }

    public function success()
    {

        unset($_SESSION['cart_item']);

        $this->renderView('pay/success');
    }

    public function webhook()
    {
        $psr17Factory = new Psr17Factory();

        $creator = new ServerRequestCreator(
            $psr17Factory, // ServerRequestFactory
            $psr17Factory, // UriFactory
            $psr17Factory, // UploadedFileFactory
            $psr17Factory  // StreamFactory
        );

        $request = $creator->fromGlobals();
        
        $payment = new StripePayment('sk_test_51MFSr6DqvB6uQCmLYh57hTz529jASvKBjeORVylUg6190E6aIXaknfUa6ymuIaa24UA2LUUVZNvwuSsWhyrlHwUG002d6u3Qq0', 'whsec_01c59bc18dc792fcd543427e5eaa98e55dd08975e5d7b3205a242bf83d78a4ff');
        $payment->handle($request);
    }
}
