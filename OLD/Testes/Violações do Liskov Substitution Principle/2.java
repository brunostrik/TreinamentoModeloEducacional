public class Bird {
    public void fly() { /* ... */ }
}

public class Ostrich extends Bird {
    @Override
    public void fly() {
        throw new UnsupportedOperationException();
    }
}
