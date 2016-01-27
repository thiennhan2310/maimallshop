<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function Login(LoginRequest $request)
	{
		$value = ["email" => $request->get("email"), "password" => $request->get("password")];
		if ($request->remember_me == "1") $remember = true;
		else $remember = false;
		if ($this->auth->attempt($value, $remember)) {
			if ($request->get("email") == "admin@maimallshop.com") //admin
				return redirect()->route("admin.home");
			else { //customer
				$customer_id = $this->auth->user()->id;
				/* get list id of customer*/
				$array_list_id = \App\LoveList::select(["id"])->where("customer_id", $customer_id)->get()->toArray();
				/*del san pham */
				$temp = \App\LoveListDetail::whereIn("list_id", $array_list_id)->count();
				Session::put("love", $temp); //so luong san pham yeu thich
				return redirect("/");
			}
		} else {
			return redirect("dang-nhap")->with("result", "Email hoặc mật khẩu không đúng!");
		}
	}


}
