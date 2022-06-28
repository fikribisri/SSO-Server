<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lcobucci\JWT\Parser;
use App\User;
use App\Passport\OAuthClient as OA;

class AuthenticationController extends Controller
{
    public function login(Request $request) {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($request->password == $user->password) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = 'Password mismatch';
                return response($response, 422);
            }
        } else {
            $response = 'User doesn\'t exist';
            return response($response, 422);
        }

    }

    public function logout(Request $request) {

        $bearerToken = $request !== null ? $request->bearerToken() : RequestFacade::bearerToken();

        $parsedJwt = (new Parser())->parse($bearerToken);

        // $tokenId = OA::findByRequest($request);
        if ($parsedJwt->hasHeader('jti')) {
            $tokenId = $parsedJwt->getHeader('jti');
        } elseif ($parsedJwt->hasClaim('jti')) {
            $tokenId = $parsedJwt->getClaim('jti');
        }

        //id user
        $user_id = \Auth()->user()->id;
        // dd($user_id);
        // revoke by token
        // $token= $request->user()->tokens->find($id);
        // $token->revoke();

        // all revoke by user
        // $token=  \DB::table('oauth_access_tokens')
        //     ->where('user_id', '=', $user_id)
        //     ->update(['revoked' => true]);

        // remove all the sessionIds related to the current user
        \DB::table('sessions')
            ->where('user_id', $user_id)
            ->delete();

        \DB::table('oauth_access_tokens')
            ->where('user_id', $user_id)
            ->delete();

        \DB::table('oauth_auth_codes')
            ->where('user_id', $user_id)
            ->delete();

        \DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $tokenId)
            ->delete();

        $this->guard()->logout();
        $request->session()->invalidate();
        $request->user()->token()->revoke();

        $json = [
            'success' => true,
            'code' => 200,
            'message' => 'You are Logged out.',
        ];
        return response()->json($json, '200');
    }
}
