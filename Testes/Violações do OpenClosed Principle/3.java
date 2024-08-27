public class TaxCalculator {
    public double calculateTax(String country, double income) {
        if (country.equals("US")) {
            return income * 0.3;
        } else if (country.equals("UK")) {
            return income * 0.25;
        }
        return income * 0.2;
    }
}
