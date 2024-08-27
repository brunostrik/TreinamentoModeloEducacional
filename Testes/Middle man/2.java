public class Proxy {
    private RealService realService;

    public void doSomething() {
        realService.doSomething();
    }
}
