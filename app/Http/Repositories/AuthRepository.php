<?php
namespace App\Http\Repositories;
use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiDesignTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthRepository  implements AuthInterface
{
    use ApiDesignTrait;

    private $userModel;
    public function __construct(User $user)
    {
        $this->userModel = $user;
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    // public function login()
    // {
    //     $credentials = request(['email', 'password']);

    //     if (! $token = auth()->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     return $this->respondWithToken($token);
    // }

     public function login(){
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->ApiResponse(422, 'Unauthorized');
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
 
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
      
       auth()->logout();
        //Auth::guard('api')->logout();
       return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60
    //     ]);
    // }

    protected function respondWithToken($token)
    {
        $userData = $this->userModel::find(auth()->user()->id);
        $data = [
            'id' => $userData->id,
            'name' => $userData->name,
            'email' => $userData->email,
            'role' => auth()->user()->roleName->name,
            'access_token' => $token,
        ];

        return $this->ApiResponse(200, 'Done', null, $data);

    }

} // end of AuthRepository

?>
