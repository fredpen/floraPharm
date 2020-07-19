<?php


namespace App\Services;


use App\Interfaces\DeliveryLocationInterface;
use Illuminate\Support\Facades\Validator;

class DeliveryLocationService
{
    protected $deliveryLocationInterface;

    public function __construct(DeliveryLocationInterface $deliveryLocationInterface)
    {
        $this->deliveryLocationInterface = $deliveryLocationInterface;
    }


    public function createLocation($request){
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string|unique:delivery_locations',
            'description' => 'string',
            'price' => 'required'
        ]);

        if ($validateData->fails()) {
            return $validateData->messages()->all();
        }

        return $this->deliveryLocationInterface->addNewLocation($request);
    }

    public function updateLocation($request, $id) {
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string|unique:delivery_locations,id,'.$id,
            'description' => 'string',
            'price' => 'required'
        ]);

        if ($validateData->fails()) {
            return $validateData->messages()->all();
        }


        return $this->deliveryLocationInterface->updateExistingLocation($request, $id);
    }

    public function deleteLocation($id) {
        return $this->deliveryLocationInterface->deleteDeliveryLocation($id);
    }

    public function fetchAllDeliveryLocation(){
        return $this->deliveryLocationInterface->getAllLocation();
    }

    public function fetchAllDeliveryLocationAdmin(){
        return $this->deliveryLocationInterface->getAllLocation(true);
    }

}
