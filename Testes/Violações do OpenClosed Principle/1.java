public class DiscountCalculator {
    public double calculate(String type, double amount) {
        if (type.equals("Student")) {
            return amount * 0.9;
        } else if (type.equals("Senior")) {
            return amount * 0.8;
        }
        return amount;
    }
}
