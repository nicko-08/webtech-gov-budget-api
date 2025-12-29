<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetItem;
use App\Models\Expense;
use App\Models\FiscalYear;
use App\Models\GovernmentUnit;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Model::withoutEvents(function () {

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

            $activeYear = null;

            DB::transaction(function () use (&$activeYear) {

                FiscalYear::where('is_active', true)->update(['is_active' => false]);

                $activeYear = FiscalYear::factory()->create([
                    'year' => 2026,
                    'start_date' => '2026-01-01',
                    'end_date' => '2026-12-31',
                    'is_active' => true,
                ]);

                FiscalYear::factory()->create([
                    'year' => 2025,
                    'start_date' => '2025-01-01',
                    'end_date' => '2025-12-31',
                    'is_active' => false,
                ]);
            });

            if (! $activeYear) {
                throw new \RuntimeException('Active fiscal year was not created');
            }

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
                'Barangay Kamuning',
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
                    'total_amount' => $faker->numberBetween(1_500_000, 3_000_000),
                ]);

                $this->createBarangayProjects(
                    $faker,
                    $budget,
                    $infrastructure,
                    $health,
                    $education,
                    $peaceOrder,
                    $environment
                );
            }

            $this->command->info('Database seeding completed successfully.');
        });
    }

    private function createBarangayProjects(
        $faker,
        Budget $budget,
        BudgetCategory $infrastructure,
        BudgetCategory $health,
        BudgetCategory $education,
        BudgetCategory $peaceOrder,
        BudgetCategory $environment
    ): void {
        $barangayId = $budget->government_unit_id;

        $infraProjects = [
            ['name' => 'Basketball Court Renovation', 'amount' => $faker->numberBetween(300_000, 500_000)],
            ['name' => 'Covered Court Construction', 'amount' => $faker->numberBetween(800_000, 1_200_000)],
            ['name' => 'Street Lighting Installation', 'amount' => $faker->numberBetween(200_000, 400_000)],
            ['name' => 'Drainage System Improvement', 'amount' => $faker->numberBetween(400_000, 600_000)],
        ];

        foreach ($infraProjects as $index => $project) {
            $item = BudgetItem::factory()->create([
                'budget_id' => $budget->id,
                'budget_category_id' => $infrastructure->id,
                'name' => $project['name'],
                'code' => "BRG{$barangayId}-INFRA-" . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'allocated_amount' => $project['amount'],
            ]);

            $this->createProjectExpenses($faker, $item, $project['name']);
        }

        $this->createCategoryProjects($faker, $budget, $health, 'HEALTH', [
            'Barangay Health Station Supplies',
            'Medical Equipment Purchase',
            'Vaccination Program',
        ]);

        $this->createCategoryProjects($faker, $budget, $education, 'EDU', [
            'Day Care Center Improvement',
            'Learning Materials Purchase',
            'Youth Development Program',
        ]);

        $this->createCategoryProjects($faker, $budget, $peaceOrder, 'PEACE', [
            'CCTV Camera Installation',
            'Barangay Patrol Equipment',
        ]);
    }

    private function createCategoryProjects(
        $faker,
        Budget $budget,
        BudgetCategory $category,
        string $prefix,
        array $names
    ): void {
        foreach ($names as $index => $name) {
            $item = BudgetItem::factory()->create([
                'budget_id' => $budget->id,
                'budget_category_id' => $category->id,
                'name' => $name,
                'code' => "BRG{$budget->government_unit_id}-{$prefix}-" . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'allocated_amount' => $faker->numberBetween(80_000, 500_000),
            ]);

            $this->createProjectExpenses($faker, $item, $name);
        }
    }

    private function createProjectExpenses($faker, BudgetItem $budgetItem, string $projectName): void
    {
        $expenseTypes = [
            'Materials Purchase',
            'Labor Cost',
            'Equipment Rental',
            'Transportation',
            'Professional Services',
        ];

        $count = $faker->numberBetween(3, 8);
        $max = $budgetItem->allocated_amount * 0.8;

        for ($i = 0; $i < $count; $i++) {
            Expense::factory()->create([
                'budget_item_id' => $budgetItem->id,
                'description' => $faker->randomElement($expenseTypes) . ' for ' . $projectName,
                'amount' => $faker->numberBetween(5_000, min(100_000, $max / $count)),
                'transaction_date' => $faker->dateTimeBetween('2026-01-01', '2026-12-31'),
            ]);
        }
    }
}
