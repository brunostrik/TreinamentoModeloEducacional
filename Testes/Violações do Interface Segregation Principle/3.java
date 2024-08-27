public interface Vehicle {
    void startEngine();
    void sail();
    void fly();
}

public class Car implements Vehicle {
    public void startEngine() { /* ... */ }
    public void sail() { /* ... */ } // Not needed
    public void fly() { /* ... */ } // Not needed
}
