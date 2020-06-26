<?php


namespace App\Interfaces;


interface UserInterface
{
   public function registerUser($request);

   public function authUser($request);

   public function saveAddress($request);

   public function getAddressById();

   public function getSingleAddressById($request);

   public function updateUserAddressById($request, $id);

   public function destroyAddress($request);

   public function userDetail();

   public function findUserByEmail($request);

   public function saveForgotPassword($user, $token);

   public function findUserByToken($request);

   public function allUsers();
}
