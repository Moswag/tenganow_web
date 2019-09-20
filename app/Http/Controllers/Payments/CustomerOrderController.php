<?php

namespace App\Http\Controllers\Payments;

use App\Order;
use Exception;
use App\Outlet;
use App\Customer;
use App\Transaction;
use App\OutletPaynow;
use Paynow\Payments\Paynow;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Paynow\Http\ConnectionException;
use Paynow\Payments\HashMismatchException;
use Paynow\Payments\NotImplementedException;
use Paynow\Payments\InvalidIntegrationException;


class CustomerOrderController extends Controller
{
    /**
     * @var Paynow|null
     */
    protected $paynow = null;



    public function getMyOders(Request $request)
    {
        $orders = Order::where('phonenumber', $request->phonenumber)->get();
        foreach ($orders as $order) {
            $ouletPaynow=OutletPaynow::find($order->outlet_id);


            $this->paynow = new Paynow(
                $ouletPaynow->integrationId,
                $ouletPaynow->integrationKey,
                url('/'),
                url('/')
            );
            // Find a transaction matching the given transaction id
            $transaction = Transaction::findOrFail($order->transaction_id);
            try {
                // Try to poll the transaction
                $status = $this->paynow->pollTransaction($transaction->poll_url);

                Order::where('transaction_id', $request->transaction)->update([
                    'paid' => $status->paid(),
                    'status' => 'nn'
                ]);
                $myorders = Order::where('phonenumber', $request->phonenumber)->get();
                return response()->json($myorders);

            } catch (Exception $e) {
                // Log out the error
                logger()->error($e->getMessage() . "\t\t" . $e->getTraceAsString());


            }
        }


    }




    public function checkPayment($id){
        if(Transaction::where('id',$id)->exists()){
            $orderStatus=$this->pollTransactionForOrder($id);
            return view('server.outlet.admin.order.check_order_status',compact('orderStatus'));
        }
    }


    public function pollTransactionForOrder($id)
    {
        $ouletPaynow=OutletPaynow::find(auth()->user()->company_or_outlet_id);


            $this->paynow = new Paynow(
                $ouletPaynow->integrationId,
                $ouletPaynow->integrationKey,
                url('/'),
                url('/')
            );


        // Find a transaction matching the given transaction id
        $transaction = Transaction::findOrFail($id);

        try {
            // Try to poll the transaction
            $status = $this->paynow->pollTransaction($transaction->poll_url);

                Order::where('transaction_id',$id)->update([
                    'paid'=>$status->paid(),
                    'status' => $status->paid() ? 'Paid' : 'Awaiting payment'
                ]);


            // Return transaction status
            return response()->json([
                'status' => $status->paid() ? 'Paid' : 'Awaiting payment'
            ]);
        } catch (Exception $e) {
            // Log out the error
            logger()->error($e->getMessage() . "\t\t" . $e->getTraceAsString());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while polling transaction'
            ]);
        }
    }
}
