public class Payment {
    private String confirmationMessage;

    public void processPayment() {
        if (isConfirmed) {
            System.out.println(confirmationMessage);
        }
    }
}
