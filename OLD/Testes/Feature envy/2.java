public class SalaryCalculator {
    public double calculate(Employee employee) {
        return employee.getBaseSalary() + employee.getBonus();
    }
}
