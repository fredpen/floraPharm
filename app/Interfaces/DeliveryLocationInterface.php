<?php


namespace App\Interfaces;


interface DeliveryLocationInterface
{
   public function addNewLocation($request);

   public function updateExistingLocation($request, $id);

   public function deleteDeliveryLocation($id);

   public function getAllLocation();


}
