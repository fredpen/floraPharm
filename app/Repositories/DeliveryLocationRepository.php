<?php


namespace App\Repositories;


use App\Interfaces\DeliveryLocationInterface;
use App\Models\DeliveryLocation;

class DeliveryLocationRepository implements DeliveryLocationInterface
{
    protected $deliveryLocation;

    public function __construct(DeliveryLocation $deliveryLocation)
    {
        $this->deliveryLocation = $deliveryLocation;
    }

    public function addNewLocation($request)
    {
        // TODO: Implement addNewLocation() method.
        $this->deliveryLocation->name = $request->name;
        $this->deliveryLocation->description = $request->description;
        $this->deliveryLocation->price = $request->price;
        if ( $this->deliveryLocation->save()) {
            return 'saved';
        }
        return 'can\'t be saved';
    }

    public function updateExistingLocation($request, $id)
    {
        // TODO: Implement updateExistingLocation() method.
        $location = $this->deliveryLocation->where('id', $id)->first();
        if ($location) {
            $location->name = $request->name;
            $location->description = $request->description;
            $location->price = $request->price;
            if ($location->save()) {
                return 'updated';
            }
            return 'can\'t be updated';
        }

    }

    public function deleteDeliveryLocation($id)
    {
        // TODO: Implement deleteDeliveryLocation() method.
        $delivery = $this->deliveryLocation->where('id', $id)->first();
        if($delivery) {
            if ($delivery->delete()) {
                return 'deleted';
            }
            return 'can\'t be deleted';
        }

    }

    public function getAllLocation()
    {
        // TODO: Implement getAllLocation() method.
        return $this->deliveryLocation->all();
    }
}
