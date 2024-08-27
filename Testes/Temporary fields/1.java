public class Order {
    private double discount;

    public double getDiscount() {
        if (isSpecialCustomer) {
            return discount;
        }
        return 0;
    }
}
