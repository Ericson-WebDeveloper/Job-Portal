<?php

namespace Database\Seeders;

use App\Models\Specialization;
use App\Models\SubSpecialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Specialization::insert([
        //     ['name' => 'Accounting/Finance All'],
        //     ['name' => 'Admin/Human Resources All'],
        //     ['name' => 'Sales/Marketing All'],
        //     ['name' => 'Arts/Media/Communication All'],
        //     ['name' => 'Services All'],
        //     ['name' => 'Hotel/Restaurant All'],
        //     ['name' => 'Education/Training All'],
        //     ['name' => 'Computer/Information Technology All'],
        //     ['name' => 'Engineering All'],
        //     ['name' => 'Engineering All'],
        //     ['name' => 'Manufactoring All'],
        //     ['name' => 'Building/Construction All'],
        //     ['name' => 'Sciences All'],
        //     ['name' => 'Healthcare All'],
        //     ['name' => 'Others All'],
        // ]);

        SubSpecialization::insert([
            ['specialization_id' => 1, 'name' => 'Audit & Taxation'],
            ['specialization_id' => 1, 'name' => 'General/Cost Accounting'],
            ['specialization_id' => 1, 'name' => 'Corporate Finance/Investment'],
            ['specialization_id' => 1, 'name' => 'Banking/Financial'],

            ['specialization_id' => 2, 'name' => 'Clerical/Adminsitrative Support'],
            ['specialization_id' => 2, 'name' => 'Human Resources'],
            ['specialization_id' => 2, 'name' => 'Secretarial/Executive Personal Assistant'],
            ['specialization_id' => 2, 'name' => 'Top Management'],

            ['specialization_id' => 3, 'name' => 'Marketing/Business Dev'],
            ['specialization_id' => 3, 'name' => 'Sales - Corporate'],
            ['specialization_id' => 3, 'name' => 'Sales - Eng/Tech/IT'],
            ['specialization_id' => 3, 'name' => 'Sales - Financial Services'],
            ['specialization_id' => 3, 'name' => 'Retail Services'],
            ['specialization_id' => 3, 'name' => 'Merchandising'],
            ['specialization_id' => 3, 'name' => 'Telesales/Telemarketing'],
            ['specialization_id' => 3, 'name' => 'E-commerce'],
            ['specialization_id' => 3, 'name' => 'Digital Marketing'],


            ['specialization_id' => 4, 'name' => 'Advertising'],
            ['specialization_id' => 4, 'name' => 'Arts/Creative Design'],
            ['specialization_id' => 4, 'name' => 'Entertainment'],
            ['specialization_id' => 4, 'name' => 'Public Relations'],

            ['specialization_id' => 5, 'name' => 'Personal Care'],
            ['specialization_id' => 5, 'name' => 'Armed Forces'],
            ['specialization_id' => 5, 'name' => 'Social Service'],
            ['specialization_id' => 5, 'name' => 'Customer Service'],
            ['specialization_id' => 5, 'name' => 'Lawyer/Legal Asst'],
            ['specialization_id' => 5, 'name' => 'Logistics/Supply Chain'],
            ['specialization_id' => 5, 'name' => 'Tech & Helpdesk Support'],

            ['specialization_id' => 6, 'name' => 'Food/Beverage/Restaurant'],
            ['specialization_id' => 6, 'name' => 'Hotel/Tourism'],

            ['specialization_id' => 7, 'name' => 'Education'],
            ['specialization_id' => 7, 'name' => 'Training Dev'],

            ['specialization_id' => 8, 'name' => 'IT-Software'],
            ['specialization_id' => 8, 'name' => 'IT-Hardware'],
            ['specialization_id' => 8, 'name' => 'IT-Network/Sys/DB Admin'],

            ['specialization_id' => 9, 'name' => 'Chemical Engineering'],
            ['specialization_id' => 9, 'name' => 'Electronics'],
            ['specialization_id' => 9, 'name' => 'Electrical'],
            ['specialization_id' => 9, 'name' => 'other Engineering'],
            ['specialization_id' => 9, 'name' => 'Environmental'],
            ['specialization_id' => 9, 'name' => 'EOil/Gas'],
            ['specialization_id' => 9, 'name' => 'Mechanical'],
            ['specialization_id' => 9, 'name' => 'Industrial Engineering'],


            ['specialization_id' => 11, 'name' => 'Maintenance'],
            ['specialization_id' => 11, 'name' => 'Purchasing/Material Mgnt'],
            ['specialization_id' => 11, 'name' => 'Manufacturing'],
            ['specialization_id' => 11, 'name' => 'Process Control'],
            ['specialization_id' => 11, 'name' => 'Quality Assurance'],

            ['specialization_id' => 12, 'name' => 'Property/Real State'],
            ['specialization_id' => 12, 'name' => 'Architect/Interior Design'],
            ['specialization_id' => 12, 'name' => 'Civil/Construction'],
            ['specialization_id' => 12, 'name' => 'Quantity Surveying'],

            ['specialization_id' => 13, 'name' => 'Agriculture'],
            ['specialization_id' => 13, 'name' => 'Actuarial/Statics'],
            ['specialization_id' => 13, 'name' => 'Food Tech/Nutritionist'],
            ['specialization_id' => 13, 'name' => 'Geology/Geophysics'],
            ['specialization_id' => 13, 'name' => 'Aviation'],
            ['specialization_id' => 13, 'name' => 'Biotechnology'],
            ['specialization_id' => 13, 'name' => 'Chemistry'],
            ['specialization_id' => 13, 'name' => 'Science & Technology'],
            ['specialization_id' => 13, 'name' => 'Biomedical'],

            ['specialization_id' => 14, 'name' => 'Practitioner/Medical Asst'],
            ['specialization_id' => 14, 'name' => 'Pharmacy'],
            ['specialization_id' => 14, 'name' => 'Diagnostic/Others'],
            

            ['specialization_id' => 15, 'name' => 'Others All'],
            ['specialization_id' => 15, 'name' => 'Journalist/Editors'],
            ['specialization_id' => 15, 'name' => 'General Work'],
            ['specialization_id' => 15, 'name' => 'Others'],
            ['specialization_id' => 15, 'name' => 'Publishing']
        ]);

    }
}
