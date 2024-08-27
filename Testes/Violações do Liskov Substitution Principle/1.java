public class Rectangle {
    public void setWidth(int width) { /* ... */ }
    public void setHeight(int height) { /* ... */ }
}

public class Square extends Rectangle {
    @Override
    public void setWidth(int width) {
        super.setWidth(width);
        super.setHeight(width);
    }
}
