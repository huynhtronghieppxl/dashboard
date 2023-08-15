<?php
namespace App\Employee;

class Employee
{
    public $id;
    public $address;
    public $avatar;
    public $birthday;
    public $birthplace;
    public $current_point;
    public $email;
    public $full_name;
    public $gender;
    public $passport;
    public $password;
    public $phone;
    public $total_point;
    public $used_point;
    public $total_amount;
    public $username;
    public $is_kickout;
    public $is_working;
    public $verification_code;
    public $used_off_day;
    public $total_off_day_available;

    public $total_off_day_saved;
    public $total_off_day;
    public $used_leave_day;
    public $total_leave_day_available;
    public $total_leave_day;
    public $last_month_updated;
    public $salary_bonus_percent;
    public $is_enable_change_password;
    public $total_daily_task;
    public $working_from;
    public $last_login_at;
    /**
     * @var EmployeeRank
     */
    public $rank;

    /**
     * @var EmployeeRole
     */
    public $employee_role;

    /**
     * @var SalaryLevel
     */
    public $salary_level;


}
