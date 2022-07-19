<?php
namespace Hasinur\Xspeed\Controllers;

use Hasinur\Xspeed\Models\Product;

/**
 * Class Home
 */
class Home extends Controller {
    /**
     * Show the item create form
     *
     * @return void
     */
    public function index() {
        view( 'home.php' );
    }

    /**
     * Reports
     *
     * @return void
     */
    public function show() {

        $form = isset( $_GET['from-date'] ) ? date( 'Y-m-d', strtotime( $_GET['from-date'] ) ) : '';
        $to   = isset( $_GET['to-date'] ) ? date( 'Y-m-d', strtotime( $_GET['to-date'] ) ) : '';

        $product = new Product();
        view( 'reports.php', ['products' => $product->getProductWithDate($form, $to)] );
    }

    /**
     * Save items on database
     *
     * @return void
     */
    public function store() {

        $amount      = isset( $_POST['amount'] ) ? $_POST['amount'] : '';
        $buyer       = isset( $_POST['buyer'] ) ? $_POST['buyer'] : '';
        $receipt_id  = isset( $_POST['receipt_id'] ) ? $_POST['receipt_id'] : '';
        $items       = isset( $_POST['items'] ) ? $_POST['items'] : '';
        $buyer_email = isset( $_POST['buyer_email'] ) ? $_POST['buyer_email'] : '';
        $note        = isset( $_POST['note'] ) ? $_POST['note'] : '';
        $city        = isset( $_POST['city'] ) ? $_POST['city'] : '';
        $phone       = isset( $_POST['phone'] ) ? $_POST['phone'] : '';
        $entry_at    = isset( $_POST['entry_at'] ) ? $_POST['entry_at'] : '';
        $entry_by    = isset( $_POST['entry_by'] ) ? $_POST['entry_by'] : '';

        $validation = $this->check( $_POST, [
            'amount'      => [
                'required' => true,
                'number'   => true,
            ],
            'buyer'       => [
                'alnum'     => true,
                'maxlength' => 20,
            ],
            'receipt_id'  => [
                'alpha' => true,
            ],

            'items'       => [
                'alpha' => true,
            ],
            'buyer_email' => [
                'email' => true,
            ],

            'note'        => [
                'maxword' => 30,
            ],

            'city'        => [
                'alpha' => true,
            ],

            'phone'       => [
                'number' => true,
            ],

            'entry_by'    => [
                'number' => true,
            ],
        ] );

        $res = false;
        if ( !$validation->fails() ) {
            $product = new Product();

            $res = $product->create( [
                'amount'      => $amount,
                'buyer'       => $buyer,
                'receipt_id'  => $receipt_id,
                'items'       => $items,
                'buyer_email' => $buyer_email,
                'buyer_ip'    => get_client_ip(),
                'note'        => $note,
                'city'        => $city,
                'phone'       => $phone,
                'hash_key'    => hash( 'sha512', $receipt_id ),
                'entry_at'    => $entry_at,
                'entry_by'    => $entry_by,

            ] );
        }
        echo json_encode( $res );
    }
}