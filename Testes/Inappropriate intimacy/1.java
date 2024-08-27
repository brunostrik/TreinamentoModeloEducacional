public class House {
    private String secretRoom;

    public String getSecretRoom() {
        return secretRoom;
    }
}

public class Person {
    public void enterSecretRoom(House house) {
        System.out.println("Entering: " + house.getSecretRoom());
    }
}
