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
        print "$this->name : I'll clean my desk\n";

    }
}

class NastyBoss
{
    private array $employees = [];
    public function addEmployee(string $employeeName) : void
    {
        $this->employees[] = new Minion($employeeName);
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
$boss = new NastyBoss();
$boss->addEmployee("Ann");
$boss->addEmployee("Bill");
$boss->addEmployee("Tony");
$boss->projectFails();