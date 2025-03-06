public class Car {
    public void drive() { /* ... */ }
}

public class Boat extends Car {
    @Override
    public void drive() {
        throw new UnsupportedOperationException();
    }
}
