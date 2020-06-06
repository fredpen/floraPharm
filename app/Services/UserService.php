<?php


namespace App\Services;


use App\Interfaces\UserInterface;

class UserService
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function create($request){
        return $request;
       return $this->userInterface->registerUser($request);
    }
}
