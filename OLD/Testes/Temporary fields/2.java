public class Invoice {
    private String promotionalMessage;

    public void printInvoice() {
        if (hasPromotion) {
            System.out.println(promotionalMessage);
        }
    }
}
