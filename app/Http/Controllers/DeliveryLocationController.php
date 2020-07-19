<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\DeliveryLocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DeliveryLocationController extends Controller
{
    //
    protected $deliveryLocationService;

    public function __construct(DeliveryLocationService $deliveryLocationService)
    {
        $this->deliveryLocationService = $deliveryLocationService;
    }
    public function websiteDetails()
    {
        return ResponseHelper::responseDisplay(200, 'Operation successful', Config::get('constants.WEBSITE_DETAILS', []));
    }

    public function addLocation(Request $request)
    {
        $location = $this->deliveryLocationService->createLocation($request);

        if ($location === 'saved') {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $location);
        }

        if (is_array($location)) {
            return ResponseHelper::responseDisplay(400, 'Validation error', $location);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed');
    }

    public function updateLocation(Request $request, $id)
    {
        $location = $this->deliveryLocationService->updateLocation($request, $id);
        if ($location === 'updated') {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $location);
        }

        if (is_array($location)) {
            return ResponseHelper::responseDisplay(400, 'Validation error', $location);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed');
    }

    public function deleteLocation($id)
    {
        $deliveryLocation = $this->deliveryLocationService->deleteLocation($id);
        if ($deliveryLocation ===  'deleted') {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $deliveryLocation);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed');
    }


    public function locations()
    {
        $locations = $this->deliveryLocationService->fetchAllDeliveryLocation();
        if ($locations) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $locations);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed');
    }


    public function adminLocations()
    {
        $locations = $this->deliveryLocationService->fetchAllDeliveryLocationAdmin();
        if ($locations) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $locations);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed');
    }
}
