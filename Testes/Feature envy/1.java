public class OrderPrinter {
    public void print(Order order) {
        System.out.println(order.getCustomer().getName());
        System.out.println(order.getCustomer().getAddress());
    }
}
