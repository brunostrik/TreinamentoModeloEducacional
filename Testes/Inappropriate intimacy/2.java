public class Car {
    private Engine engine;

    public Engine getEngine() {
        return engine;
    }
}

public class Mechanic {
    public void fixEngine(Car car) {
        car.getEngine().repair();
    }
}
