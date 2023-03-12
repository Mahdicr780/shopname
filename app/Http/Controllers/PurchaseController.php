<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Exceptions\PurchaseFailedException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use SoapFault;

class PurchaseController extends Controller
{
    public function purchase($id)
    {
        $user = Auth::user();
        $basket = Basket::findOrfail($id);
        $basketExist = Order::where('user_id',Auth::id())->where('basket_id',$basket->id)->first();
        if ($basketExist){
            return "این سبد از قبل پرداخت شده است";
        }
        try {
            $invoice = new Invoice();
            $invoice->amount($basket->price);
            $invoice->detail('موبایل کاربر',$user->phone_number);
            $paymentId = md5(uniqid());
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'basket_id' => $basket->id,
                'paid' => $invoice->getAmount(),
                'invoice_details' => $invoice,
                'payment_id' => $paymentId

            ]);

            $callbackUrl = route('payment.product.result',[$basket->id , 'payment_id' => $paymentId]);
            $payment = Payment::callbackUrl($callbackUrl);

            $payment->config('description',$user->name);

            $payment->purchase($invoice , function ($driver , $transactionId) use ($transaction) {
                $transaction->transaction_id = $transactionId;
                $transaction->save();
            });
            return $payment->pay()->render();
        }catch (Exception|PurchaseFailedException|SoapFault $e) {
            $transaction->transaction_result = [
                $e->getMessage(),
                $e->getCode()
            ];
            $transaction->status = Transaction::STATUS_FAILED;
            $transaction->save();
            return "خطایی در پرداخت به وجود آمد";
        }
    }
    public function result(Request $request , $id)
    {
        $basket = Basket::findOrfail($id);

        if ($request->missing('payment_id')){
            return  "خطایی در پرداخت به وجود آمد";
        }

        $transaction = Transaction::where('payment_id',$request->payment_id)->first();
        if (empty($transaction)){
            return  "خطایی در پرداخت به وجود آمد";
        }

        if ($transaction->user_id !== Auth::id()){
            return  "خطایی در پرداخت به وجود آمد";
        }

        if ($basket->id !== $transaction->basket_id){
            return  "خطایی در پرداخت به وجود آمد";
        }

        if ($transaction->status !== Transaction::STATUS_PENDING){
            return  "خطایی در پرداخت به وجود آمد";
        }

        try {
            $receipt = Payment::amount($transaction->paid)
            ->transactionId($transaction->transaction_id)
            ->verify();
            $transaction->transaction_result = $receipt;
            $transaction->status = Transaction::STATUS_SUCCESS;
            $transaction->save();
            $user = Auth::user();
            order::create([
                'user_id' => $user->id,
                'basket_id' => $basket->id,
                'price' => $basket->price,
                'status' => 'paid'
            ]);
            $basket->update([
                'isActive' => 0
            ]);
            return "پرداخت با موفقیت انجام شد";
        }catch (Exception|InvalidPaymentException $e){
            if ($e->getCode() < 0){
                $transaction->status = Transaction::STATUS_FAILED;
                $transaction->transaction_result = [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                ];
                $transaction->save();
            }
            return  "خطایی در پرداخت به وجود آمد";
        }
    }
}
