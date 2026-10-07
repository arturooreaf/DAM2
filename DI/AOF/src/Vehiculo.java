import java.nio.file.attribute.UserPrincipal;
import java.util.ArrayList;

public abstract class Vehiculo {
    private final String marca;
    private final int kilometro;

    @Override
    public String toString() {
        return "Vehiculo{" +
                "marca='" + marca + '\'' +
                ", kilometro=" + kilometro +
                '}';
    }

    public String getMarca() {
        return marca;
    }

    public int getKilometro() {
        return kilometro;
    }

    public Vehiculo(String marca, int kilometro) {
        this.marca = marca;
        this.kilometro = kilometro;

    }



}
