<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Payment;
use App\Models\Subcription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class PaymentController extends Controller
{


    // https://stackoverflow.com/questions/34264121/why-i-am-getting-fatal-error-uncaught-exception-guzzlehttp-exception-requestex
    //  Http error 60 curl -> issue in ssl cert

    public function setSubcription($user, $company, $payment_id, $status, $subcription_type)
    {
        try {
            $subcription = Subcription::where('user_id', $user->id)->first();
            $res = null;
            $month = null;
            if(strtolower($subcription_type) == "1 year") {
                $month = 12;
            }
            if(strtolower($subcription_type) == "1 month") {
                $month = 1;
            }
            if(strtolower($subcription_type) == "6 months") {
                $month = 6;
            }
            if($status) {
                if($subcription) {
                    $res = $subcription->update([
                        'status' => 'subcribed',
                        'payment_id' => $payment_id,
                        'start' => Carbon::now('Asia/Manila'),
                        'end' => $subcription_type ? Carbon::now('Asia/Manila')->addMonth($month) : null
                    ]);
                } else {
                    $res = Subcription::create([
                        'payment_id' => $payment_id,
                        'user_id' => $user->id,
                        'company_id' => $company->id,
                        'status' => 'subcribed',
                        'start' => Carbon::now('Asia/Manila'),
                        'end' =>  $subcription_type ? Carbon::now('Asia/Manila')->addMonth($month) : null
                    ]);
                }
                if($res != null && $res) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;

        } catch (\Exception $e) {
            return false;
        }
        
    }

    public function endSubcription($company)
    {
        try {
            $subcription = Subcription::where('company_id', $company->id)->first();

            $res = $subcription->update(['status' => 'not-subcribed']);

            return $res;
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
        
    }

    public function insertPayment($user, $company, $payment_type)
    {
        $uuid = Uuid::uuid4();
        try {
            $payment = Payment::create([
                'reference_id' => $uuid->toString(),
                'user_id' => $user->id,
                'company_id' => $company->id,
                'payment_type' => $payment_type,
                'transaction_date' => Carbon::now('Asia/Manila'),
                'status' => 'new'
            ]);

            // $payment->paymentdetail()->create([
            //     $payment_type."_ids" => $ids,
            //     $payment_type."_data" => $datas,
            // ]);

            return $payment;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function cancelPayment(Request $request)
    {
        try {
            $payment = Payment::find($request->payment_id);
            $response = $this->updatePayment($payment, $request->status);
            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePayment($payment, $status)
    {
        try {
            $updating_payment = Payment::find($payment->id);
            $array = $status == "success" ? ['status' => $status, 'payment_date' => Carbon::now('Asia/Manila')] : ['status' => $status] ;
            $res = $updating_payment->update($array);
            return $res;
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateSubcription($subcription_type, $user)
    {
        try {
            $subcription = Subcription::where('user_id', $user->id)->first();

            if(strtolower($subcription_type) == "1 Year") {
                $subcription_type = 12;
            }
            if(strtolower($subcription_type) == "1 month") {
                $subcription_type = 1;
            }
            if(strtolower($subcription_type) == "6 months") {
                $subcription_type = 6;
            }

            $res = $subcription->update([
                'start' => Carbon::now('Asia/Manila'),
                'end' => Carbon::now('Asia/Manila')->addMonth($subcription_type)
            ]);

            return $res;
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function insertPaymentDetail($payment, $payment_type, $ids, $datas)
    {
        try {
            $creating_payment = Payment::find($payment->id);
            $response = $creating_payment->paymentdetail()->create([
                $payment_type."_ids" => json_encode($ids),
                $payment_type."_data" => json_encode($datas),
            ]);

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function stripePayment(Request $request) {

        try {
            $user = $request->user();
            $company = Company::where('user_id', $user->id)->first();
            $payment = $this->insertPayment($user, $company, $request->payment_type);
            sleep(5);

            $query = http_build_query([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "payment_method" => $request->paymentMethod,
                "confirmation_method" => "manual"
            ]);

            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer sk_test_51H0dohKWzaP0y47nwJHdOzaVFfh0vQXjuKTT8izINS5GvuoUT1jNcM0WD5fvLn1bNOEhurk39Wfyq6rkmkXpWiuO00sWCHCqkB'
                ])
                ->accept('application/json')
                ->post('https://api.stripe.com/v1/payment_intents?'.$query);
    
            $res = $response->object();

            if($response->serverError()) {
                return response()->json([ 
                    'error' => $res->error
                ], 400);
            }

            $this->updatePayment($payment, 'in-process');
            $payment_response = $this->stripePaymentConfirm($res->id);
    
            if($payment_response->status == "succeeded") {
                // payment details use in paymentdetail;s
                $this->updatePayment($payment, 'success');
                // update details;
                $this->insertPaymentDetail($payment, $request->payment_type, ['id' => $payment_response->id], $payment_response->charges->data);
                // $this->updateSubcription($request->subcription_type, $user);
                $this->setSubcription($user, $company, $payment->id, 'subcribed', $request->subcription_type);

                return response()->json([
                    'action' => false,
                    'message' => 'payment success'
                ], 200);

            }
            if($payment_response->status == "requires_action") {

                return response()->json([
                    'payment_id' => $payment->id,
                    'payment_type' => $request->payment_type,
                    'action' => true,
                    'clientSecret' => $payment_response->client_secret,
                    'payment_intents_id' => $res->id,
                    'company_id' => $company->id,
                    'subcription_type' => $request->subcription_type
                ], 200);
            }

            $this->updatePayment($payment, 'reject');

            return response()->json([
                'error' => 'payment rejected'
            ], 400);

        }catch(\Exception $e) {
            $this->updatePayment($payment, 'reject');
            return response()->json([
                'error' => $e->getMessage(),
                'payment side'
            ], 500);
        }
        
    }

    public function stripePaymentConfirm($payment_intents_id) {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer sk_test_51H0dohKWzaP0y47nwJHdOzaVFfh0vQXjuKTT8izINS5GvuoUT1jNcM0WD5fvLn1bNOEhurk39Wfyq6rkmkXpWiuO00sWCHCqkB'
                ])
                ->accept('application/json')
                ->post("https://api.stripe.com/v1/payment_intents/{$payment_intents_id}/confirm");
    
            return $response->object();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'confirm side'
            ], 500);
        }
    }

    public function stripePaymentAuth(Request $request)
    {
        try {
            $payment = Payment::find($request->payment_id);
            $user = $request->user();
            $payment_intents_id = $request->payment_intents_id;
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer sk_test_51H0dohKWzaP0y47nwJHdOzaVFfh0vQXjuKTT8izINS5GvuoUT1jNcM0WD5fvLn1bNOEhurk39Wfyq6rkmkXpWiuO00sWCHCqkB'
                ])
                ->accept('application/json')
                ->post("https://api.stripe.com/v1/payment_intents/{$payment_intents_id}/confirm");
    
            $response = $response->object();
            if($response->status == "succeeded") {
                // payment details use in paymentdetail;s
                $this->updatePayment($payment, 'success');
                // update details;
                // $this->insertPaymentDetail($payment, $request->payment_type, [$response->id], $response->data);
                $this->insertPaymentDetail($payment, $request->payment_type, ['id' => $response->id], $response->charges->data);

                $this->setSubcription($user, $request->company_id, $payment->id, 'subcribed', $request->subcription_type);

                return response()->json([
                    'message' => 'success payment'
                ], 200);
            } else {
                // payment details use in paymentdetail;s
                $this->updatePayment($payment, 'reject');
                return response()->json([
                    'error' => 'Canceling Payment'
                ], 400);
            }
        } catch (\Exception $e) {
            $this->updatePayment($payment, 'reject');
            return response()->json([
                'error' => $e->getMessage(),
                'auth side'
            ], 500);
        }
    }

    public function paypalPayment(Request $request)
    {
        try {
            $user = $request->user();
            $company = Company::where('user_id', $user->id)->first();
            $payment = $this->insertPayment($user, $company, $request->payment_type);

            sleep(5);
            $array = [
                "intent" => "CAPTURE",
                "purchase_units" => [
                    0 => [
                        "amount" => [
                        "currency_code" => "usd",
                        "value" => $request->amount
                            ]
                        ]
                ],
                "application_context" => [
                    "brand_name" => "Laravel Job FInder",
                    "shipping_preference" => "NO_SHIPPING",
                    "user_action" => "PAY_NOW",
                    "return_url" => "http://localhost:3000/employeer-user/payment-paypal/success",
                    "cancel_url" => "http://localhost:3000/employeer-user/payment-paypal/cancelorfailed"
                ]
            ];

            $credentials = base64_encode("AYmeSXIfoqQtcI5BcS_onBV19S3SXajWVlGRV32fe-r6adQlRse_MN_f2oWiFwxHmj29H5iQtB50L6IN:EHEnePOMSTBYo3iYcd1fOTxXcE_LrkxQRMWL9AttKgOdrsUAWpSTRvUMtHsrFbhDqa6TFHr8WTqWyXEh");
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$credentials
                ])
                ->accept('application/json')
                ->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', $array);

            $responsedata = $response->object();

            if($response->serverError()) {
                return response()->json([ 
                    'error' => $responsedata->error
                ], 400);
            }

            $this->updatePayment($payment, 'in-process');

            $orderLinks = '';

            // return response()->json([$responsedata], 500);

            if(property_exists($responsedata, 'status') && $responsedata->status == "CREATED") {
                foreach($responsedata->links as $link) {
                    if($link->rel == "approve") {
                        $orderLinks = $link->href;
                    }
                }

                if($orderLinks) {
                return response()->json([
                        'approvalId' => $responsedata->id,
                        'paymenturl' => $orderLinks,

                        'payment_id' => $payment->id,
                        'payment_type' => $request->payment_type,
                        'action' => false,
                        'company_id' => $company->id,
                        'subcription_type' => $request->subcription_type,
                        'reference_id' => $payment->reference_id
                    ], 200); 
                }
            } else {
               $this->updatePayment($payment, 'reject');

                return response()->json([
                    'error' => 'payment rejected'
                ], 400); 
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function confirmData(Request $request)
    {
        try {
            // add
            $response = Payment::where('reference_id', $request->reference_id)
            ->where('payment_date', null)
            ->where('status', '!=', 'success')->first();
            $res = $response ? true : false;
            return response()->json([$res], 200);
        } catch (\Exception $e) {
            return response()->json([ 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function paypalPaymentConfirm(Request $request)
    {
        try {
            $token = $request->token;
            $PayerID = $request->PayerID;
            $approvalId = $request->approvalId;

            $payment = Payment::find($request->payment_id);
            $user = $request->user();
            $company = Company::find($request->company_id);

            $credentials = base64_encode("AYmeSXIfoqQtcI5BcS_onBV19S3SXajWVlGRV32fe-r6adQlRse_MN_f2oWiFwxHmj29H5iQtB50L6IN:EHEnePOMSTBYo3iYcd1fOTxXcE_LrkxQRMWL9AttKgOdrsUAWpSTRvUMtHsrFbhDqa6TFHr8WTqWyXEh");
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$credentials,
                'Paypal-Request-Id' => $PayerID
            ])
            ->accept('application/json')
            ->post("https://api-m.sandbox.paypal.com/v2/checkout/orders/{$approvalId}/capture",
            ['name' => '']);

            $responsedata = $response->object();

            if($response->serverError()) {
                $this->updatePayment($payment, 'reject');
                return response()->json([ 
                    'error' => $responsedata->error,
                ], 400);
            }

            if(property_exists($responsedata, 'name') && $responsedata->name == "INVALID_REQUEST") {
                return response()->json([ 
                    'error' => $responsedata,
                    'invalid data params'
                ], 400);
            }
            
            if(property_exists($responsedata, 'status') && $responsedata->status == "COMPLETED") {
                $this->updatePayment($payment, 'success');
                // update details;
                $this->insertPaymentDetail($payment, $request->payment_type, ['approvalId' => $approvalId, 
                'token' => $token, 'PayerID' => $PayerID, 'payer' => $responsedata->payer], $responsedata->purchase_units);
                // $this->updateSubcription($request->subcription_type, $user);
                $this->setSubcription($user, $company, $payment->id, 'subcribed', $request->subcription_type);
                return response()->json(['success' => 'Payment Success. you are subcriber now.'], 200);
            } else {
                $this->updatePayment($payment, 'reject');
                return response()->json([ 
                    'error' => 'Payment Cancel or Failed',
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                
            ], 500);
        }
    }
}
