<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsApiController extends Controller
{
    public function index(Request $request)
    {
        // check jwt token

        // check jwt token
        // $checkuser = auth()->guard('api')->user();
        // if (!$checkuser) {
        //     return response()->json(['error' => 'Unauthenticated.'], 401);
        // }

        // check if email and password are authenticated
        // dd($request->requestoremail);
        // return response()->json([
        //     'status' => false,
        //     'message' => 'Unauthorizedzz',
        //     'data' => $request->all(),
        // ], 400);
        $user = User::where('email', $request->requestoremail)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => $request->requestoremail,
                'data' => null,
            ], 400);
        }

        // get all order by name
        $accounts = Account::orderBy('name', 'asc')->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $accounts,
        ], 200);
    }

    public function store(Request $request)
    {
        //

        // check if email and password are authenticated

        $user = User::where('email', $request->requestoremail)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        // validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'data' => $validator->errors(),
            ], 400);
        }

        // create user
        $account = Account::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'user_id' => $request->requestoremail,
        ]);

        if ($account) {
            return response()->json([
                'success' => true,
                'message' => 'Account created successfully',
                'data' => $account,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Account creation failed',
                'data' => $account,
            ], 500);
        };

    }

    public function update(Request $request, $id)
    {
        //

        // check if email and password are authenticated
        $user = User::where('email', $request->requestoremail)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        // validate request

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'data' => $validator->errors(),
            ], 400);
        }

        // update user
        $account = Account::find($id);
        $account->name = $request->name;
        $account->desc = $request->desc;
        $account->user_id = $request->requestoremail;
        $account->save();

        // return response
        return response()->json([
            'status' => true,
            'message' => 'Account updated',
            'data' => $account,
        ], 200);

    }

    public function destroy(Request $request, $id)
    {
        //

        // check if email and password are authenticated
        $user = User::where('email', $request->requestoremail)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        // soft delete user
        $account = Account::find($id);
        $account->delete();

        // return response
        return response()->json([
            'status' => true,
            'message' => 'Account deleted',
            'data' => $account,
        ], 200);

    }

    public function getAccountBalances(Request $request)
    {
        $user = User::where('email', $request->requestoremail)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        // get account balaces in paymenthistory group by account_id
        $paymentBalance = PaymentHistory::selectRaw('account, sum(ammount) as balance')
            ->groupBy('account')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $paymentBalance,
        ], 200);

    }
}
