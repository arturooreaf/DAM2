import java.util.ArrayList;

public class Coche extends Vehiculo {
private final String color;

    public Coche(String marca, int kilometro, String color) {
        super(marca, kilometro);
        this.color = color;
    }

    @Override
    public String toString() {
        return "Coche{" +
                "color='" + color + '\'' +
                '}';
    }


    }
