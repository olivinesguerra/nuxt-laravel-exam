<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  public $response;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->response = response();
  }

  public function responseSuccess($data = [], $message = 'success', $extends = null)
  {
    $code = 200;
    $res = [
      'code' => 200,
      'success' => true,
      'message' => $message,
      'data' => $data
    ];
    if ($extends) {
      $res = [...$res, ...$extends];
    }
    return response()->json($res, $code);
  }

  public function responseError($message, $code = 400)
  {
    if ($code < 200 || $code > 600) {
      $code = 500;
    }
    // if ($code == 422) {
    //   $message = json_decode($message);
    // }
    
    // if ($code == 500 && env('APP_ENV') == 'production') {
    //   $message = __('messages.something_error');
    // }
    $res = [
      'code' => $code,
      'success' => false,
      'message' => $message,
    ];
    return response()->json($res, $code);
  }

  public function handleException(Exception $e)
  {
    $message = $e->getMessage();
    $code = $e->getCode();

   
    return $this->responseError($message, $code);
  }
}
