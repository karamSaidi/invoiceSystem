<?php

use App\Invoice;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ar_SA');

        $items = [
            [
                'product_name' => 'طاولة كمبيوتر كبيرة',
                'unit' => 'piece',
                'quantity' => '1',
                'unit_price' => '260',
                'row_sub_total' => '260',
            ],
            [
                'product_name' => 'سماعة كمبيوتر',
                'unit' => 'piece',
                'quantity' => '2',
                'unit_price' => '70',
                'row_sub_total' => '140',
            ],
            [
                'product_name' => 'كمبيوتر مواصفات خاصة',
                'unit' => 'piece',
                'quantity' => '1',
                'unit_price' => '1200',
                'row_sub_total' => '1200',
            ],
        ];

        for($i=0; $i < 30; $i++){
            $data = [
                'customer_name' => $faker->name,
                'customer_email' => $faker->unique()->email,
                'customer_mobile' => $this->generateNumber(rand(10, 14)),
                'company_name' => $faker->name,
                'invoice_number' => $this->generateNumber(8),
                'invoice_date' => Carbon::now()->subDays(rand(5, 100)),
                'discount_type' => 'percentage',
                'discount_value' => '20',
                'vat_value' => '64.00',
                'shipping' => '15',
                'total_due' => '1359.00',
            ];

            $invoice = Invoice::create($data);
            $invoice->details()->createMany($items);
        }


        $faker = Factory::create('en_US');

        $items = [
            [
                'product_name' => 'big Table for food',
                'unit' => 'piece',
                'quantity' => '1',
                'unit_price' => '260',
                'row_sub_total' => '260',
            ],
            [
                'product_name' => 'headphone for computer',
                'unit' => 'piece',
                'quantity' => '2',
                'unit_price' => '70',
                'row_sub_total' => '140',
            ],
            [
                'product_name' => 'special computer',
                'unit' => 'piece',
                'quantity' => '1',
                'unit_price' => '1200',
                'row_sub_total' => '1200',
            ],
        ];

        for($i=0; $i < 20; $i++){
            $data = [
                'customer_name' => $faker->name,
                'customer_email' => $faker->unique()->email,
                'customer_mobile' => $this->generateNumber(rand(10, 14)),
                'company_name' => $faker->name,
                'invoice_number' => $this->generateNumber(8),
                'invoice_date' => Carbon::now()->subDays(rand(5, 100)),
                'discount_type' => 'percentage',
                'discount_value' => '20',
                'vat_value' => '64.00',
                'shipping' => '15',
                'total_due' => '1359.00',
            ];

            $invoice = Invoice::create($data);
            $invoice->details()->createMany($items);
        }


    }


    function generateNumber($numberLength){
        $number = '';

        for($i =0; $i < $numberLength; $i++){
            $number .= rand(0, 9);
        }
        return $number;
    }

}
