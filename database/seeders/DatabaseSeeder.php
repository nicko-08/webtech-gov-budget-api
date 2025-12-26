<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\BudgetItem;
use App\Models\BudgetCategory;
use App\Models\Expense;
use App\Models\FiscalYear;
use App\Models\GovernmentUnit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('en_PH');

        $this->command->info('Seeding users...');
        User::factory()->create([
            'name' => 'Nicko Rodavia',
            'email' => 'admin@barangay.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Juan dela Cruz',
            'email' => 'treasurer@barangay.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'budget-officer',
        ]);

        User::factory()->create([
            'name' => 'Ana Reyes',
            'email' => 'secretary@barangay.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'budget-officer',
        ]);

        for ($i = 0; $i < 10; $i++) {
            User::factory()->create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 'guest',
            ]);
        }

        $this->command->info('Seeding fiscal years...');
        $activeYear = FiscalYear::factory()->create([
            'year' => 2026,
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'is_active' => true
        ]);

        FiscalYear::factory()->create([
            'year' => 2025,
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'is_active' => false
        ]);

        $this->command->info('Seeding budget categories...');
        $infrastructure = BudgetCategory::factory()->create(['name' => 'Infrastructure Development']);
        $health = BudgetCategory::factory()->create(['name' => 'Health and Sanitation']);
        $education = BudgetCategory::factory()->create(['name' => 'Education and Youth']);
        $peaceOrder = BudgetCategory::factory()->create(['name' => 'Peace and Order']);
        $environment = BudgetCategory::factory()->create(['name' => 'Environment and Waste Management']);

        $this->command->info('Seeding barangays...');
        $city = GovernmentUnit::factory()->create([
            'name' => 'Quezon City',
            'type' => 'city',
            'parent_id' => null,
        ]);

        $barangays = [
            'Barangay San Antonio',
            'Barangay Santo Domingo',
            'Barangay Bagong Pag-asa',
            'Barangay Tatalon',
            'Barangay Kamuning'
        ];

        foreach ($barangays as $barangayName) {
            $this->command->info("Creating {$barangayName}...");

            $barangay = GovernmentUnit::factory()->create([
                'name' => $barangayName,
                'type' => 'barangay',
                'parent_id' => $city->id,
            ]);

            $budget = Budget::factory()->create([
                'government_unit_id' => $barangay->id,
                'fiscal_year_id' => $activeYear->id,
                'name' => "{$barangayName} Annual Budget 2026",
                'total_amount' => $faker->numberBetween(1500000, 3000000),
            ]);

            $this->createBarangayProjects($faker, $budget, $infrastructure, $health, $education, $peaceOrder, $environment);
            $this->createBudgetSummary($activeYear->id, $barangay->id, $budget->id);
        }

        $this->command->info('Database seeding completed successfully.');
    }

    private function createBarangayProjects($faker, $budget, $infrastructure, $health, $education, $peaceOrder, $environment)
    {
        // Get barangay ID for unique codes
        $barangayId = $budget->government_unit_id;

        $infraProjects = [
            ['name' => 'Basketball Court Renovation', 'amount' => $faker->numberBetween(300000, 500000)],
            ['name' => 'Covered Court Construction', 'amount' => $faker->numberBetween(800000, 1200000)],
            ['name' => 'Street Lighting Installation', 'amount' => $faker->numberBetween(200000, 400000)],
            ['name' => 'Drainage System Improvement', 'amount' => $faker->numberBetween(400000, 600000)],
        ];

        foreach ($infraProjects as $index => $project) {
            $budgetItem = BudgetItem::factory()->create([
                'budget_id' => $budget->id,
                'budget_category_id' => $infrastructure->id,
                'name' => $project['name'],
                'code' => "BRG{$barangayId}-INFRA-" . str_pad($index + 1, 3, '0', STR_PAD_LEFT), // Changed this line
                'allocated_amount' => $project['amount'],
            ]);
            $this->createProjectExpenses($faker, $budgetItem, $project['name']);
        }

        $healthProjects = [
            ['name' => 'Barangay Health Station Supplies', 'amount' => $faker->numberBetween(100000, 200000)],
            ['name' => 'Medical Equipment Purchase', 'amount' => $faker->numberBetween(150000, 300000)],
            ['name' => 'Vaccination Program', 'amount' => $faker->numberBetween(80000, 150000)],
        ];

        foreach ($healthProjects as $index => $project) {
            $budgetItem = BudgetItem::factory()->create([
                'budget_id' => $budget->id,
                'budget_category_id' => $health->id,
                'name' => $project['name'],
                'code' => "BRG{$barangayId}-HEALTH-" . str_pad($index + 1, 3, '0', STR_PAD_LEFT), // Changed this line
                'allocated_amount' => $project['amount'],
            ]);
            $this->createProjectExpenses($faker, $budgetItem, $project['name']);
        }

        $eduProjects = [
            ['name' => 'Day Care Center Improvement', 'amount' => $faker->numberBetween(200000, 400000)],
            ['name' => 'Learning Materials Purchase', 'amount' => $faker->numberBetween(50000, 100000)],
            ['name' => 'Youth Development Program', 'amount' => $faker->numberBetween(80000, 150000)],
        ];

        foreach ($eduProjects as $index => $project) {
            $budgetItem = BudgetItem::factory()->create([
                'budget_id' => $budget->id,
                'budget_category_id' => $education->id,
                'name' => $project['name'],
                'code' => "BRG{$barangayId}-EDU-" . str_pad($index + 1, 3, '0', STR_PAD_LEFT), // Changed this line
                'allocated_amount' => $project['amount'],
            ]);
            $this->createProjectExpenses($faker, $budgetItem, $project['name']);
        }

        $peaceProjects = [
            ['name' => 'CCTV Camera Installation', 'amount' => $faker->numberBetween(300000, 500000)],
            ['name' => 'Barangay Patrol Equipment', 'amount' => $faker->numberBetween(100000, 200000)],
        ];

        foreach ($peaceProjects as $index => $project) {
            $budgetItem = BudgetItem::factory()->create([
                'budget_id' => $budget->id,
                'budget_category_id' => $peaceOrder->id,
                'name' => $project['name'],
                'code' => "BRG{$barangayId}-PEACE-" . str_pad($index + 1, 3, '0', STR_PAD_LEFT), // Changed this line
                'allocated_amount' => $project['amount'],
            ]);
            $this->createProjectExpenses($faker, $budgetItem, $project['name']);
        }
    }


    private function createProjectExpenses($faker, $budgetItem, $projectName)
    {
        $expenseTypes = [
            'Materials Purchase',
            'Labor Cost',
            'Equipment Rental',
            'Transportation',
            'Professional Services'
        ];

        $totalExpenses = $faker->numberBetween(3, 8);
        $maxExpenseAmount = $budgetItem->allocated_amount * 0.8;

        for ($i = 0; $i < $totalExpenses; $i++) {
            Expense::factory()->create([
                'budget_item_id' => $budgetItem->id,
                'description' => $faker->randomElement($expenseTypes) . ' for ' . $projectName,
                'amount' => $faker->numberBetween(5000, min(100000, $maxExpenseAmount / $totalExpenses)),
                'transaction_date' => $faker->dateTimeBetween('2026-01-01', '2026-12-31'),
            ]);
        }
    }

    private function createBudgetSummary($fiscalYearId, $governmentUnitId, $budgetId)
    {
        $totalAllocated = DB::table('budget_items')
            ->where('budget_id', $budgetId)
            ->sum('allocated_amount');

        $totalSpent = DB::table('expenses')
            ->join('budget_items', 'expenses.budget_item_id', '=', 'budget_items.id')
            ->where('budget_items.budget_id', $budgetId)
            ->sum('expenses.amount');

        $utilizationRate = $totalAllocated > 0 ? ($totalSpent / $totalAllocated) * 100 : 0;

        $spendingByCategory = DB::table('expenses')
            ->join('budget_items', 'expenses.budget_item_id', '=', 'budget_items.id')
            ->join('budget_categories', 'budget_items.budget_category_id', '=', 'budget_categories.id')
            ->where('budget_items.budget_id', $budgetId)
            ->select('budget_categories.name', DB::raw('SUM(expenses.amount) as total'))
            ->groupBy('budget_categories.name')
            ->get()
            ->pluck('total', 'name')
            ->toArray();

        DB::table('budget_summaries')->insert([
            'fiscal_year_id' => $fiscalYearId,
            'government_unit_id' => $governmentUnitId,
            'total_allocated' => $totalAllocated,
            'total_spent' => $totalSpent,
            'utilization_rate' => round($utilizationRate, 2),
            'spending_by_category' => json_encode($spendingByCategory),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
