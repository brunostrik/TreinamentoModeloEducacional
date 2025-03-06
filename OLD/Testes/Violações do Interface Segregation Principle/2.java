public interface Printer {
    void print();
    void fax();
    void scan();
}

public class SimplePrinter implements Printer {
    public void print() { /* ... */ }
    public void fax() { /* ... */ } // Not needed
    public void scan() { /* ... */ } // Not needed
}
