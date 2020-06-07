<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\UserService;
use App\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        $address = $this->userService->getAddress();
        if (isset($address)) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $address);
        } else {
            return ResponseHelper::responseDisplay(400, 'Operation failed', $address);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $address = $this->userService->saveAddress($request);
        if (is_array($address)) {
            return ResponseHelper::responseDisplay(400, 'Bad request', $address);
        } else {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $address);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function show(UserAddress $userAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function edit($request)
    {
        //
        $address = $this->userService->getAddressById($request);
        if (isset($address)) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $address);
        } else {
            return ResponseHelper::responseDisplay(404, 'Not found', $address);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userAddress)
    {
        //
        $address = $this->userService->updateAddress($request, $userAddress);
        if (is_array($address)) {
            return ResponseHelper::responseDisplay(400, 'Bad request', $address);
        } else {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $address);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $request
     * @return void
     */
    public function destroy($request)
    {
        //
        $address = $this->userService->deleteAddress($request);
        if (isset($address)) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $address);
        } else {
            return ResponseHelper::responseDisplay(404, 'Not found', $address);
        }
    }

    public function userDetail() {
        $detail = $this->userService->getUserDetail();
        if (isset($detail)) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $detail);
        } else {
            return ResponseHelper::responseDisplay(404, 'Operation failed');
        }
    }
}
