public interface Animal {
    void walk();
    void swim();
    void fly();
}

public class Dog implements Animal {
    public void walk() { /* ... */ }
    public void swim() { /* ... */ }
    public void fly() { /* ... */ } // Not needed
}
