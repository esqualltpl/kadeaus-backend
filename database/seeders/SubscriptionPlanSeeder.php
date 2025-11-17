<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic Care',
                'slug' => 'basic-care',
                'description' => 'Essential health tracking for individuals',
                'price' => 9.99,
                'billing_period' => 'monthly',
                'features' => [
                    'health_history_tracking' => [
                        'enabled' => true,
                        'label' => 'Health history tracking',
                    ],
                    'appointments' => [
                        'enabled' => true,
                        'label' => 'Up to 3 appointments/month',
                        'limit' => 3,
                    ],
                    'health_recommendations' => [
                        'enabled' => true,
                        'label' => 'Basic health recommendations',
                    ],
                    'prescription_management' => [
                        'enabled' => true,
                        'label' => 'Prescription management',
                    ],
                    'lab_reports_access' => [
                        'enabled' => false,
                        'label' => 'Lab reports access',
                    ],
                    'telemedicine_consultations' => [
                        'enabled' => false,
                        'label' => 'Telemedicine consultations',
                    ],
                    'support_24_7' => [
                        'enabled' => false,
                        'label' => '24/7 health support',
                    ],
                ],
            ],
            [
                'name' => 'Premium Care',
                'slug' => 'premium-care',
                'description' => 'Advanced health management',
                'price' => 19.99,
                'billing_period' => 'monthly',
                'features' => [
                    'health_history_tracking' => [
                        'enabled' => true,
                        'label' => 'Complete health history tracking',
                    ],
                    'appointments' => [
                        'enabled' => true,
                        'label' => 'Unlimited appointments',
                        'limit' => null,
                    ],
                    'ai_health_insights' => [
                        'enabled' => true,
                        'label' => 'AI-powered health insights',
                    ],
                    'prescription_management' => [
                        'enabled' => true,
                        'label' => 'Prescription management',
                    ],
                    'lab_reports_analysis' => [
                        'enabled' => true,
                        'label' => 'Lab reports with analysis',
                    ],
                    'telemedicine' => [
                        'enabled' => true,
                        'label' => 'Unlimited telemedicine',
                    ],
                    'support_24_7' => [
                        'enabled' => true,
                        'label' => '24/7 health support',
                    ],
                ],
            ],
            [
                'name' => 'Family Care',
                'slug' => 'family-care',
                'description' => 'Complete care for the whole family',
                'price' => 34.99,
                'billing_period' => 'monthly',
                'features' => [
                    'family_members' => [
                        'enabled' => true,
                        'label' => 'Up to 6 family members',
                        'limit' => 6,
                    ],
                    'appointments' => [
                        'enabled' => true,
                        'label' => 'Unlimited appointments for all',
                        'limit' => null,
                    ],
                    'family_dashboard' => [
                        'enabled' => true,
                        'label' => 'Family health dashboard',
                    ],
                    'prescription_tracking' => [
                        'enabled' => true,
                        'label' => 'Shared prescription tracking',
                    ],
                    'lab_reports' => [
                        'enabled' => true,
                        'label' => 'Lab reports for everyone',
                    ],
                    'family_telemedicine' => [
                        'enabled' => true,
                        'label' => 'Family telemedicine access',
                    ],
                    'family_care_manager' => [
                        'enabled' => true,
                        'label' => 'Dedicated family care manager',
                    ],
                ],
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::create($plan);
        }
    }
}
