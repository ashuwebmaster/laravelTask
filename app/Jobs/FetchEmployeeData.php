<?php

namespace App\Jobs;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchEmployeeData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = "http://dummy.restapiexample.com/api/v1/employees";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=curl_exec($ch);
        curl_close($ch);
        $data = json_decode($result, true);
        $employees_data = array();
        if(isset($data['status']) && $data['status'] == "success" && $data['data'])
        {
            foreach($data['data'] as $emp_data)
            {
                $employees_data[] = array(
                    'name' => $emp_data['employee_name'], 
                    'salary' => $emp_data['employee_salary'], 
                    'age' => $emp_data['employee_age'], 
                    'image' => $emp_data['profile_image'], 
                );
            }
        }
        if($employees_data)
        {
            $employee = new Employee();
            $employee::insert($employees_data);
            
        }
    }
}
