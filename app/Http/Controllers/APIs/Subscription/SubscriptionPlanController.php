<?php

namespace App\Http\Controllers\APIs\Subscription;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionPlanResource;
use Exception;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\select;

class SubscriptionPlanController extends Controller
{
    public function subscriptionPlanGet()
    {
        try {
            $plan_list = SubscriptionPlan::where('is_active', true)->orderBy('price')->get();
            
            return response()->apiSuccess(SubscriptionPlanResource::collection($plan_list), 'Subscription plan retrieved successfully');
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    
}
