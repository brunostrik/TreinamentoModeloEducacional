public class OrderProcessor {

    public void processOrder(String customerName, String customerAddress, String customerPhone, String productName, double productPrice, int quantity) {
        // Process the order using the provided data
        double totalAmount = productPrice * quantity;
        System.out.println("Processing order for " + customerName);
        System.out.println("Shipping to " + customerAddress);
        System.out.println("Contact phone: " + customerPhone);
        System.out.println("Order total: $" + totalAmount);
    }
}

public class InvoiceGenerator {

    public void generateInvoice(String customerName, String customerAddress, String customerPhone, String productName, double productPrice, int quantity) {
        // Generate an invoice using the provided data
        double totalAmount = productPrice * quantity;
        System.out.println("Generating invoice for " + customerName);
        System.out.println("Shipping to " + customerAddress);
        System.out.println("Contact phone: " + customerPhone);
        System.out.println("Invoice total: $" + totalAmount);
    }
}

public class CustomerService {

    public void sendOrderConfirmation(String customerName, String customerAddress, String customerPhone, String productName, double productPrice, int quantity) {
        // Send an order confirmation to the customer
        double totalAmount = productPrice * quantity;
        System.out.println("Sending order confirmation to " + customerName);
        System.out.println("Address: " + customerAddress);
        System.out.println("Contact phone: " + customerPhone);
        System.out.println("Order total: $" + totalAmount);
    }
}