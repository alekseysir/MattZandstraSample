<?php
abstract class Employee
{
    public function __construct(protected string $name)
    {
    }

    abstract public function fire() : void;
}

class Minion extends Employee
{
    public function fire(): void
    {
        print "$this->name : I'll clean my desk"."<br>";

    }
}

class NastyBoss
{
    private array $employees = [];
    public function addEmployee(Employee $employee) : void
    {
        $this->employees[] = $employee;
    }
    public function projectFails() : void
    {
        if(count($this->employees)>0)
        {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }

}

class CluedUp extends Employee
{
    public function fire(): void
    {
        print "$this->name : I'll call my lawyer!!"."<br>";
    }
}
$boss = new NastyBoss();
$boss->addEmployee(new Minion("Ann"));
$boss->addEmployee(new Minion("Tony"));
$boss->addEmployee(new CluedUp("Bill"));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();